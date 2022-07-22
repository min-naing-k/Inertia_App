<template>
  <Head title="Edit User" />

  <div class="mb-7">
    <h1 class="text-2xl">Edit User</h1>
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

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="role"> Role </label>
        <select
          class="shadow border rounded-md w-full text-gray-500 py-2 px-3 mb-3 leading-tight focus:outline-none"
          id="role"
          v-model="form.role"
          :class="{
            'border-red-500': form.errors.role,
          }"
        >
          <option value="" selected disabled>Choose Role</option>
          <option value="Manager">Manager</option>
          <option value="Stuff">Stuff</option>
        </select>
        <p v-if="form.errors.role" class="text-red-500 text-xs">
          {{ form.errors.role }}
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
          Save Changes
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";

export default {
  props: {
    user: Object,
  },
  setup(props) {
    const form = useForm({
      name: "",
      email: "",
      role: "",
      password: "",
    });

    form.name = props.user.name;
    form.email = props.user.email;
    form.role = props.user.role;

    const submit = () => {
      form.patch(`/users/${props.user.id}`, form);
    };

    return { form, submit };
  },
};
</script>

<style scope>
.disable {
  cursor: not-allowed;
}
</style>