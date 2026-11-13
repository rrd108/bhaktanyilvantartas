// One-off migration: MariaDB dump of the old CakePHP app -> SQLite.
// Usage: node scripts/migrate-legacy.mjs [dump.sql] [target.sqlite3]
// Users, sessions and centers_users are NOT migrated (a single admin is created with nuxt-users instead).
import { readFileSync, mkdirSync } from 'node:fs'
import { dirname } from 'node:path'
import Database from 'better-sqlite3'
import { schemaStatements } from '../server/db/schema.ts'

const dumpPath = process.argv[2] || './data/import/c10_bhakta.sql'
const dbPath = process.argv[3] || './data/bhakta.sqlite3'

const TABLES = ['asrams', 'gurus', 'tbs', 'legalstatuses', 'communityroles', 'centers', 'departments', 'bhaktas', 'services']

/** Parse every `INSERT INTO `t` (cols) VALUES (...),(...);` of a mysqldump into {table: {cols, rows}}. */
export function parseDump(sql) {
  const result = {}
  const re = /INSERT INTO `(\w+)` \(([^)]*)\) VALUES\s*/g
  let m
  while ((m = re.exec(sql))) {
    const table = m[1]
    const cols = m[2].split(',').map(c => c.trim().replace(/`/g, ''))
    let i = re.lastIndex
    const rows = []
    for (;;) {
      while (/\s/.test(sql[i])) i++
      if (sql[i] !== '(') throw new Error(`Expected ( at ${i} in ${table}`)
      i++
      const row = []
      for (;;) {
        while (sql[i] === ' ') i++
        let value
        if (sql[i] === "'") {
          i++
          let s = ''
          for (;;) {
            const c = sql[i++]
            if (c === '\\') {
              const n = sql[i++]
              s += { n: '\n', r: '\r', t: '\t', 0: '\0', Z: '\x1a' }[n] ?? n
            } else if (c === "'") {
              if (sql[i] === "'") { s += "'"; i++ } else break
            } else s += c
          }
          value = s
        } else {
          let j = i
          while (sql[j] !== ',' && sql[j] !== ')') j++
          const raw = sql.slice(i, j).trim()
          value = raw.toUpperCase() === 'NULL' ? null : Number(raw)
          i = j
        }
        row.push(value)
        if (sql[i] === ',') { i++; continue }
        if (sql[i] === ')') { i++; break }
        throw new Error(`Unexpected ${sql[i]} at ${i} in ${table}`)
      }
      if (row.length !== cols.length) throw new Error(`${table}: ${row.length} values for ${cols.length} columns`)
      rows.push(row)
      while (/\s/.test(sql[i])) i++
      if (sql[i] === ',') { i++; continue }
      if (sql[i] === ';') { i++; break }
      throw new Error(`Unexpected ${sql[i]} after row at ${i} in ${table}`)
    }
    result[table] ??= { cols, rows: [] }
    result[table].rows.push(...rows)
    re.lastIndex = i
  }
  return result
}

/** MySQL zero dates become NULL. */
const clean = v => (typeof v === 'string' && /^0000-00-00/.test(v) ? null : v)

mkdirSync(dirname(dbPath), { recursive: true })
const db = new Database(dbPath)
db.pragma('foreign_keys = OFF')
for (const statement of schemaStatements()) db.exec(statement)

const data = parseDump(readFileSync(dumpPath, 'utf8'))
const counts = {}
db.transaction(() => {
  for (const t of TABLES) {
    const { cols, rows } = data[t] ?? { cols: [], rows: [] }
    db.prepare(`DELETE FROM ${t}`).run()
    if (!rows.length) { counts[t] = 0; continue }
    const stmt = db.prepare(`INSERT INTO ${t} (${cols.join(',')}) VALUES (${cols.map(() => '?').join(',')})`)
    for (const r of rows) stmt.run(r.map(clean))
    counts[t] = rows.length
  }
})()

// the old app used 0 for "no spouse"
db.prepare('UPDATE bhaktas SET hazastars_id = NULL WHERE hazastars_id = 0').run()

db.pragma('foreign_keys = ON')
const problems = db.pragma('foreign_key_check')
console.log('Imported rows:', counts)
if (problems.length) {
  console.warn(`Foreign key problems: ${problems.length}`)
  console.warn(problems.slice(0, 20))
}
db.close()
