<script setup lang="ts">
const toast = useToast()
const { data, refresh } = await useFetch<any[]>('/api/departments')
const { data: centers } = await useFetch<any[]>('/api/lookups/centers')
const centerOptions = computed(() => (centers.value ?? []).map(c => ({ label: c.name, value: c.id })))
const edit = ref<any | null>(null)

async function save() {
  const d = edit.value
  try {
    if (d.id) await $fetch(`/api/departments/${d.id}`, { method: 'PUT', body: d })
    else await $fetch('/api/departments', { method: 'POST', body: d })
    edit.value = null
    await refresh()
  } catch (e: any) {
    toast.add({ title: e?.data?.statusMessage || 'Hiba', color: 'error' })
  }
}
async function remove(d: any) {
  if (!confirm(`Törlöd: ${d.name}?`)) return
  try {
    await $fetch(`/api/departments/${d.id}`, { method: 'DELETE' })
    await refresh()
  } catch (e: any) {
    toast.add({ title: e?.data?.statusMessage || 'Hiba', color: 'error' })
  }
}
</script>

<template>
  <div>
    <div class="flex items-center mb-3">
      <h1 class="text-xl font-semibold">Osztályok</h1>
      <UButton class="ml-auto" icon="i-lucide-plus" label="Új osztály" @click="edit = { name: '', center_id: undefined, active: 1 }" />
    </div>
    <table class="w-full text-sm">
      <thead><tr class="text-left text-gray-500"><th>Név</th><th>Központ</th><th>Aktív</th><th /></tr></thead>
      <tbody>
        <tr v-for="d in data" :key="d.id" class="border-t">
          <td class="py-1">{{ d.name }}</td><td>{{ d.center }}</td><td>{{ d.active ? 'igen' : 'nem' }}</td>
          <td class="text-right"><UButton size="xs" variant="ghost" icon="i-lucide-pencil" @click="edit = { ...d }" /><UButton size="xs" variant="ghost" color="error" icon="i-lucide-trash" @click="remove(d)" /></td>
        </tr>
      </tbody>
    </table>
    <UModal :open="!!edit" title="Osztály" @update:open="v => !v && (edit = null)">
      <template #body>
        <div v-if="edit" class="space-y-3">
          <UFormField label="Név"><UInput v-model="edit.name" class="w-full" /></UFormField>
          <UFormField label="Központ"><USelectMenu v-model="edit.center_id" :items="centerOptions" value-key="value" class="w-full" /></UFormField>
          <UCheckbox :model-value="!!edit.active" label="Aktív" @update:model-value="edit.active = $event ? 1 : 0" />
          <UButton label="Mentés" icon="i-lucide-save" @click="save" />
        </div>
      </template>
    </UModal>
  </div>
</template>
