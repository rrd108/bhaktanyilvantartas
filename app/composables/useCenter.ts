/** Selected centre (null = all), shared across pages and persisted in localStorage. */
export const useCenter = () => useState<number | null>('centerId', () => null)
