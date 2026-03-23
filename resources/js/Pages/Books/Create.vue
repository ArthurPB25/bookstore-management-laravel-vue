<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
const props = defineProps({
    book: Object,
    categories: Array,
});
const form = useForm({
    title: '',
    author: '',
    isbn: '',
    price: '',
    publication_date: '',
    category_id: '' ,
});

const submit = () => {
    form.post(route('books.store'));
};
</script>

<template>
    <Head title="Novo Livro" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Cadastrar Novo Livro</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white p-6 shadow-xl sm:rounded-lg max-w-2xl">
                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Título</label>
                            <input v-model="form.title" type="text" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700">Autor</label>
                            <input v-model="form.author" type="text" class="w-full border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-medium text-sm text-gray-700">ISBN</label>
                                <input v-model="form.isbn" type="text" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Preço (R$)</label>
                                <input v-model="form.price" type="number" step="0.01" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700">Data de Publicação</label>
                                <input v-model="form.publication_date" type="date" class="w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div>
                                    <label class="block font-medium text-sm text-gray-700">Categoria</label>
                                    <select v-model="form.category_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                        <option value="">Selecione uma categoria</option>
                                        <option v-for="category in categories" :key="category.id" :value="category.id">
                                            {{ category.name }}
                                        </option>
                                    </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <Link :href="route('books.index')" class="text-sm text-gray-600 underline mr-4">Cancelar</Link>
                            <button type="submit" :disabled="form.processing" class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold">
                                Salvar Livro
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout>
</template>