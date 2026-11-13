const KEY = 'bhakta.centerId'

/** Restore the saved centre before the app mounts and keep localStorage in sync. */
export default defineNuxtPlugin(() => {
  const centerId = useCenter()
  try {
    const saved = Number(localStorage.getItem(KEY))
    if (Number.isInteger(saved) && saved > 0) centerId.value = saved
  } catch {}
  watch(centerId, v => {
    try {
      if (v) localStorage.setItem(KEY, String(v))
      else localStorage.removeItem(KEY)
    } catch {}
  })
})
