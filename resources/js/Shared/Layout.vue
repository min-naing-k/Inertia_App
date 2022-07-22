<template>
  <Head>
    <title>My App</title>
    <meta type="description" content="Information of my app" head-key="description" />
  </Head>
  <section>
    <Navbar />
  </section>

  <section class="p-6 bg-gray-100">
    <div class="max-w-3xl mx-auto">
      <slot />
    </div>
  </section>
</template>

<script>
import Navbar from "./Navbar";
export default {
  components: { Navbar },
};
</script>

<style>
.body {
  background-color: red;
}
</style>