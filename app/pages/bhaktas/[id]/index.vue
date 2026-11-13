<script setup lang="ts">
import { BHAKTA_GROUPS } from '~~/shared/fields'

const route = useRoute()
const toast = useToast()
const isAdmin = useIsAdmin()
const id = route.params.id
const { data: bhakta, refresh } = await useFetch<Record<string, any>>(`/api/bhaktas/${id}`)
const { data: departments } = await useFetch<any[]>('/api/departments')

const display = (f: any) => {
  const v = bhakta.value?.[f.key]
  if (f.type === 'bool') return v ? 'igen' : 'nem'
  if (f.lookup) return bhakta.value?.[{ gurus: 'guru', asrams: 'asram', tbs: 'tb', legalstatuses: 'legalstatus', communityroles: 'communityrole', bhaktas: 'hazastars' }[f.lookup as string]!] ?? ''
  return v ?? ''
}

async function remove() {
  if (!confirm('Biztosan törlöd ezt a bhaktát és a szolgálatait?')) return
  await $fetch(`/api/bhaktas/${id}`, { method: 'DELETE' })
  await navigateTo('/')
}

// services
const blank = () => ({ id: 0, department_id: undefined as number | undefined, szolgalat: '', szolgalat_kezdete: '', szolgalat_vege: '', szolg_megjegyzes: '' })
const svc = ref<ReturnType<typeof blank> | null>(null)
const deptOptions = computed(() => (departments.value ?? []).map(d => ({ label: `${d.center} / ${d.name}`, value: d.id })))
async function saveService() {
  const s = svc.value!
  if (!s.department_id) return toast.add({ title: 'Válassz részleget', color: 'error' })
  const body = { ...s, bhakta_id: Number(id) }
  if (s.id) await $fetch(`/api/services/${s.id}`, { method: 'PUT', body })
  else await $fetch('/api/services', { method: 'POST', body })
  svc.value = null
  await refresh()
}
async function removeService(sid: number) {
  if (!confirm('Törlöd a szolgálatot?')) return
  await $fetch(`/api/services/${sid}`, { method: 'DELETE' })
  await refresh()
}

// end volunteering
const endDate = ref(new Date().toISOString().slice(0, 10))
const ending = ref(false)
async function endVolunteer() {
  await $fetch(`/api/bhaktas/${id}/end-volunteer`, { method: 'POST', body: { endDate: endDate.value } })
  ending.value = false
  await refresh()
}

// photo
const photoKey = ref(0)
const photoMissing = ref(false)
async function upload(e: Event) {
  const file = (e.target as HTMLInputElement).files?.[0]
  if (!file) return
  const fd = new FormData()
  fd.append('kep', file)
  try {
    await $fetch(`/api/photos/${id}`, { method: 'POST', body: fd })
    photoKey.value++
    photoMissing.value = false
    await refresh()
  } catch (err: any) {
    toast.add({ title: err?.data?.statusMessage || 'Feltöltési hiba', color: 'error' })
  }
}
</script>

