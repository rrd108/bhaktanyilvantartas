export default defineEventHandler(async event => {
  const id = idParam(event)
  const d = await db()
  await d.prepare('UPDATE bhaktas SET hazastars_id = NULL WHERE hazastars_id = ?').run(id)
  await d.prepare('DELETE FROM services WHERE bhakta_id = ?').run(id)
  await d.prepare('DELETE FROM bhaktas WHERE id = ?').run(id)
  return { ok: true }
})
