/** Departments with the people serving on ?date= (default today), restricted to the user's centres; busiest last like the old app. */
export default defineEventHandler(async event => {
  const date = String(getQuery(event).date || new Date().toISOString().slice(0, 10))
  const allowed = await accessibleCenterIds(event)
  const ids = allowed ? (allowed.length ? allowed.join(',') : '0') : null
  const d = await db()
  const departments = (await d
    .prepare(`SELECT d.id, d.name, d.center_id, c.name AS center FROM departments d JOIN centers c ON c.id = d.center_id WHERE d.active = 1 ${ids ? `AND d.center_id IN (${ids})` : ''}`)
    .all()) as any[]
  const services = (await d
    .prepare(
      `SELECT s.id, s.department_id, s.szolgalat, b.id AS bhakta_id, b.nev_avatott
       FROM services s JOIN bhaktas b ON b.id = s.bhakta_id
       WHERE (s.szolgalat_kezdete IS NULL OR s.szolgalat_kezdete <= ?) AND (s.szolgalat_vege IS NULL OR s.szolgalat_vege >= ?)
       ORDER BY b.nev_avatott COLLATE NOCASE`,
    )
    .all(date, date)) as any[]
  return departments
    .map(dep => {
      const members = services.filter(s => s.department_id === dep.id)
      return { ...dep, members, manpower: members.length }
    })
    .sort((a, b) => a.manpower - b.manpower)
})
