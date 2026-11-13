import { schemaStatements } from '../db/schema'

/** Create the application tables next to the nuxt-users tables (idempotent). */
export default defineNitroPlugin(async () => {
  const { database: db } = await useNuxtUsersDatabase()
  for (const statement of schemaStatements()) await db.exec(statement)
})
