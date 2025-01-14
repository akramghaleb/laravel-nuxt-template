<template>
  <div>
    <h1>{{ title }}</h1>
    <h3>Counter : {{ counter.value }}</h3>
  </div>
</template>
<script setup type="ts">
const title = "Info Page";
const counter = useCounter()
</script>
