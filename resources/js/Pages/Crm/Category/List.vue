<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedCrm.vue';
import {Head, Link, useForm, usePage} from "@inertiajs/inertia-vue3";
import ButtonLink from "@/Components/ButtonLink.vue"
import Button from "@/Components/Button.vue"
import {route} from "ziggy-js";

const props = defineProps({
  categories: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm({});

const destroy = function (id) {
  if (confirm("Are you sure that you want to delete it?")) {
    form.delete(route("categories.destroy", id));
  }
}

const toggleActiveStatus = function (id) {
  form.post(route("categories.toggleActiveStatus", id));
}

</script>

<template>
  <Head title="Categories"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Categories
      </h2>
    </template>
    <div class="overflow-hidden mt-6 bg-white shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-2">
          <ButtonLink :href="route('categories.create')">Add Category</ButtonLink>
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
                Category code
              </th>
              <th scope="col" class="px-6 py-3">
                Edit
              </th>
              <th scope="col" class="px-6 py-3">
                Delete
              </th>
              <th scope="col" class="px-6 py-3">
                Show in navigation
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="category in categories.data" :key="category.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ category.id }}
              </th>
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ category.name }}
              </th>
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ category.category_code }}
              </th>
              <td class="px-6 py-4">
                <ButtonLink :href="route('categories.edit', {category: category.id})"
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                  Edit
                </ButtonLink>
              </td>
              <td class="px-6 py-4">
                <Button class="bg-red-700" @click="destroy(category.id)">
                  Delete
                </Button>
              </td>
              <td class="px-6 py-4">
                <Button v-if="category.is_visible" class="bg-red-700" @click="toggleActiveStatus(category.id)">
                  Hide
                </Button>
                <Button v-else class="bg-red-700" @click="toggleActiveStatus(category.id)">
                  Show
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