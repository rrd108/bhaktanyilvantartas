<script setup lang="ts">
const { login } = useAuthentication()
const onSuccess = (user: unknown) => {
  login(user as never)
  navigateTo('/')
}
</script>

<template>
  <div class="min-h-[80vh] flex items-center justify-center">
    <UCard class="w-full max-w-md">
      <NUsersLoginForm title="Bhaktanyilvántartás" @success="onSuccess" />
    </UCard>
  </div>
</template>
