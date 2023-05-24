<template>
  <Box>
    <div>
      <Link
        :href="route('listing.show', {listing: listing.id})"
      >
        <div class="flex items-center gap-1">
          <Price :price="listing.price" class="text-2xl" />
          <div class="text-xs text-gray-500">
            <Price :price="monthlyPayment" /> pm
          </div>
        </div>
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress :listing="listing" class="text-gray dark:text-gray-500" />
      </Link>
    </div>
    <div>
      <Link
        :href="route('listing.edit', {listing: listing.id})"
      >
        Edit
      </Link>
    </div>
    <div>
      <Link
        :href="route('listing.destroy', {listing: listing.id})"
        method="DELETE" as="button"
      >
        Delete
      </Link>
    </div>
  </Box>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import Box from '@/components/UI/Box.vue'
import Price from '@/components/Price.vue'
import ListingAddress from '@/components/ListingAddress.vue'
import ListingSpace from '@/components/ListingSpace.vue'

import { useMonthlyPayment  } from '@/Composables/useMonthlyPaymnet'

const props = defineProps({
  listing: Object,
})

const { monthlyPayment } = useMonthlyPayment(
  props.listing.price, 2.5, 25,
)

</script>