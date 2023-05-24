<template>
  <span>
    {{ listing.street_nr }} 
    {{ listing.street }}, 
    {{ listing.city }}
  </span>
</template>

<script setup>
defineProps({
  listing: Object,
})
</script>