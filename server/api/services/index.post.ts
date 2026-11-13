const COLS = ['bhakta_id', 'department_id', 'szolgalat', 'szolgalat_kezdete', 'szolgalat_vege', 'szolg_megjegyzes']

export default defineEventHandler(async event => {
  const data = pickColumns(await readBody(event), COLS)
  if (!data.bhakta_id || !data.department_id) throw createError({ statusCode: 422, statusMessage: 'Bhakta és osztály kötelező' })
  data.szolgalat ??= ''
  data.szolg_megjegyzes ??= ''
  return { id: await insertRow('services', data) }
})
