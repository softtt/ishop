<script setup>
import BreezeAuthenticatedCrmLayout from '@/Layouts/AuthenticatedCrm.vue';
import {Head} from '@inertiajs/inertia-vue3';
import BreezeDropdown from '@/Components/Dropdown.vue';
import BreezeDropdownLink from '@/Components/DropdownLink.vue';
import BreezeNavLink from '@/Components/NavLink.vue';
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
</script>

<template>
  <Head title="Admin Dashboard"/>

  <BreezeAuthenticatedCrmLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Crm Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            Here you can edit your Store
          </div>
        </div>
      </div>
    </div>

    <template #footer>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Crm Dashboard Footer
      </h2>
    </template>
  </BreezeAuthenticatedCrmLayout>
</template>
