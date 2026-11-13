<script setup lang="ts">
defineProps<{ total: number; limit: number }>()
const page = defineModel<number>({ required: true })
</script>

<template>
  <div class="flex items-center justify-between mt-3 text-sm">
    <span>{{ total }} találat</span>
    <UPagination v-model:page="page" :total="total" :items-per-page="limit" />
  </div>
</template>
