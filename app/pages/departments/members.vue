<script setup lang="ts">
const isAdmin = useIsAdmin()
const date = ref(new Date().toISOString().slice(0, 10))
const { data } = await useFetch<any[]>('/api/departments/members', { query: { date } })
</script>

<template>
  <div>
    <div class="flex flex-wrap items-center gap-3 mb-3">
      <h1 class="text-xl font-semibold">Részlegek létszáma</h1>
      <UInput v-model="date" type="date" />
      <UButton v-if="isAdmin" to="/departments" icon="i-lucide-settings" label="Részlegek kezelése" color="neutral" variant="outline" class="ml-auto" />
    </div>
    <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-3">
      <UCard v-for="d in data" :key="d.id">
        <template #header>
          <div class="flex items-center"><strong>{{ d.name }}</strong><UBadge class="ml-auto" :label="`${d.manpower} fő`" /></div>
          <div class="text-xs text-gray-500">{{ d.center }}</div>
        </template>
        <ul class="text-sm">
          <li v-for="m in d.members" :key="m.id">
            <NuxtLink :to="`/bhaktas/${m.bhakta_id}`" class="text-primary">{{ m.nev_avatott }}</NuxtLink>
            <span v-if="m.szolgalat" class="text-gray-500"> – {{ m.szolgalat }}</span>
          </li>
          <li v-if="!d.members.length" class="text-gray-400">senki</li>
        </ul>
      </UCard>
    </div>
  </div>
</template>
