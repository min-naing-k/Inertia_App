<template>
  <Link
    :class="{ 'bg-gray-900 text-white': active }"
    class="
      text-gray-300
      hover:bg-gray-700 hover:text-white
      px-3
      py-2
      rounded-md
      text-sm
      font-medium
    "
  >
    <slot />
  </Link>
</template>

<script setup>
const props = defineProps({
  active: Boolean,
});
</script>

<style scope>
.underline {
  font-weight: bold;
  text-decoration: underline;
}
</style>