import type { H3Event } from 'h3'

/**
 * Name-only list of the current members per department, for other apps (Laksmi).
 * The centres come from the caller's access (centers_users): an API/user account sees the centres assigned to it
 * (none assigned = empty list), an admin sees all of them.
 *
 * Lives under /api/ on purpose: nuxt-users only enforces the login for /api/ routes
 * (paths with a dot, like *.json, or non-API server routes would stay public).
 */
export async function bhaktaList(event: H3Event, rawDate?: string) {
  const date = isoDate(rawDate || undefined)
  const rows = await currentMembers(date, await accessibleCenterIds(event))
  const byDepartment = new Map<number, { department: string; center: string; bhaktas: string[] }>()
  for (const r of rows) {
    if (!byDepartment.has(r.department_id)) byDepartment.set(r.department_id, { department: r.department, center: r.center, bhaktas: [] })
    byDepartment.get(r.department_id)!.bhaktas.push(r.name)
  }
  return { departments: [...byDepartment.values()] }
}
