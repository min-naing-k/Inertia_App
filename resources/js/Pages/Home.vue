<template>
  <Head title="Home" />

  <h1 class="text-2xl">Blogs</h1>

  <div>
    <Highlight :code="snippet" />
  </div>

  <div>
    <Highlight :code="snippet2" />
  </div>
</template>

<script setup>
import Highlight from '@/components/Highlight.vue';

const snippet = `
<div>
  <h1>Hello</h1>
</div>
`;

const snippet2 = `
class Example2 {
  public function __construct() {
    // something...
  }
}
`;
</script>

<style scoped>
div {
  margin: .5rem 0 2rem;
}
</style>