<template>
  <div v-if="bhakta" class="space-y-4">
    <div class="flex flex-wrap items-center gap-3">
      <h1 class="text-xl font-semibold">{{ bhakta.nev_avatott }}</h1>
      <UBadge v-if="!bhakta.active" color="neutral" label="inaktív" />
      <div v-if="isAdmin" class="ml-auto flex gap-2">
        <UButton :to="`/bhaktas/${id}/edit`" icon="i-lucide-pencil" label="Szerkesztés" />
        <UButton icon="i-lucide-user-minus" color="warning" variant="outline" label="Önkéntesség vége" @click="ending = true" />
        <UButton icon="i-lucide-trash" color="error" variant="outline" label="Törlés" @click="remove" />
      </div>
    </div>

    <UCard>
      <div class="flex gap-4">
        <div class="w-32 shrink-0">
          <img v-if="bhakta.kep && !photoMissing" :key="photoKey" :src="`/api/photos/${id}?v=${photoKey}`" class="rounded w-32 h-40 object-cover" alt="" @error="photoMissing = true" />
          <div v-else class="w-32 h-40 rounded bg-gray-100 dark:bg-slate-800 flex items-center justify-center text-gray-400">nincs kép</div>
          <input v-if="isAdmin" type="file" accept="image/*" class="text-xs mt-2 w-32" @change="upload" />
        </div>
        <dl class="grid gap-x-6 gap-y-2 sm:grid-cols-2 flex-1 text-sm">
          <template v-for="g in BHAKTA_GROUPS.slice(0, 2)" :key="g.title">
            <template v-for="f in g.fields" :key="f.key">
              <div v-if="display(f) !== ''"><dt class="text-gray-500">{{ f.label }}</dt><dd>{{ display(f) }}</dd></div>
            </template>
          </template>
        </dl>
      </div>
    </UCard>

    <UCard v-for="g in BHAKTA_GROUPS.slice(2)" :key="g.title">
      <template #header><h2 class="font-semibold">{{ g.title }}</h2></template>
      <dl class="grid gap-x-6 gap-y-2 sm:grid-cols-2 lg:grid-cols-3 text-sm">
        <template v-for="f in g.fields" :key="f.key">
          <div v-if="display(f) !== ''" :class="f.type === 'textarea' ? 'col-span-full whitespace-pre-wrap' : ''">
            <dt class="text-gray-500">{{ f.label }}</dt><dd>{{ display(f) }}</dd>
          </div>
        </template>
      </dl>
    </UCard>

    <UCard>
      <template #header>
        <div class="flex items-center">
          <h2 class="font-semibold">Szolgálatok</h2>
          <UButton v-if="isAdmin" class="ml-auto" size="sm" icon="i-lucide-plus" label="Új szolgálat" @click="svc = blank()" />
        </div>
      </template>
      <table class="w-full text-sm">
        <thead><tr class="text-left text-gray-500"><th>Központ / részleg</th><th>Szolgálat</th><th>Kezdete</th><th>Vége</th><th>Megjegyzés</th><th /></tr></thead>
        <tbody>
          <tr v-for="s in bhakta.services" :key="s.id" class="border-t">
            <td class="py-1">{{ s.center }} / {{ s.department }}</td>
            <td>{{ s.szolgalat }}</td><td>{{ s.szolgalat_kezdete }}</td><td>{{ s.szolgalat_vege }}</td><td>{{ s.szolg_megjegyzes }}</td>
            <td v-if="isAdmin" class="text-right whitespace-nowrap">
              <UButton size="xs" variant="ghost" icon="i-lucide-pencil" @click="svc = { ...s }" />
              <UButton size="xs" variant="ghost" color="error" icon="i-lucide-trash" @click="removeService(s.id)" />
            </td>
          </tr>
        </tbody>
      </table>
    </UCard>

    <UModal :open="!!svc" title="Szolgálat" @update:open="v => !v && (svc = null)">
      <template #body>
        <div v-if="svc" class="space-y-3">
          <UFormField label="Részleg"><USelectMenu v-model="svc.department_id" :items="deptOptions" value-key="value" :search-input="{}" class="w-full" /></UFormField>
          <UFormField label="Szolgálat"><UInput v-model="svc.szolgalat" class="w-full" /></UFormField>
          <div class="grid grid-cols-2 gap-3">
            <UFormField label="Kezdete"><UInput v-model="svc.szolgalat_kezdete" type="date" class="w-full" /></UFormField>
            <UFormField label="Vége"><UInput v-model="svc.szolgalat_vege" type="date" class="w-full" /></UFormField>
          </div>
          <UFormField label="Megjegyzés"><UInput v-model="svc.szolg_megjegyzes" class="w-full" /></UFormField>
          <UButton label="Mentés" icon="i-lucide-save" @click="saveService" />
        </div>
      </template>
    </UModal>

    <UModal v-model:open="ending" title="Önkéntesség vége">
      <template #body>
        <div class="space-y-3">
          <p class="text-sm">Az utolsó szolgálat befejeződik, a közösségi szerep "volt önkéntes" lesz, a jogi státusz törlődik.</p>
          <UFormField label="Befejezés napja"><UInput v-model="endDate" type="date" /></UFormField>
          <UButton label="Rögzítés" @click="endVolunteer" />
        </div>
      </template>
    </UModal>
  </div>
</template>
