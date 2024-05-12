// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: true,
  devtools: { enabled: true },

  modules: ["@pinia/nuxt", '@pinia-plugin-persistedstate/nuxt'],
  imports: {
    dirs: ['./stores'],
  },

  pinia: {
    autoImports: ['defineStore', 'acceptHMRUpdate'],
  },
  nitro: {
    output: {
      publicDir: '../backend/public/app/'
    }
  },
})