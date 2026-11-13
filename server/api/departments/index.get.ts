export default defineEventHandler(async event => {
  const allowed = await accessibleCenterIds(event)
  const ids = allowed ? (allowed.length ? allowed.join(',') : '0') : null
  return (await db())
    .prepare(
      `SELECT d.*, c.name AS center FROM departments d JOIN centers c ON c.id = d.center_id
       ${ids ? `WHERE d.center_id IN (${ids})` : ''} ORDER BY d.name COLLATE NOCASE`,
    )
    .all()
})
