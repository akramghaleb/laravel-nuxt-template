// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: false,
  //srcDir: 'client/',
  nitro: {
    output: {
      publicDir: '../laravel/public/client/'
    }
  },
})
