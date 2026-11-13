/** Application tables (created idempotently at startup and by scripts/migrate-legacy.mjs). */
export const SCHEMA = `
CREATE TABLE IF NOT EXISTS asrams (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS gurus (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  nev_full TEXT
);
CREATE TABLE IF NOT EXISTS tbs (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS legalstatuses (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS communityroles (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS centers (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS departments (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  center_id INTEGER NOT NULL REFERENCES centers(id),
  name TEXT NOT NULL DEFAULT '',
  active INTEGER NOT NULL DEFAULT 1
);
CREATE TABLE IF NOT EXISTS bhaktas (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  neme INTEGER NOT NULL DEFAULT 0,
  nev_szuletesi TEXT,
  nev_polgari TEXT,
  nev_avatott TEXT NOT NULL,
  guru_id INTEGER REFERENCES gurus(id),
  cim_allando TEXT,
  cim_ideiglenes TEXT,
  cim_szallas TEXT,
  szig TEXT,
  utlevel TEXT,
  adoazonosito TEXT,
  taj TEXT,
  szul_hely TEXT,
  szul_date TEXT,
  szul_time TEXT,
  allampolgarsag TEXT,
  katonasag INTEGER,
  haziorvos_nev TEXT,
  haziorvos_cim TEXT,
  haziorvos_telefon TEXT,
  datum_elsotalalkozas TEXT,
  datum_elfogadas TEXT,
  datum_elsoavatas TEXT,
  datum_masodikavatas TEXT,
  asram_id INTEGER REFERENCES asrams(id),
  hazastars_id INTEGER REFERENCES bhaktas(id),
  tb_id INTEGER REFERENCES tbs(id),
  eu_card_expiry TEXT,
  legalstatus_id INTEGER REFERENCES legalstatuses(id),
  communityrole_id INTEGER REFERENCES communityroles(id),
  vegzettseg TEXT,
  szakma TEXT,
  vegakarat TEXT,
  halalertesitendo TEXT,
  bhsastri_datum TEXT,
  bhsastri_eredmeny TEXT,
  nyelv TEXT,
  csalad_nev_anya TEXT,
  csalad_nev_apa TEXT,
  csalad_hozzaallas TEXT,
  india TEXT,
  rs_szerz TEXT,
  active INTEGER NOT NULL DEFAULT 1,
  bizalmas_info TEXT,
  megjegyzes TEXT,
  kep TEXT
);
CREATE INDEX IF NOT EXISTS idx_bhaktas_nev ON bhaktas(nev_avatott);
CREATE TABLE IF NOT EXISTS services (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  bhakta_id INTEGER NOT NULL REFERENCES bhaktas(id) ON DELETE CASCADE,
  department_id INTEGER NOT NULL REFERENCES departments(id),
  szolgalat TEXT NOT NULL DEFAULT '',
  szolgalat_kezdete TEXT,
  szolgalat_vege TEXT,
  szolg_megjegyzes TEXT NOT NULL DEFAULT ''
);
CREATE INDEX IF NOT EXISTS idx_services_bhakta ON services(bhakta_id);
CREATE INDEX IF NOT EXISTS idx_services_department ON services(department_id);
-- which centers a (non-admin) user may see; user_id references nuxt-users users.id
CREATE TABLE IF NOT EXISTS centers_users (
  center_id INTEGER NOT NULL REFERENCES centers(id) ON DELETE CASCADE,
  user_id INTEGER NOT NULL,
  PRIMARY KEY (center_id, user_id)
);
`

export const schemaStatements = () => SCHEMA.split(/;\s*\n/).map(s => s.trim()).filter(Boolean)
