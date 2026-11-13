<script setup lang="ts">
import { COLUMN_LABELS, LOOKUPS, type LookupTable } from '~~/shared/fields'

const route = useRoute()
const toast = useToast()
const table = computed(() => route.params.table as LookupTable)
if (!(table.value in LOOKUPS)) throw createError({ statusCode: 404, statusMessage: 'Nincs ilyen lista' })
const cfg = computed(() => LOOKUPS[table.value])
const { data, refresh } = await useFetch<any[]>(() => `/api/lookups/${table.value}`)
const edit = ref<any | null>(null)

async function save() {
  const d = edit.value
  try {
    if (d.id) await $fetch(`/api/lookups/${table.value}/${d.id}`, { method: 'PUT', body: d })
    else await $fetch(`/api/lookups/${table.value}`, { method: 'POST', body: d })
    edit.value = null
    await refresh()
  } catch (e: any) {
    toast.add({ title: e?.data?.statusMessage || 'Hiba', color: 'error' })
  }
}
async function remove(d: any) {
  if (!confirm(`Törlöd: ${d.name}?`)) return
  try {
    await $fetch(`/api/lookups/${table.value}/${d.id}`, { method: 'DELETE' })
    await refresh()
  } catch (e: any) {
    toast.add({ title: e?.data?.statusMessage || 'Hiba', color: 'error' })
  }
}
</script>

<template>
  <div>
    <div class="flex flex-wrap gap-1 mb-4">
      <UButton v-for="(l, key) in LOOKUPS" :key="key" :to="`/lookups/${key}`" :label="l.label" size="sm" :variant="key === table ? 'solid' : 'outline'" color="neutral" />
      <UButton to="/departments" label="Osztályok" size="sm" variant="outline" color="neutral" />
    </div>
    <div class="flex items-center mb-3">
      <h1 class="text-xl font-semibold">{{ cfg.label }}</h1>
      <UButton class="ml-auto" icon="i-lucide-plus" label="Új" @click="edit = { name: '' }" />
    </div>
    <table class="w-full text-sm">
      <thead><tr class="text-left text-gray-500"><th v-for="c in cfg.columns" :key="c">{{ COLUMN_LABELS[c] }}</th><th /></tr></thead>
      <tbody>
        <tr v-for="d in data" :key="d.id" class="border-t">
          <td v-for="c in cfg.columns" :key="c" class="py-1">{{ d[c] }}</td>
          <td class="text-right"><UButton size="xs" variant="ghost" icon="i-lucide-pencil" @click="edit = { ...d }" /><UButton size="xs" variant="ghost" color="error" icon="i-lucide-trash" @click="remove(d)" /></td>
        </tr>
      </tbody>
    </table>
    <UModal :open="!!edit" :title="cfg.label" @update:open="v => !v && (edit = null)">
      <template #body>
        <div v-if="edit" class="space-y-3">
          <UFormField v-for="c in cfg.columns" :key="c" :label="COLUMN_LABELS[c]"><UInput v-model="edit[c]" class="w-full" /></UFormField>
          <UButton label="Mentés" icon="i-lucide-save" @click="save" />
        </div>
      </template>
    </UModal>
  </div>
</template>
