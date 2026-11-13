<script setup lang="ts">
const isAdmin = useIsAdmin()
const q = ref('')
const page = ref(1)
const debounced = ref('')
let timer: ReturnType<typeof setTimeout>
watch(q, v => {
  clearTimeout(timer)
  timer = setTimeout(() => { debounced.value = v; page.value = 1 }, 300)
})

const { data, status } = await useFetch('/api/bhaktas', { query: { q: debounced, page } })

const columns = [
  { accessorKey: 'nev_avatott', header: 'Avatott név' },
  { accessorKey: 'nev_polgari', header: 'Polgári név' },
  { accessorKey: 'cim_allando', header: 'Állandó lakcím' },
  { accessorKey: 'szul_hely', header: 'Szül. hely' },
  { accessorKey: 'szul_date', header: 'Szül. dátum' },
]
</script>

<template>
  <div>
    <div class="flex items-center gap-3 mb-3">
      <h1 class="text-xl font-semibold">Bhakták</h1>
      <UInput v-model="q" icon="i-lucide-search" placeholder="Keresés névre…" class="flex-1 max-w-sm" />
      <UButton v-if="isAdmin" to="/bhaktas/new" icon="i-lucide-plus" label="Új bhakta" class="ml-auto" />
    </div>
    <p v-if="!q" class="text-xs text-gray-500 mb-2">Alapból a közösségi szerep 1/2 és a szolgálat nélküliek látszanak; keresésnél mindenki.</p>
    <UTable :data="data?.rows ?? []" :columns="columns" :loading="status === 'pending'">
      <template #nev_avatott-cell="{ row }">
        <NuxtLink :to="`/bhaktas/${row.original.id}`" class="font-medium text-primary">{{ row.original.nev_avatott }}</NuxtLink>
      </template>
    </UTable>
    <Pager v-if="data" v-model="page" :total="data.total" :limit="data.limit" />
  </div>
</template>
