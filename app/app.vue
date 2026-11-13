<script setup lang="ts">
const { user, logout } = useAuthentication()
const isAdmin = computed(() => user.value?.role === 'admin')
const centerId = useCenter()
const { data: centers, refresh: loadCenters } = await useFetch<{ id: number; name: string }[]>('/api/lookups/centers', { immediate: !!user.value, watch: false })
watch(user, u => { if (u) loadCenters() })
const centerItems = computed(() => [{ label: 'Minden központ', value: 0 }, ...(centers.value ?? []).map(c => ({ label: c.name, value: c.id }))])
const selectedCenter = computed({
  get: () => centerId.value ?? 0,
  set: v => (centerId.value = v || null),
})

const links = computed(() => [
  { label: 'Átírós lista', to: '/departments/members', icon: 'i-lucide-arrow-left-right' },
  { label: 'Bhakták', to: '/', icon: 'i-lucide-users' },
  { label: 'Keresés', to: '/bhaktas/search', icon: 'i-lucide-search' },
  ...(isAdmin.value
    ? [
        { label: 'Törzsadatok', to: '/lookups/gurus', icon: 'i-lucide-database' },
        { label: 'Felhasználók', to: '/users', icon: 'i-lucide-users-round' },
      ]
    : []),
])

async function doLogout() {
  await logout()
  await navigateTo('/login')
}
</script>

<template>
  <UApp>
    <header v-if="user" class="print:hidden border-b bg-white dark:bg-slate-900 sticky top-0 z-10">
      <div class="max-w-7xl mx-auto px-3 py-2 flex flex-wrap items-center gap-2">
        <span class="font-semibold mr-2">Bhaktanyilvántartás</span>
        <UButton v-for="l in links" :key="l.to" :to="l.to" :icon="l.icon" :label="l.label" color="neutral" variant="ghost" size="sm" />
        <div class="ml-auto flex items-center gap-2">
          <ClientOnly>
            <USelectMenu v-model="selectedCenter" :items="centerItems" value-key="value" size="sm" class="w-44" aria-label="Központ" />
          </ClientOnly>
          <NuxtLink to="/profile" class="text-sm text-gray-500 hover:text-primary underline-offset-2 hover:underline" title="Profil és jelszó módosítása">{{ user.email }}</NuxtLink>
          <UButton icon="i-lucide-log-out" label="Kilépés" color="neutral" variant="outline" size="sm" @click="doLogout" />
        </div>
      </div>
    </header>
    <main class="max-w-7xl mx-auto p-3 print:max-w-none print:p-0">
      <NuxtPage />
    </main>
  </UApp>
</template>
