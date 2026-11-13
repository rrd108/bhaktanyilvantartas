export const useIsAdmin = () => {
  const { user } = useAuthentication()
  return computed(() => user.value?.role === 'admin')
}
