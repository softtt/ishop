<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedAdmin.vue';
import {Head, useForm} from "@inertiajs/inertia-vue3";
import ButtonLink from "@/Components/ButtonLink.vue"
import Button from "@/Components/Button.vue"
import {route} from "ziggy-js";


const props = defineProps({
  stores: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm({});

const destroy = function (id) {
  if (confirm("Are you sure that you want to delete it?")) {
    form.delete(route("stores.destroy", id));
  }
}

const toggleActiveStatus = function (id) {
  form.post(route("stores.toggleActiveStatus", id));
}

</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Stores
      </h2>
    </template>
    <div class="overflow-hidden mt-6 bg-white shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-2">
          <ButtonLink :href="route('stores.create')">Add Store</ButtonLink>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">#</th>
              <th scope="col" class="px-6 py-3">
                Name
              </th>
              <th scope="col" class="px-6 py-3">
                Description
              </th>
              <th scope="col" class="px-6 py-3">
                User
              </th>
              <th scope="col" class="px-6 py-3">
                Edit
              </th>
              <th scope="col" class="px-6 py-3">
                Delete
              </th>
              <th scope="col" class="px-6 py-3">
                Active
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="store in stores.data" :key="store.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ store.id }}
              </th>
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ store.name }}
              </th>
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ store.short_description }}
              </th>
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ store.user_name }}
              </th>
              <td class="px-6 py-4">
                <ButtonLink :href="route('stores.edit', {store: store.id})"
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                  Edit
                </ButtonLink>
              </td>
              <td class="px-6 py-4">
                <Button class="bg-red-700" @click="destroy(store.id)">
                  Delete
                </Button>
              </td>
              <td class="px-6 py-4">
                <Button v-if="store.is_active" class="bg-red-700" @click="toggleActiveStatus(store.id)">
                  Deactivate
                </Button>
                <Button v-else class="bg-red-700" @click="toggleActiveStatus(store.id)">
                  Activate
                </Button>
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