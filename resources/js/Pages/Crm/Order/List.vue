<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedCrm.vue';
import {Head, Link, useForm, usePage} from "@inertiajs/inertia-vue3";
import ButtonLink from "@/Components/ButtonLink.vue"
import Button from "@/Components/Button.vue"
import {route} from "ziggy-js";


const props = defineProps({
  orders: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm({});

const markAsCompleted = function (id) {
  form.post(route("orders.markAsCompleted", id));
}

</script>

<template>
  <Head title="Orders"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Orders
      </h2>
    </template>
    <div class="overflow-hidden mt-6 bg-white shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">#</th>
              <th scope="col" class="px-6 py-3">
                Billing Name
              </th>
              <th scope="col" class="px-6 py-3">
                Billing email
              </th>
              <th scope="col" class="px-6 py-3">
                Billing total
              </th>
              <th scope="col" class="px-6 py-3">
                Billing address
              </th>
              <th scope="col" class="px-6 py-3">
                Mark as Completed
              </th>
              <th scope="col" class="px-6 py-3">
                Show order
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="order in orders.data" :key="order.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ order.id }}
              </th>
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ order.billing_name }}
              </th>
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ order.billing_email }}
              </th>
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ order.billing_total }}
              </th>
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ order.billing_address }}
              </th>
              <td class="px-6 py-4">
                <Button v-if="order.status === 'Paid'" class="bg-red-700" @click="markAsCompleted(order.id)">
                  Mark as Completed
                </Button>
                <div v-else class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap"> Order
                  Completed
                </div>
              </td>
              <td class="px-6 py-4">
                <ButtonLink :href="route('orders.show', {order: order.id})"
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                  Show
                </ButtonLink>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>

</style>