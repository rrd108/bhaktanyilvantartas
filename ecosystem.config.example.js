// pm2 config for the server. Copy to ecosystem.config.js (gitignored, it holds secrets) and fill it in.
// deploy.sh uploads it once to the server base path; later changes are made on the server (or delete the
// remote file and deploy again).
module.exports = {
  apps: [
    {
      name: 'bhakta.1108.cc',
      port: 3005, // keep in sync with APP_PORT in deploy.sh
      // pm2 is started from the base path: the build (server/, public/) and ./data (sqlite, photos) live there
      cwd: '/var/www/bhakta.1108.cc/web',
      script: './server/index.mjs',
      log_date_format: 'YYYY-MM-DD HH:mm:ss',
      interpreter: '/usr/bin/node',
      env: {
        NUXT_NUXT_USERS_SITE_URL: 'https://bhakta.1108.cc',
        NUXT_NUXT_USERS_CONNECTOR_OPTIONS_PATH: '/var/www/bhakta.1108.cc/web/data/bhakta.sqlite3',
        NUXT_NUXT_USERS_MAILER_HOST: 'smtp.eu.mailgun.org',
        NUXT_NUXT_USERS_MAILER_DEFAULTS_FROM: 'bhakta@1108.cc',
        NUXT_NUXT_USERS_MAILER_AUTH_USER: '',
        NUXT_NUXT_USERS_MAILER_AUTH_PASS: '',
      },
    },
  ],
}
