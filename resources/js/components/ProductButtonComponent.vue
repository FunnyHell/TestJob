<script>
export default {
    name: "ProductButtonComponent",
    props: ['product', 'csrf'],
    data() {
        return {
            is_creating: false,
        }
    },
    methods: {
        createToggle() {
            this.is_creating = !this.is_creating;
        }
    }
}
</script>

<template>
    <button @click="createToggle"
            class="absolute right-5 top-20 bg-sky-500 text-center text-white py-2 px-11 rounded cursor-pointer">Добавить
    </button>
    <div v-show="is_creating">
        <div class="absolute right-0 top-20 bg-gray-700 px-4 py-6 text-white text-xs w-2/5 z-10">
            <div class="flex justify-between">
                <h1 class="font-bold text-xl">Добавить продукт</h1>
                <div @click="createToggle" class="cursor-pointer">
                    <img src="/img/close.png" alt="close">
                </div>
            </div>

            <product-edit-modal-component :csrf="csrf"></product-edit-modal-component>
        </div>
    </div>
</template>

<style scoped>

</style>
