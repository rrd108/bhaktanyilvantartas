<script setup lang="ts">
const { user: me } = useAuthentication()
const toast = useToast()
const { data: users, refresh } = await useFetch<any[]>('/api/users')
const { data: centers } = await useFetch<{ id: number; name: string }[]>('/api/lookups/centers')
const centerItems = computed(() => (centers.value ?? []).map(c => ({ label: c.name, value: c.id })))
const centerNames = (ids: number[]) => ids.map(id => centers.value?.find(c => c.id === id)?.name).filter(Boolean).join(', ')

const ROLES = [
  { label: 'Admin (mindent szerkeszthet)', value: 'admin' },
  { label: 'Felhasználó (csak olvasás, saját központok)', value: 'user' },
]
const roleLabel = (r: string) => (r === 'admin' ? 'Admin' : 'Felhasználó')

const TRANSLATIONS: Record<string, string> = {
  'Email already exists.': 'Ez az e-mail cím már foglalt.',
  'Invalid role': 'Érvénytelen szerepkör.',
}
const RULES: Record<string, string> = {
  minLength: 'legalább 8 karakter', uppercase: 'nagybetű', lowercase: 'kisbetű', numbers: 'szám', specialChars: 'speciális karakter (pl. # ! ?)',
}
function friendly(e: any) {
  const m: string = e?.data?.statusMessage || e?.statusMessage || 'Hiba'
  if (m.includes('Password validation failed')) {
    const missing = [...m.matchAll(/errors\.(\w+)/g)].map(x => RULES[x[1]!] ?? x[1])
    return `A jelszó nem elég erős, hiányzik: ${missing.join(', ')}.`
  }
  const known = Object.keys(TRANSLATIONS).find(k => m.includes(k))
  return known ? TRANSLATIONS[known]! : m
}

type Form = { id?: number; name: string; email: string; role: string; active: boolean; password: string; center_ids: number[] }
const edit = ref<Form | null>(null)
const saving = ref(false)
const error = ref('')
const showPw = ref(false)

const openNew = () => { error.value = ''; edit.value = { name: '', email: '', role: 'user', active: true, password: '', center_ids: [] } }
const openEdit = (u: any) => { error.value = ''; edit.value = { id: u.id, name: u.name, email: u.email, role: u.role, active: u.active, password: '', center_ids: [...u.center_ids] } }

async function save() {
  const f = edit.value!
  saving.value = true
  error.value = ''
  try {
    let id = f.id
    if (id) {
      await $fetch(`/api/nuxt-users/${id}`, { method: 'PATCH', body: { name: f.name, email: f.email, role: f.role, ...(id === me.value?.id ? {} : { active: f.active }) } })
    } else {
      const res = await $fetch<{ user: { id: number } }>('/api/nuxt-users', { method: 'POST', body: { name: f.name, email: f.email, role: f.role, password: f.password } })
      id = res.user.id
      if (!f.active) await $fetch(`/api/nuxt-users/${id}`, { method: 'PATCH', body: { active: false } })
    }
    await $fetch(`/api/users/${id}/centers`, { method: 'PUT', body: { center_ids: f.role === 'admin' ? [] : f.center_ids } })
    edit.value = null
    toast.add({ title: 'Mentve', color: 'success' })
    await refresh()
  } catch (e: any) {
    error.value = friendly(e)
  } finally {
    saving.value = false
  }
}

// password reset
const pw = ref<{ id: number; name: string; password: string } | null>(null)
const pwError = ref('')
async function setPassword() {
  pwError.value = ''
  try {
    await $fetch(`/api/users/${pw.value!.id}/password`, { method: 'POST', body: { password: pw.value!.password } })
    toast.add({ title: 'Az új jelszó beállítva, a felhasználó kijelentkezett mindenhol', color: 'success' })
    pw.value = null
  } catch (e: any) {
    pwError.value = friendly(e)
  }
}

async function remove(u: any) {
  if (!confirm(`Biztosan törlöd: ${u.name} (${u.email})?`)) return
  try {
    await $fetch(`/api/users/${u.id}`, { method: 'DELETE' })
    await refresh()
  } catch (e: any) {
    toast.add({ title: friendly(e), color: 'error' })
  }
}
</script>

