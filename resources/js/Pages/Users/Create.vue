<template>
  <Head title="Create User" />

  <div class="mb-7">
    <h1 class="text-2xl">Create User</h1>
  </div>

  <div class="flex justify-center w-full">
    <form @submit.prevent="submit" class="bg-white mb-4 pb-8 pt-6 px-8 rounded-xl border border-gray-300 w-7/12">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="name"> Name </label>
        <input
          class="shadow appearance-none border rounded-md w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none"
          :class="{
            'border-red-500': form.errors.name,
          }"
          id="name"
          type="text"
          placeholder="Name"
          autocomplete="off"
          v-model="form.name"
        />
        <p v-if="form.errors.name" class="text-red-500 text-xs">
          {{ form.errors.name }}
        </p>
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email"> Email </label>
        <input
          class="shadow appearance-none border rounded-md w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none"
          id="email"
          type="text"
          placeholder="Email"
          autocomplete="off"
          v-model="form.email"
          :class="{
            'border-red-500': form.errors.email,
          }"
        />
        <p v-if="form.errors.email" class="text-red-500 text-xs">
          {{ form.errors.email }}
        </p>
      </div>

      <div class="mb-6">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="password"> Password </label>
        <input
          class="shadow appearance-none border rounded-md w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none"
          :class="{
            'border-red-500': form.errors.password,
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
          class="bg-blue-500 text-white py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          :class="{
            'opacity-75 disable': form.processing,
          }"
          :disabled="form.processing"
          type="submit"
        >
          Create
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import { watch } from "@vue/runtime-core";

export default {
  setup() {
    const form = useForm({
      name: "",
      email: "",
      password: "",
    });

    const submit = () => {
      form.post("/users", form);
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