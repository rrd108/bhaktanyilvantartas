export default defineEventHandler(async event => {
  const id = idParam(event)
  const d = await db()
  const bhakta = (await d
    .prepare(
      `SELECT b.*, g.name AS guru, t.name AS tb, l.name AS legalstatus, a.name AS asram, c.name AS communityrole, h.nev_avatott AS hazastars
       FROM bhaktas b
       LEFT JOIN gurus g ON g.id = b.guru_id LEFT JOIN tbs t ON t.id = b.tb_id
       LEFT JOIN legalstatuses l ON l.id = b.legalstatus_id LEFT JOIN asrams a ON a.id = b.asram_id
       LEFT JOIN communityroles c ON c.id = b.communityrole_id LEFT JOIN bhaktas h ON h.id = b.hazastars_id
       WHERE b.id = ?`,
    )
    .get(id)) as any
  if (!bhakta) throw createError({ statusCode: 404, statusMessage: 'Nincs ilyen bhakta' })
  bhakta.services = await d
    .prepare(
      `SELECT s.*, d.name AS department, d.center_id, c.name AS center
       FROM services s JOIN departments d ON d.id = s.department_id JOIN centers c ON c.id = d.center_id
       WHERE s.bhakta_id = ? ORDER BY s.szolgalat_kezdete`,
    )
    .all(id)
  return bhakta
})
