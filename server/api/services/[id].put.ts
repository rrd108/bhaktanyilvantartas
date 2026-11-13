const COLS = ['department_id', 'szolgalat', 'szolgalat_kezdete', 'szolgalat_vege', 'szolg_megjegyzes']

export default defineEventHandler(async event => {
  const data = pickColumns(await readBody(event), COLS)
  if ('szolgalat' in data) data.szolgalat ??= ''
  if ('szolg_megjegyzes' in data) data.szolg_megjegyzes ??= ''
  await updateRow('services', idParam(event), data)
  return { ok: true }
})
