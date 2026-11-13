<script setup lang="ts">
const toast = useToast()
const saving = ref(false)
async function save(value: Record<string, any>) {
  saving.value = true
  try {
    const { id } = await $fetch<{ id: number }>('/api/bhaktas', { method: 'POST', body: value })
    await navigateTo(`/bhaktas/${id}`)
  } catch (e: any) {
    toast.add({ title: e?.data?.statusMessage || 'Hiba a mentéskor', color: 'error' })
  } finally {
    saving.value = false
  }
}
</script>

<template>
  <div>
    <h1 class="text-xl font-semibold mb-3">Új bhakta</h1>
    <BhaktaForm :model-value="{}" :saving="saving" @save="save" />
  </div>
</template>
