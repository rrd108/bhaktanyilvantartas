<script setup lang="ts">
import { BHAKTA_GROUPS } from '~~/shared/fields'

const props = defineProps<{ modelValue: Record<string, any>; saving?: boolean }>()
const emit = defineEmits<{ save: [value: Record<string, any>] }>()
const form = reactive<Record<string, any>>({ neme: 0, active: 1, ...props.modelValue })

const lookupNames = [...new Set(BHAKTA_GROUPS.flatMap(g => g.fields.filter(f => f.lookup).map(f => f.lookup!)))]
const options = reactive<Record<string, { label: string; value: number }[]>>({})
await Promise.all(
  lookupNames.map(async n => {
    const rows = await $fetch<{ id: number; name: string }[]>(`/api/lookups/${n}`)
    options[n] = rows.map(r => ({ label: r.name, value: r.id }))
  }),
)
</script>

<template>
  <form class="space-y-6" @submit.prevent="emit('save', { ...form })">
    <UCard v-for="g in BHAKTA_GROUPS" :key="g.title">
      <template #header><h2 class="font-semibold">{{ g.title }}</h2></template>
      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <UFormField v-for="f in g.fields" :key="f.key" :label="f.label" :class="f.type === 'textarea' ? 'sm:col-span-2 lg:col-span-3' : ''">
          <UCheckbox v-if="f.type === 'bool'" :model-value="!!form[f.key]" @update:model-value="form[f.key] = $event ? 1 : 0" />
          <UTextarea v-else-if="f.type === 'textarea'" v-model="form[f.key]" :rows="4" class="w-full" />
          <USelectMenu
            v-else-if="f.type === 'select'"
            v-model="form[f.key]"
            :items="options[f.lookup!] ?? []"
            value-key="value"
            :search-input="{}"
            placeholder="—"
            class="w-full"
          />
          <UInput v-else v-model="form[f.key]" :type="f.type === 'date' ? 'date' : f.type === 'time' ? 'time' : 'text'" class="w-full" />
        </UFormField>
      </div>
    </UCard>
    <div class="flex gap-2">
      <UButton type="submit" icon="i-lucide-save" label="Mentés" :loading="saving" />
      <UButton type="button" color="neutral" variant="outline" label="Mégse" @click="$router.back()" />
    </div>
  </form>
</template>
