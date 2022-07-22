<template>
  <Head title="Login" />

  <div class="my-7 text-center">
    <h1 class="text-2xl">Login</h1>
  </div>

  <div class="flex justify-center w-full">
    <form @submit.prevent="submit" class="bg-white mb-4 pb-8 pt-6 px-8 rounded-xl border border-gray-200 w-4/12 shadow-lg">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm mb-1" for="email"> Email </label>
        <input
          class="font-semibold appearance-none border rounded-md w-full p-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500"
          :class="{
            'focus:ring-opacity-0 border-red-500': form.errors.email,
          }"
          id="email"
          type="text"
          placeholder="Email"
          autocomplete="off"
          v-model="form.email"
        />
        <p v-if="form.errors.email" class="text-red-500 text-xs">
          {{ form.errors.email }}
        </p>
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm mb-1" for="password"> Password </label>
        <input
          class="font-semibold border rounded-md w-full p-3 text-gray-700 mb-1 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500"
          :class="{
            'focus:ring-opacity-0 border-red-500': form.errors.password,
          }"
          id="password"
          type="password"
          placeholder="Password"
          v-model="form.password"
        />
        <p v-if="form.errors.password" class="text-red-500 text-xs">
          {{ form.errors.password }}
        </p>
      </div>

      <div class="flex items-center justify-between">
        <button
          class="bg-indigo-500 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          :class="{
            'opacity-75 disable': form.processing,
          }"
          :disabled="form.processing"
          type="submit"
        >
          Login
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import { watch } from "@vue/runtime-core";

export default {
  layout: null,
  setup() {
    const form = useForm({
      email: "",
      password: "",
    });

    const submit = () => {
      form.post("login", form);
    };

    watch(
      () => form.errors,
      () => {
        form.reset("password");
      },
      {
        deep: true,
      }
    );

    return { form, submit };
  },
};
</script>

<style scope>
.disable {
  cursor: not-allowed;
}
</style>