export default defineEventHandler(async event => {
  try {
    await (await db()).prepare('DELETE FROM departments WHERE id = ?').run(idParam(event))
  } catch {
    throw createError({ statusCode: 409, statusMessage: 'Az osztálynak vannak szolgálatai, nem törölhető' })
  }
  return { ok: true }
})
