import type { H3Event } from 'h3'

/** Public, name-only list of the current members of centre 1 per department (legacy /departments/bhakta-list.json). */
export async function bhaktaList(event: H3Event, rawDate?: string) {
  const date = isoDate(rawDate?.replace(/\.json$/, '') || undefined)
  const rows = await currentMembers(date, [1])
  const byDepartment = new Map<number, { department: string; bhaktas: string[] }>()
  for (const r of rows) {
    if (!byDepartment.has(r.department_id)) byDepartment.set(r.department_id, { department: r.department, bhaktas: [] })
    byDepartment.get(r.department_id)!.bhaktas.push(r.name)
  }
  setHeader(event, 'Content-Type', 'application/json; charset=utf-8')
  return { departments: [...byDepartment.values()] }
}
