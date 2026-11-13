import { COMMUNITY_ROLE_VOLUNTEER } from '~~/shared/fields'

/** Volunteers (role 2) aged 17 or over, ordered by the start of their first service. */
export default defineEventHandler(async event => {
  const page = Math.max(1, Number(getQuery(event).page) || 1)
  const d = await db()
  const where = `b.communityrole_id = ? AND b.szul_date < date('now', '-17 years')`
  const total = ((await d.prepare(`SELECT COUNT(*) AS n FROM bhaktas b WHERE ${where}`).get(COMMUNITY_ROLE_VOLUNTEER)) as any).n
  const rows = await d
    .prepare(
      `SELECT b.id, b.nev_avatott, b.nev_polgari, (SELECT MIN(szolgalat_kezdete) FROM services s WHERE s.bhakta_id = b.id) AS start
       FROM bhaktas b WHERE ${where} ORDER BY start LIMIT 25 OFFSET ?`,
    )
    .all(COMMUNITY_ROLE_VOLUNTEER, (page - 1) * 25)
  return { rows, total, page, limit: 25 }
})
