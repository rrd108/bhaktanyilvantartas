export type MemberRow = {
  service_id: number
  start: string
  department_id: number
  department: string
  center: string
  bhakta_id: number
  name: string
  role: number
  recent: number
}

export const isoDate = (value: unknown) => {
  const date = String(value || new Date().toISOString().slice(0, 10))
  if (!/^\d{4}-\d{2}-\d{2}$/.test(date)) throw createError({ statusCode: 400, statusMessage: 'Érvénytelen dátum' })
  return date
}

/**
 * Current members on a date, as in the old app: each active missionary (role 1) / volunteer (role 2)
 * counts in the department of their latest-started service on or before the date (end date ignored).
 * centerIds: null = every centre.
 */
export async function currentMembers(date: string, centerIds: number[] | null): Promise<MemberRow[]> {
  const ids = centerIds ? (centerIds.length ? centerIds.map(Number).join(',') : '0') : null
  const d = await db()
  return (await d
    .prepare(
      `SELECT s.id AS service_id, s.szolgalat_kezdete AS start, s.department_id, dep.name AS department, c.name AS center,
              b.id AS bhakta_id, COALESCE(NULLIF(b.nev_avatott, ''), b.nev_polgari) AS name, b.communityrole_id AS role,
              (s.szolgalat_kezdete >= date(?, '-1 month') AND s.szolgalat_kezdete <= date(?, '+14 days')) AS recent
       FROM services s
       JOIN bhaktas b ON b.id = s.bhakta_id
       JOIN departments dep ON dep.id = s.department_id
       JOIN centers c ON c.id = dep.center_id
       WHERE b.active = 1 AND b.communityrole_id IN (1, 2)
         ${ids ? `AND dep.center_id IN (${ids})` : ''}
         AND s.szolgalat_kezdete = (SELECT MAX(x.szolgalat_kezdete) FROM services x WHERE x.bhakta_id = s.bhakta_id AND x.szolgalat_kezdete <= ?)
         AND s.id = (SELECT MIN(y.id) FROM services y WHERE y.bhakta_id = s.bhakta_id AND y.szolgalat_kezdete = s.szolgalat_kezdete)
       ORDER BY dep.name COLLATE NOCASE, name COLLATE NOCASE`,
    )
    .all(date, date, date)) as MemberRow[]
}
