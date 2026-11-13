<script setup lang="ts">
const { user } = useAuthentication()
const toast = useToast()

const form = reactive({ currentPassword: '', newPassword: '', newPasswordConfirmation: '' })
const saving = ref(false)
const error = ref('')
const show = ref(false)

const TRANSLATIONS: Record<string, string> = {
  'Current password is incorrect': 'A jelenlegi jelszó hibás.',
  'New password confirmation does not match': 'A két új jelszó nem egyezik.',
  'Current password is required': 'Add meg a jelenlegi jelszavad.',
  'New password is required': 'Add meg az új jelszót.',
}
const RULES: Record<string, string> = {
  minLength: 'legalább 8 karakter',
  uppercase: 'nagybetű',
  lowercase: 'kisbetű',
  numbers: 'szám',
  specialChars: 'speciális karakter (pl. # ! ?)',
}

const friendly = (message: string) => {
  if (TRANSLATIONS[message]) return TRANSLATIONS[message]
  if (message.startsWith('Password validation failed')) {
    const missing = [...message.matchAll(/errors\.(\w+)/g)].map(m => RULES[m[1]!] ?? m[1])
    return `Az új jelszó nem elég erős, hiányzik: ${missing.join(', ') || message}.`
  }
  return message
}

async function save() {
  error.value = ''
  if (form.newPassword !== form.newPasswordConfirmation) {
    error.value = 'A két új jelszó nem egyezik.'
    return
  }
  saving.value = true
  try {
    await $fetch('/api/nuxt-users/password', { method: 'PATCH', body: { ...form } })
    toast.add({ title: 'A jelszavad megváltozott.', color: 'success' })
    Object.assign(form, { currentPassword: '', newPassword: '', newPasswordConfirmation: '' })
  } catch (e: any) {
    error.value = friendly(e?.data?.statusMessage || e?.statusMessage || 'Hiba a jelszó módosításakor')
  } finally {
    saving.value = false
  }
}
</script>

<template>
  <div class="max-w-md">
    <h1 class="text-xl font-semibold mb-1">Profil</h1>
    <p class="text-sm text-gray-500 mb-4">{{ user?.email }} · {{ user?.role }}</p>
    <UCard>
      <template #header><h2 class="font-semibold">Jelszó módosítása</h2></template>
      <form class="space-y-4" @submit.prevent="save">
        <UFormField label="Jelenlegi jelszó">
          <UInput v-model="form.currentPassword" :type="show ? 'text' : 'password'" autocomplete="current-password" required class="w-full" />
        </UFormField>
        <UFormField label="Új jelszó" help="Legalább 8 karakter, nagybetű, kisbetű, szám és speciális karakter.">
          <UInput v-model="form.newPassword" :type="show ? 'text' : 'password'" autocomplete="new-password" required class="w-full" />
        </UFormField>
        <UFormField label="Új jelszó újra">
          <UInput v-model="form.newPasswordConfirmation" :type="show ? 'text' : 'password'" autocomplete="new-password" required class="w-full" />
        </UFormField>
        <UCheckbox v-model="show" label="Jelszavak megjelenítése" />
        <p v-if="error" class="text-sm text-red-600">{{ error }}</p>
        <UButton type="submit" icon="i-lucide-key-round" label="Jelszó módosítása" :loading="saving" />
      </form>
    </UCard>
  </div>
</template>
