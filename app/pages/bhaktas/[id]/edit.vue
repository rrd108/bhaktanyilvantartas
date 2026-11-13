<script setup lang="ts">
const route = useRoute()
const toast = useToast()
const { data: bhakta } = await useFetch<Record<string, any>>(`/api/bhaktas/${route.params.id}`)
const saving = ref(false)
async function save(value: Record<string, any>) {
  saving.value = true
  try {
    await $fetch(`/api/bhaktas/${route.params.id}`, { method: 'PUT', body: value })
    await navigateTo(`/bhaktas/${route.params.id}`)
  } catch (e: any) {
    toast.add({ title: e?.data?.statusMessage || 'Hiba a mentéskor', color: 'error' })
  } finally {
    saving.value = false
  }
}
</script>

<template>
  <div v-if="bhakta">
    <h1 class="text-xl font-semibold mb-3">{{ bhakta.nev_avatott }} szerkesztése</h1>
    <BhaktaForm :model-value="bhakta" :saving="saving" @save="save" />
  </div>
</template>
