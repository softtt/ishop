<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
            <div class="p-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg rounded-md">
                    <div class="p-6 bg-white border-b  border-gray-200 text-dark">
                        <h1 class="font-semibold text-xl text-dark leading-tight mb-4">Welcome, {{ $page.props.auth.user.name }} </h1>
                        <h2>Scroll through the feed below for some inspiration, or go to your profile to start your own creative healing journey</h2>
                    </div>
                </div>
                
                <div class="font-semibold text-xl text-dark leading-tight mt-10">
                    <h3>ISTORE</h3>

                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
};
</script>
