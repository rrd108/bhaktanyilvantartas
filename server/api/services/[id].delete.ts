export default defineEventHandler(async event => {
  await (await db()).prepare('DELETE FROM services WHERE id = ?').run(idParam(event))
  return { ok: true }
})
