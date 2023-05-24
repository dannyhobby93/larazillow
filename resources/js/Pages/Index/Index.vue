<template>
  <h1>{{ message }}</h1>
  <small>This is the home page</small>
</template>

<script setup>

defineProps({
  message: String,
})
</script>