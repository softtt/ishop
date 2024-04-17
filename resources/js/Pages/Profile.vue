<template>
  <Head title="Profile"/>

  <BreezeAuthenticatedLayout>
    <div class="p-10">
      <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 sm:max-w-2xl md:max-w-4xl">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
          <!-- User's Account info -->
          <div class="p-6 bg-white border-b border-gray-200">
            <div class="flex p-4">
              <div class="user-content flex flex-col  pl-8">
                <h1
                    class="
                                        font-semibold 
                                        text-xl text-dark
                                        leading-tight
                                    "
                >
                  Welcome, {{ $page.props.auth.user.name }}
                </h1>

                <p class="text-dark ml-2"> {{ $page.props.auth.user.email }}</p>
                <p class="text-dark mt-8">0 Collections</p>
                <BreezeButton class="max-w-max mt-8 ">Edit info</BreezeButton>
              </div>
            </div>
          </div>
        </div>
        <!-- User's Collections -->
        <div class="text-dark leading-tight mt-10">
          <h2 class="font-semibold text-xl">Collections</h2> <br>

          <div class="border-dashed border-gray-300 border-2 rounded bg-white p-4 max-w-max h-16">
            <BreezeNavLink :href="route('dashboard')">
              Create your first collection
            </BreezeNavLink>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeButton from "@/Components/Button.vue";
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import {Head} from "@inertiajs/inertia-vue3";

export default {
  components: {
    BreezeAuthenticatedLayout,
    BreezeNavLink,
    BreezeButton,
    BreezeCheckbox,
    BreezeInput,
    BreezeLabel,
    BreezeValidationErrors,
    Head,
  },
  data() {
    return {
      form: this.$inertia.form({
        email: "",
        password: "",
        remember: false,
      }),
    };
  },

  methods: {
    // submit() {
    //     this.form.post(this.route("profile"), {
    //         onFinish: () => this.form.reset("password"),
    //     });
    // },
  },
};
</script>
