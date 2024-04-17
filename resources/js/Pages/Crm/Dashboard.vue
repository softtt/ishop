<script setup>
import BreezeAuthenticatedCrmLayout from '@/Layouts/AuthenticatedCrm.vue';
import {Head} from '@inertiajs/inertia-vue3';

const props = defineProps({
  statistics: {
    type: Object,
    default: () => ({}),
  },
});
</script>

<template>
  <Head title="CRM Dashboard"/>

  <BreezeAuthenticatedCrmLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Crm Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <h2> Total number of orders in your store: {{ statistics.ordersCount }}</h2>
            <h2> Total number of products in your store: {{ statistics.productsCount }}</h2>
            <h2> Total number of categories in your store: {{ statistics.categoriesCount }}</h2>
          </div>
        </div>
      </div>
    </div>

    <template #footer>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Crm Dashboard Footer
      </h2>
    </template>
  </BreezeAuthenticatedCrmLayout>
</template>
