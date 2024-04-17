<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedAdmin.vue';
import {Head, Link, useForm, usePage} from "@inertiajs/inertia-vue3";
import ButtonLink from "@/Components/ButtonLink.vue"
import Button from "@/Components/Button.vue"
import {route} from "ziggy-js";


const props = defineProps({
  users: {
    type: Object,
    default: () => ({}),
  },
});
const form = useForm({});

const destroy = function (id) {
  if (confirm("Are you sure you want to Delete")) {
    form.delete(route("users.destroy", id));
  }
}

const grantAdminAccess = function (id) {
  form.post(route("users.toggleAdminAccess", id));
}

const removeAdminAccess = function (id) {
  if (id === usePage().props.value.auth.user.id) {
    alert('You can not get rid of this honor');

    return;
  }

  form.post(route("users.toggleAdminAccess", id));
}
</script>

<template>
  <Head title="Dashboard"/>

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Users
      </h2>
    </template>
    <div class="overflow-hidden mt-6 bg-white shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-2">
          <ButtonLink :href="route('users.create')">Add User</ButtonLink>
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
                Email
              </th>
              <th scope="col" class="px-6 py-3">
                Edit
              </th>
              <th scope="col" class="px-6 py-3">
                Delete
              </th>
              <th scope="col" class="px-6 py-3">
                Admin
              </th>

            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users.data" :key="user.id"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ user.id }}
              </th>
              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ user.name }}
              </th>

              <th scope="row"
                  class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                {{ user.email }}
              </th>

              <td class="px-6 py-4">
                <ButtonLink :href="route('users.edit', {user: user.id})"
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg">
                  Edit
                </ButtonLink>
              </td>
              <td class="px-6 py-4">
                <Button class="bg-red-700" @click="destroy(user.id)">
                  Delete
                </Button>
              </td>
              <td class="px-6 py-4">
                <Button v-if="user.is_admin" class="bg-red-700" @click="removeAdminAccess(user.id)">
                  Remove Admin Access
                </Button>
                <Button v-else class="bg-red-700" @click="grantAdminAccess(user.id)">
                  Grant Admin Access
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