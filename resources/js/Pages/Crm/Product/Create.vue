<template>
  <Head title="Create Product"/>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create Product
      </h2>
    </template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col justify-center items-center">
      <BreezeValidationErrors class="mb-4"/>
      <form @submit.prevent="submit" class="m-4 text-dark w-2/5">
        <div>
          <BreezeLabel for="name" value="Name"/>
          <BreezeInput
              id="name"
              type="text"
              class="mt-1 block w-full"
              v-model="form.name"
              required
              autofocus
              autocomplete="name"
          />
        </div>

        <div class="mt-4">
          <BreezeLabel for="details" value="Details"/>
          <BreezeInput
              id="details"
              type="text"
              class="mt-1 block w-full"
              v-model="form.details"
              required
              autocomplete="details"
          />
        </div>

        <div class="mt-4">
          <BreezeLabel for="description" value="Description"/>
          <BreezeInput
              id="description"
              type="text"
              class="mt-1 block w-full"
              v-model="form.description"
              required
              autocomplete="description"
          />
        </div>

        <div class="mt-4">
          <BreezeLabel for="product_code" value="Product Code"/>
          <BreezeInput
              id="product_code"
              type="text"
              class="mt-1 block w-full"
              v-model="form.product_code"
              required
              autocomplete="product_code"
          />
        </div>

        <div class="mt-4">
          <BreezeLabel for="categories" value="Categories"/>

          <VueMultiselect
              v-model="form.categories"
              :searchable="false"
              :options="categories.data"
              :multiple="true"
              :close-on-select="true"
              placeholder="Categories"
              label="name"
              track-by="name"
          />
        </div>

        <div class="mt-4">
          <BreezeLabel for="price" value="Price"/>
          <BreezeInput
              id="price"
              type="number"
              class="mt-1 block w-full"
              v-model="form.price"
              required
              autocomplete="price"
          />
        </div>

        <div class="mt-4">
          <BreezeLabel for="cover" value="Cover Image"/>
          <input type="file" @input="form.cover = $event.target.files[0]" class="mt-1 block w-full" id="cover"
                 name="cover"/>
        </div>

        <div class="flex items-center justify-end sm:justify-start mt-4">
          <BreezeButton
              :class="{ 'opacity-25': form.processing }"
              :disabled="form.processing"
          >
            Create
          </BreezeButton>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import BreezeButton from "@/Components/Button.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import {Head, useForm} from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedCrm.vue';
import {route} from "ziggy-js";
import VueMultiselect from 'vue-multiselect'


const props = defineProps({
  categories: {
    type: Object,
    default: () => ({}),
  },
});

const form = useForm({
  name: "",
  details: "",
  description: "",
  product_code: "",
  categories: [],
  cover: "",
  price: 0,
});

const submit = () => {
  form.post(route('products.store'), {
    forceFormData: true,
    onSuccess: () => {
      form.reset('name', 'cover');
    },
  });
};

</script>