<template>
  <Head title="Dashboard"/>

  <BreezeAuthenticatedLayout>
    <div class="p-10">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded-md">
          <div class="p-6 bg-white border-b  border-gray-200 text-dark">
            <h1 v-if="category.data != null && category.data.length === 0"
                class="font-semibold text-xl text-dark leading-tight mb-4">{{ category.name }} </h1>
            <h1 v-else class="font-semibold text-xl text-dark leading-tight mb-2 mt-2"> All Products </h1>
          </div>
        </div>
        <ProductGrid :products="products.data" :category="category"></ProductGrid>

      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import {Head} from "@inertiajs/inertia-vue3";
import ProductGrid from "../Components/ProductGrid.vue";
import {onMounted} from "vue";

const maounted = onMounted(function () {
  console.log(props.category);
})


const props = defineProps({
  products: {
    type: Object,
    default: () => ({}),
  },
  category: {
    type: Object,
    default: null
  }
});

</script>
