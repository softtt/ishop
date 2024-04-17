<script setup>

defineProps(['modelValue', 'items']);

defineEmits(['update:modelValue']);

</script>

<template>
  <select
      class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
      :value="modelValue" @input="$emit('update:modelValue', $event.target.value)" ref="select">
    <template v-for="option in items" :key="option.id">
      <option :value="option.id">{{ option.name }}</option>
    </template>
  </select>
</template>
