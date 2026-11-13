<script setup lang="ts">
import { BHAKTA_GROUPS } from '~~/shared/fields'

const fields = BHAKTA_GROUPS.flatMap(g => g.fields).map(f => ({ label: f.label, value: f.key }))
const relations = [
  { label: 'egyenlő', value: '=' }, { label: 'nem egyenlő', value: '!=' }, { label: 'tartalmazza', value: 'like' },
  { label: 'kisebb', value: '<' }, { label: 'nagyobb', value: '>' }, { label: 'üres', value: 'null' }, { label: 'nem üres', value: 'notnull' },
]
const form = reactive({ field: 'nev_avatott', relation: 'like', term: '' })
const rows = ref<any[] | null>(null)
const error = ref('')
async function search() {
  error.value = ''
  try {
    rows.value = await $fetch<any[]>('/api/bhaktas/search', { query: form })
  } catch (e: any) {
    error.value = e?.data?.statusMessage || 'Hiba'
  }
}
</script>

<template>
  <div>
    <h1 class="text-xl font-semibold mb-3">Keresés mezőre</h1>
    <form class="flex flex-wrap gap-2 mb-4" @submit.prevent="search">
      <USelectMenu v-model="form.field" :items="fields" value-key="value" :search-input="{}" class="w-64" />
      <USelectMenu v-model="form.relation" :items="relations" value-key="value" class="w-40" />
      <UInput v-model="form.term" placeholder="Érték" :disabled="['null', 'notnull'].includes(form.relation)" />
      <UButton type="submit" icon="i-lucide-search" label="Keresés" />
    </form>
    <p v-if="error" class="text-red-600">{{ error }}</p>
    <UTable v-if="rows" :data="rows" :columns="[{ accessorKey: 'nev_avatott', header: 'Név' }, { accessorKey: 'value', header: 'Érték' }]">
      <template #nev_avatott-cell="{ row }"><NuxtLink :to="`/bhaktas/${row.original.id}`" class="text-primary">{{ row.original.nev_avatott }}</NuxtLink></template>
    </UTable>
    <p v-if="rows" class="text-sm mt-2">{{ rows.length }} találat (max. 500)</p>
  </div>
</template>
