export type FieldType = 'text' | 'date' | 'time' | 'textarea' | 'number' | 'bool' | 'select'
export type Field = { key: string; label: string; type?: FieldType; lookup?: string }
export type FieldGroup = { title: string; fields: Field[] }

/** Lookup tables editable at /lookups/:table (and used as select options). */
export const LOOKUPS = {
  gurus: { label: 'Guruk', columns: ['name', 'nev_full'] },
  asrams: { label: 'Áśramák', columns: ['name'] },
  tbs: { label: 'Tb-k', columns: ['name'] },
  legalstatuses: { label: 'Jogi státuszok', columns: ['name'] },
  communityroles: { label: 'Közösségi szerepek', columns: ['name'] },
  centers: { label: 'Központok', columns: ['name'] },
} as const
export type LookupTable = keyof typeof LOOKUPS

export const COLUMN_LABELS: Record<string, string> = { name: 'Név', nev_full: 'Teljes név' }

export const BHAKTA_GROUPS: FieldGroup[] = [
  {
    title: 'Alapadatok',
    fields: [
      { key: 'nev_avatott', label: 'Avatott név' },
      { key: 'nev_polgari', label: 'Polgári név' },
      { key: 'nev_szuletesi', label: 'Születési név' },
      { key: 'neme', label: 'Férfi', type: 'bool' },
      { key: 'active', label: 'Aktív', type: 'bool' },
      { key: 'szul_hely', label: 'Születési hely' },
      { key: 'szul_date', label: 'Születési dátum', type: 'date' },
      { key: 'szul_time', label: 'Születési idő', type: 'time' },
      { key: 'allampolgarsag', label: 'Állampolgárság' },
      { key: 'katonasag', label: 'Katonaság', type: 'bool' },
      { key: 'nyelv', label: 'Nyelvek' },
    ],
  },
  {
    title: 'Közösség',
    fields: [
      { key: 'communityrole_id', label: 'Közösségi szerep', type: 'select', lookup: 'communityroles' },
      { key: 'legalstatus_id', label: 'Jogi státusz', type: 'select', lookup: 'legalstatuses' },
      { key: 'asram_id', label: 'Áśrama', type: 'select', lookup: 'asrams' },
      { key: 'guru_id', label: 'Guru', type: 'select', lookup: 'gurus' },
      { key: 'tb_id', label: 'Tb', type: 'select', lookup: 'tbs' },
      { key: 'hazastars_id', label: 'Házastárs', type: 'select', lookup: 'bhaktas' },
      { key: 'datum_elsotalalkozas', label: 'Első találkozás' },
      { key: 'datum_elfogadas', label: 'Elfogadás' },
      { key: 'datum_elsoavatas', label: 'Első avatás' },
      { key: 'datum_masodikavatas', label: 'Második avatás' },
      { key: 'bhsastri_datum', label: 'Bhakti-śāstrī dátum' },
      { key: 'bhsastri_eredmeny', label: 'Bhakti-śāstrī eredmény' },
      { key: 'india', label: 'India' },
      { key: 'rs_szerz', label: 'RS szerződés' },
    ],
  },
  {
    title: 'Címek és azonosítók',
    fields: [
      { key: 'cim_allando', label: 'Állandó lakcím' },
      { key: 'cim_ideiglenes', label: 'Ideiglenes lakcím' },
      { key: 'cim_szallas', label: 'Szállás' },
      { key: 'szig', label: 'Személyi igazolvány' },
      { key: 'utlevel', label: 'Útlevél' },
      { key: 'adoazonosito', label: 'Adóazonosító' },
      { key: 'taj', label: 'TAJ' },
      { key: 'eu_card_expiry', label: 'EU-kártya lejárata', type: 'date' },
    ],
  },
  {
    title: 'Egészség, család, tanulmányok',
    fields: [
      { key: 'haziorvos_nev', label: 'Háziorvos neve' },
      { key: 'haziorvos_cim', label: 'Háziorvos címe' },
      { key: 'haziorvos_telefon', label: 'Háziorvos telefonja' },
      { key: 'halalertesitendo', label: 'Halál esetén értesítendő' },
      { key: 'csalad_nev_anya', label: 'Anya neve' },
      { key: 'csalad_nev_apa', label: 'Apa neve' },
      { key: 'csalad_hozzaallas', label: 'Család hozzáállása' },
      { key: 'vegzettseg', label: 'Végzettség' },
      { key: 'szakma', label: 'Szakma' },
      { key: 'vegakarat', label: 'Végakarat' },
    ],
  },
  {
    title: 'Megjegyzések',
    fields: [
      { key: 'megjegyzes', label: 'Megjegyzés', type: 'textarea' },
      { key: 'bizalmas_info', label: 'Bizalmas információ', type: 'textarea' },
    ],
  },
]

export const BHAKTA_COLUMNS: string[] = BHAKTA_GROUPS.flatMap(g => g.fields.map(f => f.key))
export const BHAKTA_BOOL_COLUMNS = ['neme', 'active', 'katonasag']
export const COMMUNITY_ROLE_VOLUNTEER_END = 4
export const COMMUNITY_ROLE_VOLUNTEER = 2
