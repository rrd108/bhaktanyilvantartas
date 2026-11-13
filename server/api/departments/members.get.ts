/** "Átírós lista": current members per department on ?date= (default today), biggest departments first; empty ones skipped. */
export default defineEventHandler(async event => {
  const date = isoDate(getQuery(event).date)
  const allowed = await accessibleCenterIds(event)
  const selected = Number(getQuery(event).center_id) || null
  // a selected centre narrows the list, but never beyond what the user may see
  const centers = selected ? (allowed && !allowed.includes(selected) ? [] : [selected]) : allowed
  const rows = await currentMembers(date, centers)

  const byDepartment = new Map<number, any>()
  for (const r of rows) {
    if (!byDepartment.has(r.department_id)) {
      byDepartment.set(r.department_id, { id: r.department_id, name: r.department, center: r.center, members: [] })
    }
    byDepartment.get(r.department_id).members.push({ bhakta_id: r.bhakta_id, name: r.name, role: r.role, recent: !!r.recent })
  }
  const departments = [...byDepartment.values()]
    .map(dep => ({ ...dep, manpower: dep.members.length }))
    .sort((a, b) => b.manpower - a.manpower || a.name.localeCompare(b.name, 'hu'))
  return {
    departments,
    volunteers: rows.filter(r => r.role === 2).length,
    missionaries: rows.filter(r => r.role === 1).length,
  }
})
