export default defineNuxtConfig({
  compatibilityDate: '2024-07-12',
  devtools: { enabled: false },
  css: ['~~/style.css'],
  modules: ['@nuxt/icon', 'nuxt-users', '@nuxt/ui'],

  app: { head: { title: 'Bhaktanyilvántartás', htmlAttrs: { lang: 'hu' } } },

  runtimeConfig: {
    nuxtUsers: {
      siteUrl: '',
      passwordResetUrl: '/reset-password',
      connector: {
        name: 'sqlite',
        options: { path: process.env.NUXT_NUXT_USERS_CONNECTOR_OPTIONS_PATH || './data/bhakta.sqlite3' },
      },
      auth: {
        // Nothing is public except what nuxt-users itself leaves open (login, logout, password reset),
        // so no whitelist. admin may do everything, user is read-only (centre limits: server/utils/access.ts),
        // api is a token-only account for other apps (Laksmi) that may read the bhakta name list.
        permissions: {
          admin: ['*'],
          // note: "/x/*" matches /x and everything below it, "/x*" only one path segment
          user: [
            '/',
            '/bhaktas/*',
            '/departments/*',
            '/profile',
            { path: '/api/bhaktas/*', methods: ['GET'] },
            { path: '/api/departments/*', methods: ['GET'] },
            { path: '/api/lookups/*', methods: ['GET'] },
            { path: '/api/photos/*', methods: ['GET'] },
          ],
          api: [
            { path: '/api/departments/bhakta-list', methods: ['GET'] },
            { path: '/api/departments/bhakta-list/*', methods: ['GET'] },
          ],
        },
      },
      mailer: {
        host: process.env.NUXT_NUXT_USERS_MAILER_HOST || 'localhost',
        port: parseInt(process.env.NUXT_NUXT_USERS_MAILER_PORT || '587'),
        secure: process.env.NUXT_NUXT_USERS_MAILER_SECURE === 'true',
        auth: {
          user: process.env.NUXT_NUXT_USERS_MAILER_AUTH_USER || '',
          pass: process.env.NUXT_NUXT_USERS_MAILER_AUTH_PASS || '',
        },
        defaults: { from: process.env.NUXT_NUXT_USERS_MAILER_DEFAULTS_FROM || 'bhakta@krisna.hu' },
      },
      locale: { default: 'hu', fallbackLocale: 'en' },
    },
  },

  nitro: { experimental: { database: true } },
})
