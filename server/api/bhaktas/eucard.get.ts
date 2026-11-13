/** EU card expired or unknown. */
export default defineEventHandler(async event => {
  const page = Math.max(1, Number(getQuery(event).page) || 1)
  const d = await db()
  const where = `(eu_card_expiry IS NULL OR eu_card_expiry <= date('now'))`
  const total = ((await d.prepare(`SELECT COUNT(*) AS n FROM bhaktas WHERE ${where}`).get()) as any).n
  const rows = await d
    .prepare(`SELECT id, nev_avatott, eu_card_expiry FROM bhaktas WHERE ${where} ORDER BY eu_card_expiry DESC, nev_avatott LIMIT 25 OFFSET ?`)
    .all((page - 1) * 25)
  return { rows, total, page, limit: 25 }
})