<template>
  <div>
    <div class="flex items-center mb-3">
      <h1 class="text-xl font-semibold">Felhasználók</h1>
      <UButton class="ml-auto" icon="i-lucide-user-plus" label="Új felhasználó" @click="openNew" />
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead><tr class="text-left text-gray-500"><th>Név</th><th>E-mail</th><th>Szerepkör</th><th>Központok</th><th>Aktív</th><th /></tr></thead>
        <tbody>
          <tr v-for="u in users" :key="u.id" class="border-t" :class="u.active ? '' : 'opacity-50'">
            <td class="py-1.5">{{ u.name }}<span v-if="u.id === me?.id" class="text-xs text-gray-500"> (te)</span></td>
            <td>{{ u.email }}</td>
            <td><UBadge :color="u.role === 'admin' ? 'primary' : 'neutral'" variant="subtle" :label="roleLabel(u.role)" /></td>
            <td>{{ u.role === 'admin' ? 'mind' : centerNames(u.center_ids) || '— (nincs hozzáférés)' }}</td>
            <td>{{ u.active ? 'igen' : 'nem' }}</td>
            <td class="text-right whitespace-nowrap">
              <UButton size="xs" variant="ghost" icon="i-lucide-pencil" title="Szerkesztés" @click="openEdit(u)" />
              <UButton size="xs" variant="ghost" icon="i-lucide-key-round" title="Új jelszó" @click="pw = { id: u.id, name: u.name, password: '' }; pwError = ''" />
              <UButton v-if="u.id !== me?.id" size="xs" variant="ghost" color="error" icon="i-lucide-trash" title="Törlés" @click="remove(u)" />
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <UModal :open="!!edit" :title="edit?.id ? 'Felhasználó szerkesztése' : 'Új felhasználó'" @update:open="v => !v && (edit = null)">
      <template #body>
        <form v-if="edit" class="space-y-3" @submit.prevent="save">
          <UFormField label="Név"><UInput v-model="edit.name" required class="w-full" /></UFormField>
          <UFormField label="E-mail"><UInput v-model="edit.email" type="email" required class="w-full" /></UFormField>
          <UFormField v-if="!edit.id" label="Jelszó" help="Legalább 8 karakter, nagybetű, kisbetű, szám és speciális karakter.">
            <UInput v-model="edit.password" :type="showPw ? 'text' : 'password'" autocomplete="new-password" required class="w-full" />
          </UFormField>
          <UCheckbox v-if="!edit.id" v-model="showPw" label="Jelszó megjelenítése" />
          <UFormField label="Szerepkör">
            <USelectMenu v-model="edit.role" :items="ROLES" value-key="value" :disabled="edit.id === me?.id" class="w-full" />
          </UFormField>
          <UFormField v-if="edit.role !== 'admin'" label="Központok" help="Csak ezeknek a központoknak az adatait látja.">
            <USelectMenu v-model="edit.center_ids" :items="centerItems" value-key="value" multiple placeholder="Válassz központot…" class="w-full" />
          </UFormField>
          <UCheckbox v-model="edit.active" label="Aktív (be tud lépni)" :disabled="edit.id === me?.id" />
          <p v-if="error" class="text-sm text-red-600">{{ error }}</p>
          <UButton type="submit" icon="i-lucide-save" label="Mentés" :loading="saving" />
        </form>
      </template>
    </UModal>

    <UModal :open="!!pw" :title="`Új jelszó: ${pw?.name}`" @update:open="v => !v && (pw = null)">
      <template #body>
        <form v-if="pw" class="space-y-3" @submit.prevent="setPassword">
          <UFormField label="Új jelszó" help="Legalább 8 karakter, nagybetű, kisbetű, szám és speciális karakter.">
            <UInput v-model="pw.password" type="text" autocomplete="off" required class="w-full" />
          </UFormField>
          <p v-if="pwError" class="text-sm text-red-600">{{ pwError }}</p>
          <UButton type="submit" icon="i-lucide-key-round" label="Beállítás" />
        </form>
      </template>
    </UModal>
  </div>
</template>
