<template>
    <div>
        <div class="min-h-screen bg-header text-dark">
            <nav class="bg-header">
                <!-- Primary Navigation Menu -->
                <div class="flex justify-center sm:justify-evenly h-20 sm:h-36">
                    <div class="w-10 sm:w-60"></div>
                    <div class="flex mr-6">
                        <!-- Logo -->
                        <div class="flex flex-row items-center">
                            <Link
                                :href="route('dashboard')"
                                class="
                                    flex flex-row
                                    items-center
                                    text-lg text-dark
                                "
                            >
                                <h1 class="logo-font text-3xl">ISTORE</h1>
                                <BreezeApplicationLogo
                                    class="block h-16 w-auto sm:h-28"
                                />
                                <h1 class="logo-font text-3xl">УЖ/ЁЖ</h1>
                            </Link>
                        </div>
                    </div>

                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <ButtonLink :href="route('dashboard')"
                            >Add Card  
                            <span class="material-icons">
                                article
                            </span></ButtonLink
                        >
                        <!-- Settings Dropdown -->
                        <div class="ml-3 relative">
                            <BreezeDropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="
                                                inline-flex
                                                items-center
                                                px-3
                                                py-2
                                                border border-transparent
                                                text-sm
                                                leading-4
                                                font-medium
                                                rounded-md
                                                text-gray-500
                                                bg-white
                                                hover:text-gray-700
                                                focus:outline-none
                                                transition
                                                ease-in-out
                                                duration-150
                                            "
                                        >
                                            <span class="material-icons"
                                                >account_circle</span
                                            >

                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <BreezeDropdownLink
                                        :href="route('profile')"
                                    >
                                        Profile
                                    </BreezeDropdownLink>
                                    <BreezeDropdownLink
                                        :href="route('logout')"
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </BreezeDropdownLink>
                                </template>
                            </BreezeDropdown>
                        </div>
                    </div>

                    <!-- Hamburger -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button
                            @click="
                                showingNavigationDropdown =
                                    !showingNavigationDropdown
                            "
                            class="
                                inline-flex
                                items-center
                                justify-center
                                p-2
                                rounded-md
                                text-gray-400
                                hover:text-gray-500 hover:bg-gray-100
                                focus:outline-none
                                focus:bg-gray-100
                                focus:text-gray-500
                                transition
                                duration-150
                                ease-in-out
                                bg-header
                            "
                        >
                            <svg
                                class="h-6 w-6 text-dark bg-header"
                                stroke="currentColor"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex':
                                            !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex':
                                            showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden"
                >
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border border-gray-400">
                        <div class="mt-3 space-y-1">
                            <BreezeResponsiveNavLink
                                :href="route('dashboard')"
                            >
                                to dashboard for now
                            </BreezeResponsiveNavLink>
                        </div>
                        <div class="mt-3 space-y-1">
                            <BreezeResponsiveNavLink :href="route('profile')">
                                Profile
                            </BreezeResponsiveNavLink>
                        </div>

                        <div class="mt-3 space-y-1">
                            <BreezeResponsiveNavLink
                                :href="route('logout')"
                                method="post"
                                as="button"
                            >
                                Log Out
                            </BreezeResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
.bg-header {
    background-color: var(--bg-white);
}
</style>

<script>
import BreezeApplicationLogo from "@/Components/ApplicationLogo.vue";
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import ButtonLink from "@/Components/ButtonLink.vue";
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
        ButtonLink,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        };
    },
};
</script>
