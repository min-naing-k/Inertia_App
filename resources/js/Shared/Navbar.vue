<template>
  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="flex-1 flex items-center justify-between">
          <div class="flex-shrink-0 flex items-center">
            <img class="block h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg" alt="Workflow" />
            <div class="ml-2">
              <h1 class="text-2xl text-white">Inertia Demo</h1>
              <small class="text-white text-xs text-gray-300 block" style="margin-top: -1px"> Welcome come {{ username }} </small>
            </div>
          </div>

          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">
              <NavLink href="/" :active="$page.component === 'Home'"> Home </NavLink>
              <NavLink href="/users" :active="$page.component === 'Users/Index'"> Users </NavLink>
              <NavLink href="/settings" :active="$page.component === 'Settings'"> Settings </NavLink>
              <Link href="/logout" method="post" as="button" :data="{ foo: 'bar' }" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium"> Logout </Link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import NavLink from "./NavLink";
export default {
  components: { NavLink },
  computed: {
    username() {
      return this.$page.props.auth.user.username;
    },
  },
};
</script>