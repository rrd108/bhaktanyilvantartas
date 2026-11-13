/** All users (also inactive ones) with their assigned centres. Admin only (see nuxt.config permissions). */
export default defineEventHandler(async () => {
  const d = await db()
  const users = (await d.prepare('SELECT id, email, name, role, active, created_at FROM users ORDER BY name COLLATE NOCASE').all()) as any[]
  const links = (await d.prepare('SELECT user_id, center_id FROM centers_users').all()) as { user_id: number; center_id: number }[]
  return users.map(u => ({ ...u, active: !!u.active, center_ids: links.filter(l => l.user_id === u.id).map(l => l.center_id) }))
})
