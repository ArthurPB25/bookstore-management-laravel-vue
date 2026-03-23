<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';

defineProps({ books: Object });

const deleteBook = (id) => {
    if (confirm('Deseja excluir este livro?')) {
        router.delete(route('books.destroy', id));
    }
};
</script>

<template>
    <Head title="Livros" />
    <AppLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800">Livros</h2>
                <Link :href="route('books.create')" class="bg-blue-600 text-white px-4 py-2 rounded">
                    + Novo Livro
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div v-if="$page.props.flash.success" class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ $page.props.flash.success }}
                </div>

                <div class="bg-white shadow-xl sm:rounded-lg p-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr class="text-left text-xs font-bold uppercase text-gray-500">
                                <th>Título</th><th>Autor</th><th>Preço</th><th class="text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr v-for="book in books.data" :key="book.id">
                                <td class="py-4">{{ book.title }}</td>
                                <td class="py-4">{{ book.author }}</td>
                                <td class="py-4 text-green-600">R$ {{ book.price }}</td>
                                <td class="py-4 text-right space-x-3">
                                    <Link 
                                            :href="route('books.edit', book.id)" 
                                            class="text-indigo-600 hover:text-indigo-900 mr-3"
                                        >
                                            Editar
                                    </Link>
                                    
                                    <button 
                                        v-if="$page.props.auth?.user?.roles?.includes('admin')" 
                                        @click="deleteBook(book.id)"
                                        class="text-red-600 hover:underline"
                                    >
                                        Excluir
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>