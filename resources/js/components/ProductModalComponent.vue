<script>
import ProductEditModalComponent from "./ProductEditModalComponent.vue";

export default {
    name: "ProductModalComponent",
    components: {ProductEditModalComponent},
    props: ['product', 'user', 'csrf'],
    data() {
        return {
            'is_active': false,
            'is_editing': false,
            'is_admin': false,
        }
    },
    methods: {
        toggleActive() {
            this.is_active = !this.is_active;
            console.log(this.is_active);
        },
        toggleEdit() {
            this.is_active = !this.is_active;
            this.is_editing = !this.is_editing;
        }
    },
    mounted() {
        if(this.user.role_id === 1) this.is_admin = true;
        console.log(this.is_admin);
    }
}
</script>

<template>
    <div @click="toggleActive" class="grid grid-cols-4 border-y py-4 text-left items-center cursor-pointer text-xs">
        <h2>{{ product.article }}</h2>
        <h2>{{ product.name }}</h2>
        <h2 v-if="product.status === 'available'">Доступен</h2>
        <h2 v-else>Не доступен</h2>
        <h2>
            <p v-for="data in JSON.parse(product.data)">{{data.Name}}: {{data.Value}}</p>
        </h2>
    </div>

    <div v-show="is_active" class="absolute right-0 top-20 bg-gray-700 px-4 py-6 text-white text-xs w-2/5 z-10">
        <div class="flex justify-between">
            <h1 class="font-bold">{{ product.name }}</h1>
            <div class="flex space-x-1">
                <div v-show="is_admin" class="flex space-x-1 items-center">
                    <div @click="toggleEdit" class="p-1 cursor-pointer">
                        <img src="/img/edit.png" alt="edit">
                    </div>
                    <div class="p-1 cursor-pointer">
                        <img src="/img/delete.png" alt="delete">
                    </div>
                </div>
                <div @click="toggleActive" class="cursor-pointer">
                    <img src="/img/close.png" alt="close">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-4 py-4 w-2/3">
            <h2 class="opacity-70 py-2">Артикул</h2>
            <h2 class="col-span-3">{{ product.article }}</h2>
            <h2 class="opacity-70 py-2">Название</h2>
            <h2 class="col-span-3">{{ product.name }}</h2>
            <h2 class="opacity-70 py-2">Статус</h2>
            <h2 v-if="product.status === 'available'" class="col-span-3">Доступен</h2>
            <h2 v-else class="col-span-3">Не доступен</h2>
            <h2 class="opacity-70 py-2">Атрибуты</h2>
            <h2>
                <p v-for="data in JSON.parse(product.data)">{{data.Name}}: {{data.Value}}</p>
            </h2>
        </div>
    </div>

    <div v-show="is_editing">
        <div class="absolute right-0 top-20 bg-gray-700 px-4 py-6 text-white text-xs w-2/5 z-10">

            <div class="flex justify-between">
                <h1 class="font-bold text-xl">Редактировать {{ product.name }}</h1>
                <div @click="toggleEdit" class="cursor-pointer">
                    <img src="/img/close.png" alt="close">
                </div>
            </div>
            <product-edit-modal-component :product="product" :csrf="csrf"></product-edit-modal-component>
        </div>
    </div>
</template>

<style scoped>
@tailwind base;
@tailwind components;
@tailwind utilities;
</style>
