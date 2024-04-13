<template>
  <Head title="Welcome" />

  <div class="min-h-screen bg-header">
    <div class="py-12">
      <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 sm:max-w-2xl md:max-w-4xl">
        <div class="flex justify-center bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="flex flex-col justify-center items-center p-6 bg-white border-b border-gray-200 text-color">
            <div class="flex flex-col justify-evenly items-center sm:flex-row sm: justify-center">
              <Link :href="route('crm.welcome')">
                <BreezeApplicationLogo
                    class="block h-40 sm:h-32 w-auto md:h-40"
                />
              </Link>
              <h1 class="logo-font text-3xl"> ISTORE <br> УЖ/ЁЖ </h1>
            </div>
            <div class="content py-10">
              <br>
              <div class="flex justify-center">
                <ButtonLink :href="route('crm.login')" class="mx-3">
                  LOGIN
                </ButtonLink>

                <ButtonLink :href="route('crm.register')" class="mx-3">
                  REGISTER
                </ButtonLink>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

.bg-header {
  background-color: var(--bg-white);
}


.border-gray-200 {
  border-color: #edf2f7;
  border-color: rgba(237, 242, 247, var(--tw-border-opacity));
}

.text-color {
  color: var(--text-dark);
}



</style>

<script>

import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import ButtonLink from "@/Components/ButtonLink.vue"
import {route} from "ziggy-js";

export default {
  methods: {
    route,
  },
  components: {
    Head,
    Link,
    BreezeApplicationLogo,
    ButtonLink,
  },

}
</script>
