/** Replace the centres a user may see. */
export default defineEventHandler(async event => {
  const id = idParam(event)
  const { center_ids } = await readBody(event)
  if (!Array.isArray(center_ids) || center_ids.some(c => !Number.isInteger(c))) throw createError({ statusCode: 400, statusMessage: 'Érvénytelen központlista' })
  const d = await db()
  if (!(await d.prepare('SELECT 1 FROM users WHERE id = ?').get(id))) throw createError({ statusCode: 404, statusMessage: 'Nincs ilyen felhasználó' })
  await d.prepare('DELETE FROM centers_users WHERE user_id = ?').run(id)
  for (const c of [...new Set(center_ids as number[])]) {
    await d.prepare('INSERT INTO centers_users (center_id, user_id) SELECT id, ? FROM centers WHERE id = ?').run(id, c)
  }
  return { ok: true }
})
