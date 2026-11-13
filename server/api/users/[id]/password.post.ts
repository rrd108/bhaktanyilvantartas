import bcrypt from 'bcrypt'
import { getPasswordValidationOptions, validatePassword } from 'nuxt-users/utils'

/** Admin sets a new password for a user; the user's sessions are revoked. */
export default defineEventHandler(async event => {
  const id = idParam(event)
  const { password } = await readBody(event)
  if (typeof password !== 'string' || !password) throw createError({ statusCode: 400, statusMessage: 'Add meg az új jelszót' })
  const check = validatePassword(password, getPasswordValidationOptions(useRuntimeConfig().nuxtUsers as any))
  if (!check.isValid) {
    throw createError({ statusCode: 400, statusMessage: `Password validation failed: ${check.errors.join(', ')}` })
  }
  const d = await db()
  if (!(await d.prepare('SELECT 1 FROM users WHERE id = ?').get(id))) throw createError({ statusCode: 404, statusMessage: 'Nincs ilyen felhasználó' })
  await d.prepare("UPDATE users SET password = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?").run(await bcrypt.hash(password, 10), id)
  await d.prepare('DELETE FROM personal_access_tokens WHERE tokenable_id = ?').run(id)
  return { ok: true }
})
