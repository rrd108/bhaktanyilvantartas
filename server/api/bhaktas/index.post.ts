import { BHAKTA_BOOL_COLUMNS, BHAKTA_COLUMNS } from '~~/shared/fields'

export default defineEventHandler(async event => {
  const data = pickColumns(await readBody(event), BHAKTA_COLUMNS, BHAKTA_BOOL_COLUMNS)
  if (!data.nev_avatott) throw createError({ statusCode: 422, statusMessage: 'Az avatott név kötelező' })
  return { id: await insertRow('bhaktas', data) }
})
