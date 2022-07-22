<template>
  <div v-if="pagination.links.length" class="pagination">
    <!-- Desktop View -->
    <div class="desktop-view hidden md:flex justify-between items-center flex-wrap">
      <div>
        <p class="flex items-center py-1 text-gray-500 text-sm">Showing {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }} Users</p>
      </div>

      <div class="flex flex-wrap">
        <!-- Prev Btn -->
        <button
          @click="loadPage(pagination.current_page - 1)"
          :disabled="pagination.current_page == 1"
          :class="{ disabled: pagination.current_page == 1 }"
          class="focus:ring-2 focus:ring-indigo-500 ring-offset-2 ring-offset-gray-100 link text-gray-500 prev-btn"
        >
          «
        </button>

        <!-- Style 1 Only 7 links -->
        <template v-if="pagination.last_page <= 7">
          <template v-for="link in links" :key="link">
            <button
              @click="loadPage(link)"
              v-if="link <= pagination.last_page"
              type="button"
              :disabled="link == pagination.current_page"
              :class="{ active: link == pagination.current_page }"
              class="link text-gray-500"
            >
              {{ link }}
            </button>
          </template>
        </template>

        <!-- Style 2 Only over 7 links -->
        <template v-if="pagination.last_page > 7">
          <!-- 1,2,... (current_page >) = 5-->
          <template v-if="pagination.current_page >= 5">
            <template v-for="link in links" :key="link">
              <button @click="loadPage(link)" v-if="link <= 2" type="button" class="focus:ring-2 focus:ring-indigo-500 link text-gray-500">
                {{ link }}
              </button>
            </template>
            <span class="link text-gray-500">...</span>
          </template>

          <!-- 1,2,3,4,5(first, current_page <= 4) / 3,4,5(middle, current_page >= 5 && <= 9) / 9,10,11,12,13(last current_page >= 10) -->
          <template v-for="link in links" :key="link">
            <template v-if="pagination.current_page <= 4 && link <= 5">
              <button
                @click="loadPage(link)"
                type="button"
                :disabled="link == pagination.current_page"
                :class="{ active: link == pagination.current_page }"
                class="focus:ring-2 focus:ring-indigo-500 link text-gray-500"
              >
                {{ link }}
              </button>
            </template>
            <template v-if="pagination.current_page >= 5 && pagination.current_page <= pagination.last_page - 4">
              <button
                @click="loadPage(link)"
                v-if="link >= pagination.current_page - 1 && link <= pagination.current_page + 1"
                type="button"
                :disabled="link == pagination.current_page"
                :class="{ active: link == pagination.current_page }"
                class="focus:ring-2 focus:ring-indigo-500 link text-gray-500"
              >
                {{ link }}
              </button>
            </template>
            <template v-if="pagination.last_page < 1 || (pagination.current_page >= pagination.last_page - 3 && link >= pagination.last_page - 4)">
              <button
                @click="loadPage(link)"
                type="button"
                :disabled="link == pagination.current_page"
                :class="{ active: link == pagination.current_page }"
                class="focus:ring-2 focus:ring-indigo-500 link text-gray-500"
              >
                {{ link }}
              </button>
            </template>
          </template>

          <!-- ...,12,13 (current_page >= 5 && < 10) -->
          <template v-if="pagination.current_page < pagination.last_page - 3">
            <span class="link text-gray-500">...</span>
            <template v-for="link in links" :key="link">
              <button @click="loadPage(link)" v-if="link >= pagination.last_page - 1 && link <= pagination.last_page + 1" type="button" class="focus:ring-2 focus:ring-indigo-500 link text-gray-500">
                {{ link }}
              </button>
            </template>
          </template>
        </template>

        <!-- Next Btn -->
        <button
          @click="loadPage(pagination.current_page + 1)"
          :disabled="pagination.current_page == pagination.last_page"
          :class="{ disabled: pagination.current_page == pagination.last_page }"
          class="focus:ring-2 focus:ring-indigo-500 link text-gray-500 next-btn"
        >
          »
        </button>
      </div>
    </div>

    <div class="mobile-view md:hidden flex justify-between items-center">
      <div class="flex items-center">
        <!-- First Btn -->
        <button
          @click="loadPage(1)"
          :disabled="pagination.current_page == 1"
          :class="{ disabled: pagination.current_page == 1 }"
          class="focus:ring-2 focus:ring-indigo-500 ring-offset-2 ring-offset-gray-100 link text-gray-500 bg-white m-shadow prev-btn text-sm"
        >
          First
        </button>
        <!-- Previous Btn -->
        <button
          @click="loadPage(pagination.current_page - 1)"
          :disabled="pagination.current_page == 1"
          :class="{ disabled: pagination.current_page == 1 }"
          class="focus:ring-2 focus:ring-indigo-500 ring-offset-2 ring-offset-gray-100 link text-gray-500 bg-white m-shadow prev-btn text-sm"
        >
          Previous
        </button>
      </div>

      <p class="py-1 mx-4 text-gray-500 text-sm">{{ pagination.current_page }} of {{ pagination.last_page }} pages</p>

      <div class="flex items-center">
        <!-- Next Btn -->
        <button
          @click="loadPage(pagination.current_page + 1)"
          :disabled="pagination.current_page == pagination.last_page"
          :class="{ disabled: pagination.current_page == pagination.last_page }"
          class="focus:ring-2 focus:ring-indigo-500 ring-offset-2 ring-offset-gray-100 link text-gray-500 bg-white m-shadow next-btn text-sm"
        >
          Next
        </button>
        <!-- Last Btn -->
        <button
          @click="loadPage(pagination.last_page)"
          :disabled="pagination.current_page == pagination.last_page"
          :class="{ disabled: pagination.current_page == pagination.last_page }"
          class="focus:ring-2 focus:ring-indigo-500 ring-offset-2 ring-offset-gray-100 link text-gray-500 bg-white m-shadow next-btn text-sm"
        >
          Last
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { computed } from "@vue/reactivity";

export default {
  props: {
    pagination: Object,
  },
  setup(props) {
    const links = computed(() => {
      return Array.from(Array(props.pagination.last_page).keys(), link => link + 1);
    });

    function loadPage(page) {
      Inertia.get(Inertia.page.url, {
        page,
      });
    }

    return {
      loadPage,
      links,
    };
  },
};
</script>

<style>
.pagination .link {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 0.5rem 0.9rem;
  border-radius: 0.375rem;
  margin: 0 0.2rem;
}

.pagination .prev-btn,
.pagination .next-btn {
  padding: 0.5rem 0.9rem;
  margin: 0 0.3rem;
}

.m-shadow {
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.pagination .active {
  background-color: #fff;
  cursor: pointer;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.disabled {
  cursor: not-allowed;
  color: #bbb;
  box-shadow: unset !important;
}
/* a.link:not(:last-child),
span.link:not(:last-child) {
  border-right: none;
}

i {
  font-size: 0.775rem;
} */
</style>
