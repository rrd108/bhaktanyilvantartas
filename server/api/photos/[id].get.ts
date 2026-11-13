import { readFile } from 'node:fs/promises'
import { basename } from 'node:path'

export default defineEventHandler(async event => {
  const id = idParam(event)
  const row = (await (await db()).prepare('SELECT kep FROM bhaktas WHERE id = ?').get(id)) as any
  if (!row?.kep) throw createError({ statusCode: 404 })
  try {
    const file = await readFile(`./data/photos/${basename(String(row.kep))}`)
    setHeader(event, 'Cache-Control', 'private, max-age=3600')
    return file
  } catch {
    throw createError({ statusCode: 404 })
  }
})
