import type { H3Event } from 'h3'

export type AppUser = { id: number; role: string }

export async function currentUser(event: H3Event): Promise<AppUser> {
  const { getCurrentUser } = useServerAuth()
  const user = await getCurrentUser(event)
  if (!user?.id) throw createError({ statusCode: 401, statusMessage: 'Unauthorized' })
  return user as unknown as AppUser
}

export async function db() {
  return (await useNuxtUsersDatabase()).database
}

/** null = every centre (admin); otherwise the ids of the centres the user is assigned to. */
export async function accessibleCenterIds(event: H3Event): Promise<number[] | null> {
  const user = await currentUser(event)
  if (user.role === 'admin') return null
  const rows = (await (await db()).prepare('SELECT center_id FROM centers_users WHERE user_id = ?').all(user.id)) as { center_id: number }[]
  return rows.map(r => r.center_id)
}

export const idParam = (event: H3Event, name = 'id') => {
  const id = Number(getRouterParam(event, name))
  if (!Number.isInteger(id) || id < 1) throw createError({ statusCode: 400, statusMessage: 'Bad id' })
  return id
}

/** Pick whitelisted columns from a body and normalise values ('' -> null, booleans -> 0/1). */
export function pickColumns(body: Record<string, unknown>, columns: string[], bools: string[] = []) {
  const out: Record<string, unknown> = {}
  for (const col of columns) {
    if (!(col in body)) continue
    let v = body[col]
    if (v === '' || v === undefined) v = null
    if (bools.includes(col)) v = v ? 1 : 0
    out[col] = v
  }
  return out
}

export async function insertRow(table: string, data: Record<string, unknown>) {
  const cols = Object.keys(data)
  const d = await db()
  const res = (await d.prepare(`INSERT INTO ${table} (${cols.join(',')}) VALUES (${cols.map(() => '?').join(',')})`).run(...(Object.values(data) as any[]))) as any
  return Number(res.lastInsertRowid ?? res.rows?.[0]?.id)
}

export async function updateRow(table: string, id: number, data: Record<string, unknown>) {
  const cols = Object.keys(data)
  if (!cols.length) return
  await (await db()).prepare(`UPDATE ${table} SET ${cols.map(c => `${c} = ?`).join(',')} WHERE id = ?`).run(...(Object.values(data) as any[]), id)
}
