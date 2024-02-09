<template>
  <nuxt-link :to="{ path: '/'}">home</nuxt-link> |  
  <nuxt-link :to="{ path: '/about'}">about</nuxt-link>
  <NuxtLayout>
    <NuxtPage/>
  </NuxtLayout>
</template>
