<script setup lang="ts">
const page = ref(1)
const { data } = await useFetch('/api/bhaktas/eucard', { query: { page } })
</script>

<template>
  <div>
    <h1 class="text-xl font-semibold mb-3">Lejárt vagy ismeretlen EU-kártya</h1>
    <UTable :data="data?.rows ?? []" :columns="[{ accessorKey: 'nev_avatott', header: 'Név' }, { accessorKey: 'eu_card_expiry', header: 'Lejárat' }]">
      <template #nev_avatott-cell="{ row }"><NuxtLink :to="`/bhaktas/${row.original.id}`" class="text-primary">{{ row.original.nev_avatott }}</NuxtLink></template>
    </UTable>
    <Pager v-if="data" v-model="page" :total="data.total" :limit="data.limit" />
  </div>
</template>
