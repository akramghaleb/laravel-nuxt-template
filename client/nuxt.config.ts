// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,

  modules: [
    // pinia state management plugin
    '@pinia/nuxt', '@pinia-plugin-persistedstate/nuxt'
  ],

  imports: {
    dirs: ['./stores'],
  },

  pinia: {
    autoImports: ['defineStore', 'acceptHMRUpdate'],
  },
  nitro: {
    output: {
      publicDir: '../laravel/public/client/'
    }
  },
})
