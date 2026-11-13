// One-off: merge duplicate bhakta rows. Dry-run by default.
// Usage: node scripts/merge-duplicates.mjs [--apply] [db.sqlite3]
// For each group: keeper = explicit `keep` or the row with most filled fields (active preferred).
// Empty keeper fields are filled from the duplicates; services, spouse links are repointed; duplicates deleted.
// Fields that differ (both non-empty) are only reported, the keeper's value wins.
import { copyFileSync } from 'node:fs'
import Database from 'better-sqlite3'

const apply = process.argv.includes('--apply')
const dbPath = process.argv.slice(2).find(a => !a.startsWith('--')) || './data/bhakta.sqlite3'

// Confirmed duplicates. `keep` optional.
const GROUPS = [
  { ids: [445, 446, 447, 448] },
  { ids: [55, 452, 454, 455] },
  { ids: [495, 496, 520] },
  { ids: [378, 425, 426] },
  { ids: [453, 456] },
  { ids: [488, 489] },
  { ids: [480, 481] },
  { ids: [459, 460] },
  { ids: [470, 519] },
  { ids: [486, 517] },
  { ids: [195, 518] }, // 249 is a different person
  { ids: [587, 594] },
  { ids: [487, 554] },
  { ids: [479, 498] },
  { ids: [358, 472] },
  { ids: [434, 437] },
  { ids: [312, 359] },
  { ids: [431, 465] },
  { ids: [345, 477] },
  { ids: [549, 560], keep: 560 }, // Luzina Alona is the real civil name
]

const empty = v => v === null || v === undefined || (typeof v === 'string' && ['', '0', '-'].includes(v.trim()))
const svcCount = r => db.prepare('SELECT COUNT(*) c FROM services WHERE bhakta_id=?').get(r.id).c
// keeper: most services, then newest row (re-entries are usually the more current data), then most filled fields
const score = r => svcCount(r) * 1e6 + r.id * 10 + Object.values(r).filter(v => !empty(v)).length / 100

if (apply) {
  const backup = `${dbPath}.before-merge-${Date.now()}`
  copyFileSync(dbPath, backup)
  console.log(`Backup: ${backup}`)
}
const db = new Database(dbPath)
db.pragma('foreign_keys = ON')

const run = db.transaction(() => {
  for (const g of GROUPS) {
    const rows = g.ids.map(id => db.prepare('SELECT * FROM bhaktas WHERE id=?').get(id))
    if (rows.some(r => !r)) { console.log(`SKIP ${g.ids}: missing row`); continue }
    const keeper = rows.find(r => r.id === g.keep) || [...rows].sort((a, b) => score(b) - score(a))[0]
    const dups = rows.filter(r => r.id !== keeper.id).sort((a, b) => score(b) - score(a))
    console.log(`\n== keep ${keeper.id} "${keeper.nev_avatott}" (${keeper.nev_polgari}) <- ${dups.map(d => d.id).join(', ')}`)
    const patch = {}
    for (const d of dups) {
      for (const [k, v] of Object.entries(d)) {
        if (k === 'id' || empty(v)) continue
        const cur = k in patch ? patch[k] : keeper[k]
        if (empty(cur)) patch[k] = v
        else if (cur !== v && k !== 'active' && process.argv.includes('--verbose')) console.log(`   conflict ${k}: keep=${JSON.stringify(cur)} dup#${d.id}=${JSON.stringify(v)}`)
      }
    }
    if (dups.some(d => d.active) && !keeper.active) patch.active = 1
    for (const [k, v] of Object.entries(patch)) console.log(`   fill ${k} = ${JSON.stringify(v)}`)
    for (const d of dups) {
      const s = db.prepare('UPDATE services SET bhakta_id=? WHERE bhakta_id=?').run(keeper.id, d.id).changes
      const h = db.prepare('UPDATE bhaktas SET hazastars_id=? WHERE hazastars_id=?').run(keeper.id, d.id).changes
      console.log(`   #${d.id}: ${s} services, ${h} spouse links moved`)
      // spouse of the dup becomes spouse of keeper (if keeper has none)
      db.prepare('DELETE FROM bhaktas WHERE id=?').run(d.id)
    }
    const cols = Object.keys(patch)
    if (cols.length) db.prepare(`UPDATE bhaktas SET ${cols.map(c => `${c}=@${c}`).join(',')} WHERE id=@id`).run({ ...patch, id: keeper.id })
  }
  if (!apply) throw new Error('DRY_RUN')
})

try { run(); console.log('\nApplied.') }
catch (e) { if (e.message === 'DRY_RUN') console.log('\nDry run only (rolled back). Use --apply to write.'); else throw e }
