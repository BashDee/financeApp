<script setup lang="ts">
import { ref } from 'vue';
import { Head, useForm, usePage, router } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import InputError from '@/components/InputError.vue';

const page = usePage();
const needs = page.props.needs || [];
const wants = page.props.wants || [];

const needForm = useForm({
    title: '',
    description: '',
    amount: ''
});
const wantForm = useForm({
    title: '',
    description: '',
    amount: ''
});

const deletingNeedId = ref<number|null>(null);
const deletingWantId = ref<number|null>(null);

function removeNeed(id: number) {
    deletingNeedId.value = id;
    router.delete(route('needs.destroy', id), {
        onFinish: () => deletingNeedId.value = null
    });
}
function removeWant(id: number) {
    deletingWantId.value = id;
    router.delete(route('wants.destroy', id), {
        onFinish: () => deletingWantId.value = null
    });
}

const submitNeed = () => {
    needForm.post(route('needs.store'), {
        onSuccess: () => needForm.reset()
    });
};
const submitWant = () => {
    wantForm.post(route('wants.store'), {
        onSuccess: () => wantForm.reset()
    });
};
</script>

<template>
    <Head title="Needs & Wants" />
    <AppLayout>
        <div class="max-w-3xl mx-auto py-8 space-y-10">
            <h1 class="text-2xl font-bold mb-4">Needs</h1>
            <form @submit.prevent="submitNeed" class="space-y-4 mb-8">
                <div>
                    <Label for="need-title">Title</Label>
                    <Input id="need-title" v-model="needForm.title" required />
                    <InputError :message="needForm.errors.title" />
                </div>
                <div>
                    <Label for="need-description">Description</Label>
                    <Input id="need-description" v-model="needForm.description" />
                    <InputError :message="needForm.errors.description" />
                </div>
                <div>
                    <Label for="need-amount">Amount</Label>
                    <Input id="need-amount" v-model="needForm.amount" type="number" step="0.01" />
                    <InputError :message="needForm.errors.amount" />
                </div>
                <Button :disabled="needForm.processing">Add Need</Button>
            </form>
            <ul class="space-y-2">
                <li v-for="need in needs" :key="need.id" class="border p-3 rounded flex items-center justify-between">
                    <div>
                        <div class="font-semibold">{{ need.title }}</div>
                        <div class="text-sm text-gray-600">{{ need.description }}</div>
                        <div v-if="need.amount" class="text-sm">Amount: {{ need.amount }}</div>
                    </div>
                    <Button
                        variant="destructive"
                        size="sm"
                        :disabled="deletingNeedId === need.id"
                        @click="removeNeed(need.id)"
                    >
                        <span v-if="deletingNeedId === need.id">Removing...</span>
                        <span v-else>Remove</span>
                    </Button>
                </li>
            </ul>

            <h1 class="text-2xl font-bold mt-10 mb-4">Wants</h1>
            <form @submit.prevent="submitWant" class="space-y-4 mb-8">
                <div>
                    <Label for="want-title">Title</Label>
                    <Input id="want-title" v-model="wantForm.title" required />
                    <InputError :message="wantForm.errors.title" />
                </div>
                <div>
                    <Label for="want-description">Description</Label>
                    <Input id="want-description" v-model="wantForm.description" />
                    <InputError :message="wantForm.errors.description" />
                </div>
                <div>
                    <Label for="want-amount">Amount</Label>
                    <Input id="want-amount" v-model="wantForm.amount" type="number" step="0.01" />
                    <InputError :message="wantForm.errors.amount" />
                </div>
                <Button :disabled="wantForm.processing">Add Want</Button>
            </form>
            <ul class="space-y-2">
                <li v-for="want in wants" :key="want.id" class="border p-3 rounded flex items-center justify-between">
                    <div>
                        <div class="font-semibold">{{ want.title }}</div>
                        <div class="text-sm text-gray-600">{{ want.description }}</div>
                        <div v-if="want.amount" class="text-sm">Amount: {{ want.amount }}</div>
                    </div>
                    <Button
                        variant="destructive"
                        size="sm"
                        :disabled="deletingWantId === want.id"
                        @click="removeWant(want.id)"
                    >
                        <span v-if="deletingWantId === want.id">Removing...</span>
                        <span v-else>Remove</span>
                    </Button>
                </li>
            </ul>
        </div>
    </AppLayout>
</template> 