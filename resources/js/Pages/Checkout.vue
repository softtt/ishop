<script setup>
import {Head, useForm} from "@inertiajs/inertia-vue3";
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from "@/Components/Button.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";

const props = defineProps({
  products: {
    type: Object,
    default: () => ({}),
  },
  orderTotal: {
    type: Number,
    default: 0
  }
});

const form = useForm({
  billing_name: '',
  billing_email: '',
  billing_total: props.orderTotal,
  billing_address: '',
  products: props.products
});

const submit = () => {
  form.post(route("placeOrder"));
};
</script>

<template>
  <Head title="Checkout"/>

  <BreezeAuthenticatedLayout>
    <div class="p-10">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded-md">
          <div class="p-6 bg-white border-b  border-gray-200 text-dark">
            <h1 class="font-semibold text-xl text-dark leading-tight mb-4"> Checkout </h1>

            <BreezeValidationErrors class="mb-4"/>
            <form @submit.prevent="submit" class="m-4 text-dark w-2/5">
              <div>
                <BreezeLabel for="billing_name" value="Billing Name"/>
                <BreezeInput
                    id="billing_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.billing_name"
                    required
                    autofocus
                    autocomplete="billing_name"
                />
              </div>

              <div class="mt-4">
                <BreezeLabel for="billing_email" value="Email"/>
                <BreezeInput
                    id="billing_email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.billing_email"
                    required
                    autocomplete="billing_email"
                />
              </div>

              <div class="mt-4">
                <BreezeLabel for="billing_address" value="Address"/>
                <BreezeInput
                    id="billing_address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.billing_address"
                    required
                    autocomplete="billing_address"
                />
              </div>

              <div class="flex items-center justify-end sm:justify-start mt-4">
                <BreezeButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                  Place Order
                </BreezeButton>
              </div>
            </form>

            <table class="w-full">
              <thead>
              <tr>
                <th class="px-4 py-2">Product</th>
                <th class="px-4 py-2">Amount</th>
                <th class="px-4 py-2">Price</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="product in products" :key="product.id">
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
                  <div> Amount : {{ product.amount }}</div>
                </td>
                <td class="border px-4 py-2">
                  <div> Price: {{ product.amount * product.price }}</div>
                </td>
              </tr>
              </tbody>
            </table>
            <div class="mt-4"> Total price: {{ props.orderTotal }}</div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<style scoped>

</style>