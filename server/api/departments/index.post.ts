export default defineEventHandler(async event => {
  const data = pickColumns(await readBody(event), ['center_id', 'name', 'active'], ['active'])
  if (!data.center_id || !data.name) throw createError({ statusCode: 422, statusMessage: 'Központ és név kötelező' })
  return { id: await insertRow('departments', data) }
})
