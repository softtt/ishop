<template>
    <Head title="New Collection" />

    <BreezeValidationErrors class="mb-4" />

    <BreezeAuthenticatedLayout>
        <div class="p-10">
            <div
                class="
                    max-w-7xl
                    mx-auto
                    sm:px-6
                    lg:px-8
                    sm:max-w-2xl
                    md:max-w-4xl
                "
            >
                <div
                    class="
                        bg-white
                        overflow-hidden
                        shadow-sm
                        sm:rounded-lg
                        rounded-md
                    "
                >
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2
                            class="
                                font-semibold
                                text-xl text-dark
                                leading-tight
                            "
                        >
                            Create new collection
                        </h2>
                        <form @submit.prevent="submitCollection" class="m-4">
                            <div class="my-4">
                                <BreezeLabel
                                    for="name"
                                    value="Name of collection"
                                />
                                <BreezeInput
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-4/5 md:w-3/5"
                                    v-model="form.name"
                                    required
                                    autofocus
                                />
                            </div>

                            <div class="mb-4">
                                <BreezeLabel
                                    for="bgcolor"
                                    value="Background Color"
                                />
                                <select
                                    id="bgcolor"
                                    v-model="form.selected"
                                    class="
                                        border-gray-300
                                        focus:border-indigo-300
                                        focus:ring
                                        focus:ring-indigo-200
                                        focus:ring-opacity-50
                                        rounded-md
                                        shadow-sm
                                    "
                                >
                                    <option disabled value="">
                                        Please select one
                                    </option>
                                    <option value="blue">Blue</option>
                                    <option value="green">Green</option>
                                    <option value="pink">Pink</option>
                                    <option value="yellow">Yellow</option>
                                    <option value="purple">Purple</option>
                                </select>
                            </div>

                            <div class="mb-2">
                                <BreezeLabel
                                    for="public"
                                    value="Public or Private Collection"
                                />
                                <input
                                    type="checkbox"
                                    id="public"
                                    v-model="form.public"
                                    class="
                                        ml-2
                                        rounded
                                        border-gray-300
                                        text-indigo-600
                                        shadow-sm
                                        focus:border-indigo-300
                                        focus:ring
                                        focus:ring-indigo-200
                                        focus:ring-opacity-50
                                    "
                                />
                                <label for="public" class="ml-2"
                                    >Yes, make public</label
                                >
                                <br />
                            </div>
                            <div class="my-4 flex flex-row">
                                <BreezeButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Submit
                                </BreezeButton>
                                <Link
                                    :href="route('profile')"
                                    class="
                                        underline
                                        text-sm text-dark
                                        hover:text-gray-900
                                        ml-6
                                        mt-4
                                    "
                                >
                                    Cancel, back to profile
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import BreezeButton from "@/Components/Button.vue";
import BreezeCheckbox from "@/Components/Checkbox.vue";
import BreezeInput from "@/Components/Input.vue";
import BreezeLabel from "@/Components/Label.vue";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
        BreezeCheckbox,
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
                selected: "",
                public: false,
            }),
        };
    },

    methods: {
        submitCollection() {
            let formData = this.form;

            console.log(formData);

            this.$inertia.post(this.route("new.collection"), formData);

            // this.form.post(this.route("new.collection"));
        },
    },
};
</script>
