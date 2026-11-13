# Bhaktanyilvántartás

Nuxt 4 + Nuxt UI + nuxt-users + SQLite (rewrite of the old CakePHP 3 app, which is in git history before the `nuxt-rewrite` branch).

## Dev

```bash
yarn install
yarn dev          # http://localhost:3000, uses .env.local
```

`.env.local`: `NUXT_NUXT_USERS_CONNECTOR_OPTIONS_PATH=./data/bhakta.sqlite3`

Everything private lives in `data/` (gitignored): the SQLite DB, uploaded photos (`data/photos`) and the legacy SQL dump (`data/import`).

## Roles

- `admin`: everything (edit bhaktas, services, departments, lookup tables)
- `user`: read-only; sees only centers assigned in the `centers_users` table (`center_id`, `user_id` = nuxt-users `users.id`)

Create a user:

```bash
set -a; source .env.local; set +a
DB_PATH=$NUXT_NUXT_USERS_CONNECTOR_OPTIONS_PATH yarn nuxt-users create-user --email=… --name=… --password=… --role=admin
```

## Migrating the legacy MariaDB data

```bash
yarn nuxt-users migrate            # nuxt-users tables (with DB_PATH set as above)
node scripts/migrate-legacy.mjs data/import/c10_bhakta.sql data/bhakta.sqlite3
```

Re-runnable: it replaces the content of the data tables (not users). Legacy users, sessions and `centers_users` are not migrated. Photos: copy the old `webroot/img/bhaktas/*` files into `data/photos/`.
