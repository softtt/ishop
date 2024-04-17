<template>
  <Head title="Success"/>

  <BreezeAuthenticatedLayout>
    <div class="p-10">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded-md">
          <div class="p-6 bg-white border-b  border-gray-200 text-dark">
            <h1 class="font-semibold text-xl text-dark leading-tight mb-4">Thanks, {{ $page.props.auth.user.name }} for
              purchase</h1>
            <ButtonLink :href="route('dashboard')"> Back to store</ButtonLink>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import {Head} from "@inertiajs/inertia-vue3";
import ButtonLink from "../Components/ButtonLink.vue";

</script>
