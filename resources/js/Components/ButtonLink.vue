<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<style scoped>

    .btn-clicked {
    background-color: #c5d4db;
    }

.btn-bg {
    background-color: #9cb2bf;
}

</style>

<script>
import { Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        Link,
    },

    props: ["href", "active"],

    computed: {
        classes() {
            return this.active
                ? "inline-flex items-center px-4 py-2 p-1  btn-clicked rounded-md border-b-2 text-sm font-medium leading-5 text-white focus:outline-none transition  duration-150 ease-in-out"
                : "inline-flex items-center px-4 py-2 p-1  btn-bg hover:btn-clicked rounded-md border-b-2 border-transparent text-sm font-medium leading-5 text-white focus:outline-none transition duration-150 ease-in-out";
        },
    },
};
</script>
