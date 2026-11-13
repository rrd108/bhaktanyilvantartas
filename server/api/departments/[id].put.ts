export default defineEventHandler(async event => {
  await updateRow('departments', idParam(event), pickColumns(await readBody(event), ['center_id', 'name', 'active'], ['active']))
  return { ok: true }
})
