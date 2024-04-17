<template>
  <Head title="Order"/>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Order # {{ order.id }}
      </h2>
    </template>
    <div class="bg-white rounded-lg shadow-lg p-6">
      <h2 class="text-lg font-semibold mb-4">Order Details</h2>
      <div class="grid grid-cols-2 gap-4">
        <div><p class="font-semibold">Billing Name</p>
          <p>{{ order.billing_name }}</p></div>
        <div><p class="font-semibold">Billing Email</p>
          <p>{{ order.billing_email }}</p></div>
        <div><p class="font-semibold">Billing Address</p>
          <p>{{ order.billing_address }}</p></div>
        <div><p class="font-semibold">Billing Total</p>
          <p>{{ order.billing_total }}</p></div>
        <div><p class="font-semibold">Status</p>
          <p>{{ order.status }}</p></div>
      </div>

      <table class="w-full">
        <thead>
        <tr>
          <th class="px-4 py-2">Product</th>
          <th class="px-4 py-2">Amount</th>
          <th class="px-4 py-2">Price</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product in products" :key="product.id">
          <td class="border px-4 py-2">
            <div class="flex items-center">
              <img v-if="product.cover !== null" :src="product.cover" alt="Product Image"
                   class="w-10 h-10 object-contain mr-2"/>
              <img v-else src="/assets/img/illustrations/rocket-white.png" alt="Default Image"
                   class="w-10 h-10 object-contain mr-2"/>
              {{ product.name }}
            </div>
          </td>
          <td class="border px-4 py-2">
            <div> Amount : {{ product.pivot.quantity }}</div>
          </td>
          <td class="border px-4 py-2">
            <div> Price: {{ product.pivot.quantity * product.price }}</div>
          </td>
        </tr>
        </tbody>
      </table>

    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import {Head} from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedCrm.vue';

const props = defineProps({
  order: {
    type: Object,
    default: () => ({}),
  },
  products: {
    type: Object,
    default: () => ({}),
  },
});
</script>