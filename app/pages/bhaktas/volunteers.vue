<script setup lang="ts">
const page = ref(1)
const { data } = await useFetch('/api/bhaktas/volunteers', { query: { page } })
</script>

<template>
  <div>
    <h1 class="text-xl font-semibold mb-3">Önkéntesek (17 év felett)</h1>
    <UTable :data="data?.rows ?? []" :columns="[{ accessorKey: 'nev_avatott', header: 'Avatott név' }, { accessorKey: 'nev_polgari', header: 'Polgári név' }, { accessorKey: 'start', header: 'Szolgálat kezdete' }]">
      <template #nev_avatott-cell="{ row }"><NuxtLink :to="`/bhaktas/${row.original.id}`" class="text-primary">{{ row.original.nev_avatott }}</NuxtLink></template>
    </UTable>
    <Pager v-if="data" v-model="page" :total="data.total" :limit="data.limit" />
  </div>
</template>
