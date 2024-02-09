// https://nuxt.com/docs/api/configuration/nuxt-config
export default {
  srcDir: 'client/',
  buildDir: '../laravel/public/client/',
  generate:{
      dir : '../laravel/public/client/'
  },
  server:{
      port:8000,
      host: '0.0.0.0'
  }
}
