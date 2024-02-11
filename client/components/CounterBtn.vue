<template>
    <button @click="counter.increment()">+</button>
    <button @click="counter.reset()" >Reset</button>
    <button @click="counter.decrement()">-</button>
</template>
<script setup  lang="ts">
    const counter = useCounter()
</script>
<style scoped>
button {
  margin-right: 0.5rem;
  margin-bottom: 0.5rem;
}
</style>