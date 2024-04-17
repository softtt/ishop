<template>
  <Head title="Dashboard"/>

  <BreezeAuthenticatedLayout>
    <div class="p-10">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded-md">
          <div class="p-6 bg-white border-b  border-gray-200 text-dark">
            <h1 class="font-semibold text-xl text-dark leading-tight mb-4"> {{ product.name }} </h1>
            <div class="grid grid-cols-2 gap-4">
              <div><p class="font-semibold"> Description </p>
                <p>{{ product.description }}</p></div>
              <div><p class="font-semibold"> Details </p>
                <p>{{ product.details }}</p></div>
              <div class="p-4 bg-stone-100 w-36 rounded-md shadow-md text-center">
                <img v-if="product.cover !== null" :src="product.cover" class="object-contain mx-auto"/>
                <img v-else src="/assets/img/illustrations/rocket-white.png" alt="Default Image"
                     class="object-contain mx-auto"/>
              </div>
              <div><p class="font-semibold"> Price </p>
                <p>{{ product.price }} $</p></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import {Head} from "@inertiajs/inertia-vue3";

const props = defineProps({
  product: {
    type: Object,
    default: () => ({}),
  },

});

</script>