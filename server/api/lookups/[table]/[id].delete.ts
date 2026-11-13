import { LOOKUPS } from '~~/shared/fields'

export default defineEventHandler(async event => {
  const table = getRouterParam(event, 'table') as string
  if (!(table in LOOKUPS)) throw createError({ statusCode: 404 })
  try {
    await (await db()).prepare(`DELETE FROM ${table} WHERE id = ?`).run(idParam(event))
  } catch {
    throw createError({ statusCode: 409, statusMessage: 'Az elem használatban van, nem törölhető' })
  }
  return { ok: true }
})
