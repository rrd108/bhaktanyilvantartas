/**
 * Guards the nuxt-users CRUD routes used by the users page:
 * - deleting goes through /api/users/:id (it also cleans centre assignments)
 * - nobody changes their own role (an admin cannot demote themselves by accident)
 * - an API token must not survive a role change (it would inherit the new role's permissions)
 *
 * Acts only for an authenticated admin; everything else is left to the nuxt-users authorization middleware.
 */
export default defineEventHandler(async event => {
  const match = getRequestURL(event).pathname.match(/^\/api\/nuxt-users\/(\d+)$/)
  if (!match || !['PATCH', 'DELETE'].includes(event.method)) return
  const targetId = Number(match[1])

  const { getCurrentUser } = useServerAuth()
  const me = (await getCurrentUser(event)) as { id: number; role: string } | null
  if (!me || me.role !== 'admin') return

  if (event.method === 'DELETE') {
    throw createError({ statusCode: 405, statusMessage: 'Használd a DELETE /api/users/:id útvonalat' })
  }

  const body = await readBody(event)
  if (!body || !('role' in body)) return
  const d = await db()
  const target = (await d.prepare('SELECT role FROM users WHERE id = ?').get(targetId)) as { role: string } | undefined
  if (!target || target.role === body.role) return

  if (targetId === Number(me.id)) {
    throw createError({ statusCode: 403, statusMessage: 'Saját szerepkörödet nem módosíthatod' })
  }
  await d.prepare("DELETE FROM personal_access_tokens WHERE tokenable_id = ? AND name = 'api_token'").run(targetId)
})
