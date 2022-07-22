<template>
  <Head>
    <title>Users</title>
    <meta type="description" content="Information of users" head-key="description" />
  </Head>

  <div class="flex justify-between">
    <div class="flex items-center mb-4">
      <h1 class="text-2xl">Users</h1>

      <Link v-if="can.create_user" href="/users/create" class="block ml-4 mt-1 px-3 py-2 rounded-lg text-blue-500"> New User </Link>
    </div>

    <div class="flex items-center">
      <input type="text" class="appearance-none border rounded-lg py-2 px-3 text-gray-700 mb-3 leading-tight ring-inset-2 focus:ring-2 focus:ring-blue-500 focus:outline-none" placeholder="Search..." v-model="search" />
    </div>
  </div>

  <div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <tbody class="bg-white divide-y divide-gray-200">
              <template v-if="users.data.length">
                <tr v-for="user in users.data" :key="user.id">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">
                          {{ user.name }}
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <Link v-if="user.can.edit" :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900"> Edit </Link>
                    <Link :href="`/users/${user.id}`" method="delete" as="button" class="text-red-600 hover:text-red-900 ml-4"> Delete </Link>
                  </td>
                </tr>
              </template>
              <tr v-else>
                <p class="text-sm text-gray-500 text-center px-3 py-3">There is no data...</p>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <Pagination :pagination="pagination" class="mt-4" />
</template>

<script>
import { ref, watch, defineAsyncComponent, computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import debounce from "lodash/debounce";
import { useCurrentUser } from '@/composable/useCurrentUser';
const Pagination = defineAsyncComponent(() => import('@/Shared/Pagination.vue'));

export default {
  components: { Pagination },
  props: {
    users: Object,
    filter: Object,
    can: Object,
  },
  setup(props) {
    // const search = ref(props.filter.search ?? ""); get the search value from server side

    // get the search value from client side
    const params = new Proxy(new URLSearchParams(window.location.search), {
      get: (searchParams, prop) => searchParams.get(prop)
    });
    const search = ref(params.search ?? "");

    watch(
      search,
      debounce(value => {
        Inertia.get("/users", { search: value }, { preserveState: true, replace: true });
      }, 300)
    );

    const pagination = computed(() => {
      return {
        ...props.users.meta
      }
    });

    const user = useCurrentUser();
    const otherUser = {};

    console.log(user.is(otherUser));

    return { search, pagination };
  },
};
</script>

<style>
html {
  scroll-behavior: smooth;
}
</style>
