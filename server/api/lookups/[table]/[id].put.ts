import { LOOKUPS, type LookupTable } from '~~/shared/fields'

export default defineEventHandler(async event => {
  const table = getRouterParam(event, 'table') as LookupTable
  if (!(table in LOOKUPS)) throw createError({ statusCode: 404 })
  const data = pickColumns(await readBody(event), [...LOOKUPS[table].columns])
  if (!data.name) throw createError({ statusCode: 422, statusMessage: 'A név kötelező' })
  await updateRow(table, idParam(event), data)
  return { ok: true }
})
