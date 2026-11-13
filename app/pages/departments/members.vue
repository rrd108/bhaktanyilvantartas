<script setup lang="ts">
const isAdmin = useIsAdmin()
const toast = useToast()
const today = new Date().toISOString().slice(0, 10)
const date = ref(today)
const centerId = useCenter()
const { data, refresh } = await useFetch<{ departments: any[]; volunteers: number; missionaries: number }>('/api/departments/members', {
  query: { date, center_id: centerId },
})

// drag & drop: move a bhakta into another department = new service starting on a chosen date
const dragged = ref<{ bhaktaId: number; from: number } | null>(null)
const over = ref<number | null>(null)

function onDragStart(e: DragEvent, bhaktaId: number, from: number) {
  dragged.value = { bhaktaId, from }
  e.dataTransfer?.setData('text/plain', String(bhaktaId))
  if (e.dataTransfer) e.dataTransfer.effectAllowed = 'move'
}

async function onDrop(departmentId: number) {
  over.value = null
  const d = dragged.value
  dragged.value = null
  if (!d || d.from === departmentId) return
  const begin = prompt('Add meg az új szolgálat kezdetét', today)
  if (begin === null) return
  if (!/^\d{4}-(0[1-9]|1[012])-(0[1-9]|[12]\d|3[01])$/.test(begin)) {
    return toast.add({ title: 'Nem megfelelő dátum formátum! (ÉÉÉÉ-HH-NN)', color: 'error' })
  }
  try {
    await $fetch('/api/services', { method: 'POST', body: { bhakta_id: d.bhaktaId, department_id: departmentId, szolgalat_kezdete: begin } })
    toast.add({ title: 'Szolgálat sikeresen hozzáadva!', color: 'success' })
    await refresh()
  } catch {
    toast.add({ title: 'Nem lehetett a szolgálatot hozzáadni, próbáld később!', color: 'error' })
  }
}
</script>

<template>
  <div>
    <div class="flex flex-wrap items-center gap-3 mb-3">
      <h1 class="text-xl font-semibold">Átírós lista</h1>
      <UInput v-model="date" type="date" />
      <UButton v-if="isAdmin" to="/departments" icon="i-lucide-settings" label="Osztályok kezelése" color="neutral" variant="outline" class="ml-auto" />
    </div>
    <p v-if="isAdmin" class="text-xs text-gray-500 mb-3">Húzd a nevet egy másik osztályra: új szolgálat jön létre a megadott kezdettel.</p>
    <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-3">
      <UCard
        v-for="dep in data?.departments"
        :key="dep.id"
        :class="over === dep.id ? 'ring-2 ring-primary' : ''"
        @dragover.prevent="isAdmin && (over = dep.id)"
        @dragleave="over === dep.id && (over = null)"
        @drop.prevent="isAdmin && onDrop(dep.id)"
      >
        <template #header>
          <strong>{{ dep.name }} ({{ dep.manpower }})</strong>
          <div class="text-xs text-gray-500">{{ dep.center }}</div>
        </template>
        <ol class="text-sm space-y-1">
          <li
            v-for="m in dep.members"
            :key="m.bhakta_id"
            :draggable="isAdmin"
            :class="isAdmin ? 'cursor-grab' : ''"
            @dragstart="onDragStart($event, m.bhakta_id, dep.id)"
          >
            <NuxtLink :to="`/bhaktas/${m.bhakta_id}`" class="text-primary" :title="m.role === 1 ? 'misszionárius' : 'önkéntes'">{{ m.role === 1 ? '✔' : '➤' }}</NuxtLink>
            {{ m.name }}<span v-if="m.recent" title="nemrég kezdődött / hamarosan kezdődik"> ✩</span>
          </li>
        </ol>
      </UCard>
    </div>
    <p v-if="data" class="mt-4 text-sm">{{ data.volunteers }} önkéntes, {{ data.missionaries }} misszionárius, Összesen: {{ data.volunteers + data.missionaries }}</p>
  </div>
</template>
