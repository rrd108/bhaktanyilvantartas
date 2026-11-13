/** GET /api/departments/bhakta-list/2026-01-31 : the list on that date (YYYY-MM-DD). */
export default defineEventHandler(event => bhaktaList(event, getRouterParam(event, 'date')))
