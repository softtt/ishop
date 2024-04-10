<template>
    <div class="min-h-screen bg-header text-dark">
        <nav class="bg-header mx-4">
            <!-- Primary Navigation Menu -->       
                    <div class="flex justify-center sm:justify-evenly h-20 sm:h-36">
                        <div class="w-10 sm:block sm:w-46 md:block md:w-58"></div>
                        <div class="flex mr-6">
                            <!-- Logo -->
                            <div class="flex flex-row items-center">
                                <Link :href="route('welcome')" class="flex flex-row items-center text-lg text-dark">
                                <h1 class="logo-font text-3xl"> ISTORE </h1>
                                    <BreezeApplicationLogo
                                        class="block h-16 w-auto sm:h-24"
                                    />
                                    <h1 class="logo-font text-3xl"> УЖ/ЁЖ </h1>
                                </Link>
                                
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div>
                                <Link :href="route('login')" class="text-sm text-gray-700 underline">
                                    Log in
                                </Link>

                                <Link :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
                                    Register
                                </Link>
                            </div>


                        </div>

                    </div>
        </nav>
        

        <!-- Page Content -->
            <main>
                <slot />
            </main>
    </div>
</template>

<style scoped>

    .bg-header {
    background-color: var(--bg-white);
}
</style>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import Button from "@/Components/Button.vue"
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
        Button
    },
}
</script>
