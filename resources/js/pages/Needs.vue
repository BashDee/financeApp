<script setup lang="ts">
import { ref, computed } from 'vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';

const page = usePage();
const needs = ref(page.props.needs || []);

// Inertia form for adding a need
const needForm = useForm({
  title: '',
  description: '',
  amount: '',
});

// track deletion in flight
const deletingNeedId = ref<number | null>(null);

// show/hide the add‐form
const showForm = ref(false);

function removeNeed(id: number) {
  deletingNeedId.value = id;
  router.delete(route('needs.destroy', id), {
    onSuccess: () => {
      needs.value = needs.value.filter((n: any) => n.id !== id);
      deletingNeedId.value = null;
    },
  });
}

function submitNeed() {
  needForm.post(route('needs.store'), {
    onSuccess: (page) => {
      // page.props.need is what your controller returns
      needs.value.push(page.props.need);
      needForm.reset();
      showForm.value = false;
    },
  });
}

// stub toggle – wire up to your API if you have an endpoint
function toggleCompleted(need: any) {
  need.completed = !need.completed;
}
</script>

<template>
  <Head title="Needs" />
  <AppLayout>
    <div class="max-w-3xl mx-auto py-8">
      <div class="relative overflow-hidden rounded-xl border border-gray-200 bg-white p-6">
        <h1 class="text-2xl font-bold mb-4">Needs</h1>

        <!-- LIST -->
        <ul
          v-if="needs.length"
          class="space-y-3 max-h-[400px] overflow-y-auto mb-2 pr-2"
        >
          <li
            v-for="need in needs"
            :key="need.id"
            class="flex items-center justify-between"
          >
            <div class="flex items-center space-x-3">
              <input
                type="checkbox"
                class="h-5 w-5 text-green-500 border-gray-300 rounded"
                :checked="need.completed"
                @change="toggleCompleted(need)"
              />
              <span class="truncate">{{ need.title }}</span>
            </div>

            <div class="flex items-center space-x-3">
              <span class="font-medium">${{ need.amount }}</span>
              <button
                @click="removeNeed(need.id)"
                :disabled="deletingNeedId === need.id"
                class="text-red-500 hover:text-red-700"
              >
                <span v-if="deletingNeedId === need.id" class="text-sm">…</span>
                <svg
                  v-else
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-4 w-4"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </li>
        </ul>

        <div v-else class="py-20 text-center text-gray-500">
          No needs added yet.
        </div>

        <!-- INLINE ADD FORM -->
        <transition name="fade">
          <form
            v-if="showForm"
            @submit.prevent="submitNeed"
            class="mt-4 space-y-4 border-t pt-4"
          >
            <div>
              <Label for="title">Title</Label>
              <Input
                id="title"
                v-model="needForm.title"
                placeholder="Need title"
                required
              />
              <InputError :message="needForm.errors.title" />
            </div>

            <div>
              <Label for="description">Description</Label>
              <Input
                id="description"
                v-model="needForm.description"
                placeholder="Description (optional)"
              />
              <InputError :message="needForm.errors.description" />
            </div>

            <div>
              <Label for="amount">Amount</Label>
              <Input
                id="amount"
                v-model="needForm.amount"
                type="number"
                step="0.01"
                placeholder="e.g. 1200.00"
              />
              <InputError :message="needForm.errors.amount" />
            </div>

            <div class="flex justify-end space-x-2">
              <Button type="button" variant="outline" @click="showForm = false">
                Cancel
              </Button>
              <Button type="submit" :disabled="needForm.processing">
                <span v-if="needForm.processing">Adding…</span>
                <span v-else>Add Need</span>
              </Button>
            </div>
          </form>
        </transition>

        <!-- FLOATING PLUS -->
        <button
          @click="showForm = !showForm"
          class="absolute left-1/2 transform -translate-x-1/2 bottom-4 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-3 shadow-lg"
        >
          <svg
            v-if="!showForm"
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
          </svg>
          <svg
            v-else
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            stroke-width="2"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </AppLayout>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>