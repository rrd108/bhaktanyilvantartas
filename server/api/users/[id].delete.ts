/** Delete a user with their tokens and centre assignments (never yourself). */
export default defineEventHandler(async event => {
  const id = idParam(event)
  const me = await currentUser(event)
  if (me.id === id) throw createError({ statusCode: 403, statusMessage: 'Saját magadat nem törölheted' })
  const d = await db()
  await d.prepare('DELETE FROM personal_access_tokens WHERE tokenable_id = ?').run(id)
  await d.prepare('DELETE FROM centers_users WHERE user_id = ?').run(id)
  await d.prepare('DELETE FROM users WHERE id = ?').run(id)
  return { ok: true }
})
