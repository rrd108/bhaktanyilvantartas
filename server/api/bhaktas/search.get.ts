import { BHAKTA_COLUMNS } from '~~/shared/fields'

const RELATIONS: Record<string, string> = { '=': '=', '!=': '!=', '<': '<', '>': '>', '<=': '<=', '>=': '>=', like: 'LIKE', null: 'IS NULL', notnull: 'IS NOT NULL' }

/** Search on any single field: ?field=&relation=&term= */
export default defineEventHandler(async event => {
  const { field, relation, term } = getQuery(event) as Record<string, string>
  if (!BHAKTA_COLUMNS.includes(field)) throw createError({ statusCode: 400, statusMessage: 'Ismeretlen mező' })
  const op = RELATIONS[relation]
  if (!op) throw createError({ statusCode: 400, statusMessage: 'Ismeretlen reláció' })
  const d = await db()
  const nullary = op.includes('NULL')
  const value = op === 'LIKE' ? `%${term}%` : term
  const sql = `SELECT id, nev_avatott, nev_polgari, ${field === 'nev_avatott' || field === 'nev_polgari' ? '1' : field} AS value FROM bhaktas WHERE ${field} ${op}${nullary ? '' : ' ?'} ORDER BY nev_avatott LIMIT 500`
  return nullary ? d.prepare(sql).all() : d.prepare(sql).all(value)
})
