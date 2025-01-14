// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  ssr: true,
  payloadextraction: false,
  devtools: { enabled: true },

  modules: ["@pinia/nuxt", "@pinia-plugin-persistedstate/nuxt"],
  imports: {
    dirs: ["./stores"],
  },

  pinia: {
    autoImports: ["defineStore", "acceptHMRUpdate"],
  },
  nitro: {
    output: {
      publicDir: "../backend/public/app/",
    },
  },
  app: {
    baseURL: "/",
    buildAssetsDir: "/app/_nuxt/",
    head: {
      link: [{ rel: "icon", type: "image/x-icon", href: "/app/favicon.ico" }],
    },
  },
});
