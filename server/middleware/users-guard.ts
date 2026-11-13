/**
 * Guards the nuxt-users CRUD routes used by the users page:
 * - deleting goes through /api/users/:id (it also cleans centre assignments)
 * - nobody changes their own role (an admin cannot demote themselves by accident)
 */
export default defineEventHandler(async event => {
  const match = getRequestURL(event).pathname.match(/^\/api\/nuxt-users\/(\d+)$/)
  if (!match) return
  const method = event.method
  if (method === 'DELETE') throw createError({ statusCode: 405, statusMessage: 'Használd a DELETE /api/users/:id útvonalat' })
  if (method === 'PATCH') {
    const body = await readBody(event)
    const { getCurrentUser } = useServerAuth()
    const me = await getCurrentUser(event)
    if (me && Number(match[1]) === Number(me.id) && body && 'role' in body && body.role !== (me as any).role) {
      throw createError({ statusCode: 403, statusMessage: 'Saját szerepkörödet nem módosíthatod' })
    }
  }
})
