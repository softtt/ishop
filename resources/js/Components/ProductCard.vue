<template>
  <div class="bg-white rounded-lg shadow-md overflow-hidden">
    <img v-if="product.cover !== null" :src="product.cover" class="w-full h-48 object-cover"/>
    <img v-else src="/assets/img/illustrations/rocket-white.png" alt="Default Image" class="w-full h-48 object-cover"/>
    <div class="p-4">
      <h3 class="text-lg font-semibold mb-2">{{ product.name }}</h3>
      <div class="flex justify-between items-center">
        <button class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2" @click="addToCart">
          Add to cart
        </button>
        <button @click="showDetails" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Details</button>
      </div>
      <div class="text-xl mt-2 font-semibold">Price: {{ product.price }} $</div>
    </div>
  </div>
</template>

<script>
import {useForm} from "@inertiajs/inertia-vue3";

export default {
  components: {},
  props: {
    product: {
      type: Object,
      required: true
    },
    category: {
      type: Object,
      default: null
    }
  },
  emits: ['add-to-cart'],

  methods: {
    addToCart() {
      this.$emit('add-to-cart', this.product);
    },

    showDetails() {
      const form = useForm({});

      if (this.category == null) {
        form.get(route("productDetails", {product: this.product.slug}));
      } else {
        form.get(route("productDetails", {category: this.category.slug, product: this.product.slug}));
      }
    }
  }
}
</script>
