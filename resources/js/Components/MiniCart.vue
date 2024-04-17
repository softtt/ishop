<template>
  <div class="relative">
    <div @click="togglePopup"
         class="cursor-pointer bg-blue-500 text-white rounded-full w-12 h-12 flex items-center justify-center absolute top-6 right-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 19c-1.125 0-2.107-.434-2.862-1.138M16 19c-1.125 0-2.107-.434-2.862-1.138M20 8H4l-1 9h18l-1-9zm0 0v0a2 2 0 00-2-2h-2V5a3 3 0 00-3-3H9a3 3 0 00-3 3v1H4a2 2 0 00-2 2v0l.964 8.677A2 2 0 004.955 20h14.09a2 2 0 001.991-1.323L20 8z"/>
      </svg>
    </div>

    <div v-if="isPopupOpen" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
      <div class="bg-white p-8 rounded-lg w-full md:w-3/4 lg:w-2/4">
        <h2 class="text-lg font-semibold mb-4">Mini Cart</h2>
        <table class="w-full">
          <thead>
          <tr>
            <th class="px-4 py-2">Product</th>
            <th class="px-4 py-2">Amount</th>
            <th class="px-4 py-2">Action</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(product, index) in cart" :key="product.id">
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
              <input type="number" v-model.number="cart[index].amount" min="1"
                     @change="updateProductAmount(product.id, cart[index].amount)"
                     class="w-16 py-1 px-2 border rounded-lg">
              Price: {{ cart[index].amount * product.price }}
            </td>
            <td class="border px-4 py-2">
              <button @click="removeProductFromCart(product.id)" class="bg-red-500 text-white px-4 py-1 rounded-lg">
                Delete
              </button>
            </td>
          </tr>
          </tbody>
        </table>
        <div class="flex justify-between">
          <button @click="togglePopup" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">Close</button>
          <button v-if="cart.length > 0" class="mt-4 bg-gray-600 text-white px-4 py-2 rounded-md"
                  @click="proceedToCheckout"> Proceed to Checkout
          </button>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import {getCart, removeProduct, changeProductAmount} from '../cart.js';
import {ref} from 'vue';
import ButtonLink from "./ButtonLink.vue";
import Button from "./Button.vue";
import {route} from "ziggy-js";
import {useForm} from "@inertiajs/inertia-vue3";

export default {
  components: {Button, ButtonLink},

  setup() {
    const isPopupOpen = ref(false);
    const cart = getCart();

    const togglePopup = () => {
      isPopupOpen.value = !isPopupOpen.value;
    };

    const updateProductAmount = (productId, newAmount) => {
      changeProductAmount(productId, newAmount);
    };

    const removeProductFromCart = (productId) => {
      removeProduct(productId);
    };

    const form = useForm({});

    const proceedToCheckout = () => {
      form.post(route('checkout', {cart: cart}));
    };

    return {isPopupOpen, cart, updateProductAmount, togglePopup, removeProductFromCart, proceedToCheckout};
  }
}
</script>

<style scoped>

</style>