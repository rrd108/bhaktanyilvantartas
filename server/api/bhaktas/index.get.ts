/** List with search (?q=), paging and the same default filter as the old app (community roles 1,2 or no service). */
export default defineEventHandler(async event => {
  const query = getQuery(event)
  const q = String(query.q || '').trim()
  const page = Math.max(1, Number(query.page) || 1)
  const limit = Math.min(200, Number(query.limit) || 25)
  const allowed = await accessibleCenterIds(event)

  const where: string[] = []
  const params: unknown[] = []
  if (q) {
    where.push('(b.nev_avatott LIKE ? OR b.nev_szuletesi LIKE ? OR b.nev_polgari LIKE ?)')
    params.push(`%${q}%`, `%${q}%`, `%${q}%`)
  } else {
    where.push(`(b.communityrole_id IN (1, 2) OR NOT EXISTS (SELECT 1 FROM services s WHERE s.bhakta_id = b.id))`)
  }
  if (allowed) {
    const ids = allowed.length ? allowed.join(',') : '0'
    where.push(`(NOT EXISTS (SELECT 1 FROM services s WHERE s.bhakta_id = b.id) OR EXISTS (
      SELECT 1 FROM services s JOIN departments d ON d.id = s.department_id WHERE s.bhakta_id = b.id AND d.center_id IN (${ids})))`)
  }
  const w = where.length ? `WHERE ${where.join(' AND ')}` : ''
  const d = await db()
  const total = ((await d.prepare(`SELECT COUNT(*) AS n FROM bhaktas b ${w}`).get(...(params as any[]))) as any).n
  const rows = await d
    .prepare(
      `SELECT b.id, b.neme, b.nev_avatott, b.nev_polgari, b.cim_allando, b.adoazonosito, b.taj, b.szul_hely, b.szul_date, b.csalad_nev_anya
       FROM bhaktas b ${w} ORDER BY b.nev_avatott COLLATE NOCASE LIMIT ? OFFSET ?`,
    )
    .all(...(params as any[]), limit, (page - 1) * limit)
  return { rows, total, page, limit }
})
