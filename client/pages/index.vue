<template>
  <div>
    <h1>{{ title }}</h1>
    <h3>Counter : {{ counter.value }}</h3>
    <CounterBtn />
  </div>
</template>
<script setup type="ts">

const title = "Index Page";
const counter = useCounter()
</script>
