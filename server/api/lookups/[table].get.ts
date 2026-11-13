import { LOOKUPS } from '~~/shared/fields'

export default defineEventHandler(async event => {
  const table = getRouterParam(event, 'table') as string
  const d = await db()
  if (table === 'bhaktas') {
    return d.prepare('SELECT id, nev_avatott AS name FROM bhaktas ORDER BY nev_avatott').all()
  }
  if (!(table in LOOKUPS)) throw createError({ statusCode: 404 })
  return d.prepare(`SELECT * FROM ${table} ORDER BY name`).all()
})
