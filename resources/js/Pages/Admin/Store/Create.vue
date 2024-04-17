<template>
  <Head title="Register"/>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create Store
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
          <BreezeLabel for="short_description" value="Description"/>
          <BreezeInput
              id="short_description"
              type="text"
              class="mt-1 block w-full"
              v-model="form.short_description"
              required
              autocomplete="short_description"
          />
        </div>

        <div class="mt-4">
          <BreezeLabel for="user" value="User"/>
          <Select :modelValue="form.user" :items="users" @update:modelValue="form.user = $event"/>
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

<script>
import BreezeButton from "@/Components/Button.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import {Head, Link} from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from '@/Layouts/AuthenticatedAdmin.vue';
import Select from '@/Components/Select.vue';

export default {
  components: {
    Select,
    AuthenticatedLayout,
    BreezeButton,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
    Head,
    Link,
  },

  data() {
    return {
      form: this.$inertia.form({
        name: "",
        short_description: "",
        user: ""
      }),
    };
  },

  props: {
    users: {
      type: Object,
      default: () => ({}),
    },
  },

  methods: {
    submit() {
      this.form.post(route("stores.store"));
    },
  },
};
</script>
