<script setup>
import {ref} from 'vue';
import ProductCard from '@/components/ProductCard.vue';
import MiniCart from "./MiniCart.vue";
import {addProductToCart} from '../cart.js';

const addToCart = (product) => {
  product.amount = 1;
  addProductToCart(product);
  miniCart.value.togglePopup();
}

const miniCart = ref(null);

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

<template>
  <MiniCart ref="miniCart"></MiniCart>
  <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
    <ProductCard v-for="product in products" :key="product.id" :category="category" :product="product"
                 @add-to-cart="addToCart"/>
  </div>
</template>

<style scoped>

</style>