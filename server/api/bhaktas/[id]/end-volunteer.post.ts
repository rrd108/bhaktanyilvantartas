import { COMMUNITY_ROLE_VOLUNTEER_END } from '~~/shared/fields'

/** Ends the latest-started service on endDate and marks the bhakta as a former volunteer. */
export default defineEventHandler(async event => {
  const id = idParam(event)
  const { endDate } = await readBody(event)
  if (!/^\d{4}-\d{2}-\d{2}$/.test(String(endDate))) throw createError({ statusCode: 422, statusMessage: 'Érvénytelen dátum' })
  const d = await db()
  const last = (await d.prepare('SELECT id FROM services WHERE bhakta_id = ? ORDER BY szolgalat_kezdete DESC, id DESC LIMIT 1').get(id)) as any
  if (last) await d.prepare('UPDATE services SET szolgalat_vege = ? WHERE id = ?').run(endDate, last.id)
  await d.prepare('UPDATE bhaktas SET communityrole_id = ?, legalstatus_id = NULL WHERE id = ?').run(COMMUNITY_ROLE_VOLUNTEER_END, id)
  return { ok: true }
})
