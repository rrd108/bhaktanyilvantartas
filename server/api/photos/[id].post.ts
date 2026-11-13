import { mkdir, writeFile } from 'node:fs/promises'

export default defineEventHandler(async event => {
  const id = idParam(event)
  const parts = await readMultipartFormData(event)
  const file = parts?.find(p => p.name === 'kep' && p.filename)
  if (!file || !file.type?.startsWith('image/')) throw createError({ statusCode: 422, statusMessage: 'Képfájl szükséges' })
  if (file.data.length > 8 * 1024 * 1024) throw createError({ statusCode: 413, statusMessage: 'Túl nagy kép (max 8 MB)' })
  const name = `${id}-${file.filename!.replace(/[^\w.-]/g, '_').slice(-40)}`
  await mkdir('./data/photos', { recursive: true })
  await writeFile(`./data/photos/${name}`, file.data)
  await (await db()).prepare('UPDATE bhaktas SET kep = ? WHERE id = ?').run(name, id)
  return { ok: true }
})
