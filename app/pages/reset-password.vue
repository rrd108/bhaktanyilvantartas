<script setup lang="ts">
// Target of the link in the password reset e-mail (nuxt-users sends /reset-password?token=...&email=...).
// Public page: listed in nuxt-users PUBLIC_PAGES, so it works without logging in.
const route = useRoute()
const token = computed(() => String(route.query.token ?? ''))
const email = computed(() => String(route.query.email ?? ''))
const hasLink = computed(() => !!token.value && !!email.value)

const form = reactive({ password: '', passwordConfirmation: '' })
const show = ref(false)
const saving = ref(false)
const error = ref('')
const done = ref(false)

const TRANSLATIONS: Record<string, string> = {
  'Passwords do not match.': 'A két jelszó nem egyezik.',
  'Password is required.': 'Add meg az új jelszót.',
  'Invalid or expired token, or email mismatch. Please request a new password reset link.':
    'A visszaállító link érvénytelen vagy lejárt. Kérj újat a bejelentkező oldalon.',
  'An internal server error occurred.': 'Szerver hiba történt. Próbáld újra később.',
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
  if (form.password !== form.passwordConfirmation) {
    error.value = 'A két jelszó nem egyezik.'
    return
  }
  saving.value = true
  try {
    await $fetch('/api/nuxt-users/password/reset', {
      method: 'POST',
      body: {
        token: token.value,
        email: email.value,
        password: form.password,
        password_confirmation: form.passwordConfirmation,
      },
    })
    done.value = true
    Object.assign(form, { password: '', passwordConfirmation: '' })
  } catch (e: any) {
    error.value = friendly(e?.data?.statusMessage || e?.statusMessage || 'Hiba a jelszó visszaállításakor')
  } finally {
    saving.value = false
  }
}
</script>

<template>
  <div class="min-h-[80vh] flex items-center justify-center">
    <UCard class="w-full max-w-md">
      <template #header>
        <h1 class="text-lg font-semibold">Új jelszó beállítása</h1>
      </template>

      <div v-if="done" class="space-y-4">
        <p class="text-sm">A jelszavad megváltozott. Most már bejelentkezhetsz az új jelszóval.</p>
        <UButton to="/login" label="Tovább a bejelentkezéshez" icon="i-lucide-log-in" block />
      </div>

      <div v-else-if="!hasLink" class="space-y-4">
        <p class="text-sm text-red-600">Hiányzik a visszaállító link adata. Használd a levélben kapott linket.</p>
        <p class="text-sm">Új linket a bejelentkező oldalon kérhetsz („Elfelejtetted a jelszavad?”).</p>
        <UButton to="/login" label="Vissza a bejelentkezéshez" variant="outline" block />
      </div>

      <form v-else class="space-y-4" @submit.prevent="save">
        <p class="text-sm text-gray-500">{{ email }}</p>
        <UFormField label="Új jelszó" help="Legalább 8 karakter, nagybetű, kisbetű, szám és speciális karakter.">
          <UInput v-model="form.password" :type="show ? 'text' : 'password'" autocomplete="new-password" required class="w-full" />
        </UFormField>
        <UFormField label="Új jelszó újra">
          <UInput v-model="form.passwordConfirmation" :type="show ? 'text' : 'password'" autocomplete="new-password" required class="w-full" />
        </UFormField>
        <UCheckbox v-model="show" label="Jelszavak megjelenítése" />
        <p v-if="error" class="text-sm text-red-600">{{ error }}</p>
        <UButton type="submit" icon="i-lucide-key-round" label="Jelszó mentése" :loading="saving" block />
      </form>
    </UCard>
  </div>
</template>
