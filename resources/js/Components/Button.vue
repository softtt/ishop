<template>
    <button
        :type="type"
        class="
            bg-button
            inline-flex
            items-center
            px-4
            py-2
            border border-transparent
            rounded-md
            font-semibold
            text-xs text-white
            uppercase
            tracking-widest
            focus:outline-none
            transition
            ease-in-out
            duration-150
        "
    >
        <slot />
    </button>
</template>

<style>
 .bg-button {
    background-color: #9cb2bf;
}
.bg-button:active {
    background-color: #c5d4db;
}

</style>

<script>
export default {
    props: {
        type: {
            type: String,
            default: "submit",
        },
    },
};
</script> 
