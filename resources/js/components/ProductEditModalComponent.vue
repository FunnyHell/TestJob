<script>
export default {
    name: "ProductEditModalComponent",
    props: ['product', 'csrf'],
    data() {
        return {
            is_editing: false,
            product_form: {
                article: this.article,
                name: this.name,
                status: this.status,
                data: this.attributes,
            },
        }
    },
    methods: {
        // Добавление нового атрибута (ключа и значения) в массив
        addAttribute() {
            if(!this.is_editing) this.is_editing = true;
            const json = JSON.parse(this.product_form.data);
            json.push({'Name': '', 'Value': ''})
            this.product_form.data = JSON.stringify(json)
        },

// Удаление атрибута (ключа и значения) из массива
        eraseAttribute(index) {
            const json = JSON.parse(this.product_form.data);
            // Удаляем атрибут по ключу
            json.splice(index, 1)
            this.product_form.data = JSON.stringify(json);
        },
        updateValue(key, event, type){
            const json = JSON.parse(this.product_form.data);
            console.log(json);
            if(type == 'data.Value') json[key].Value = event.target.value;
            else json[key].Name = event.target.value;
            this.product_form.data = JSON.stringify(json);
        },
        submit() {
            if (this.product) {
                axios.post('/api/products/' + this.product.id, this.product_form)
                    .then(() => {
                        console.log('success');
                    })
                    .catch(error => {
                        console.log(this.product_form);
                    })
            } else {
                axios.post('/api/products', this.product_form)
                    .then(() => {
                        console.log('success');
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        }
    },
    mounted() {
        // console.log(this.product)
        if (this.product) {
            this.is_editing = true;
            this.product_form.article = this.product.article;
            this.product_form.name = this.product.name;
            this.product_form.status = this.product.status;
            this.product_form.data = this.product.data;
        } else {
            this.product_form.article = '';
            this.product_form.name = '';
            this.product_form.status = 'unavailable';
            this.product_form.data = JSON.stringify([{'Name': '', 'Value': ''}]);
        }
    }
}
</script>

<template>
    <form method="post" @submit.prevent="submit">
        <div class="py-4 w-10/12">
            <h2 class="opacity-70 py-2">Артикул</h2>
            <input type="text" v-model="product_form.article"
                   class="w-full rounded p-2 font-roboto text-black" pattern="[0-9a-zA-Z]*" required/>
            <h2 class="opacity-70 py-2">Название</h2>
            <input type="text" v-model="product_form.name" class="w-full rounded p-2 font-roboto text-black"
                   minlength="10" required/>
            <h2 class="opacity-70 py-2">Статус</h2>
            <select v-model="product_form.status" class="w-full rounded p-2 font-roboto text-black">
                <option value="available">Доступен</option>
                <option value="unavailable">Не доступен</option>
            </select>
            <h2 class="opacity-70 py-2">Атрибуты</h2>
            <div v-if="is_editing">
                <div v-for="(data, key) in JSON.parse(product_form.data)" :key="key"
                     class="grid grid-cols-5 gap-x-4 gap-y-2">
                    <h2 class="col-start-1">Название</h2>
                    <h2 class="col-start-3">Значение</h2>
                    <input type="text" :value="data.Name" @input="updateValue(key, $event, 'data.Name')"
                           class="w-full rounded p-2 font-roboto text-black col-start-1 col-span-2" required/>
                    <input type="text" :value="data.Value" @input="updateValue(key, $event, 'data.Value')"
                           class="w-full rounded p-2 font-roboto text-black col-start-3 col-span-2" required/>
                    <div class="flex items-center cursor-pointer" @click="eraseAttribute(key)">
                        <img src="/img/delete.png" alt="delete" class="py-4">
                    </div>
                </div>
            </div>

            <button @click="addAttribute" class="py-4 text-sky-500 hover:underline decoration-dashed">Добавить атрибут
            </button>
            <br>
            <input type="submit" :value="product !== undefined ? 'Сохранить' : 'Добавить'"
                   class="bg-sky-500 text-center text-white py-3 px-11 rounded cursor-pointer mt-2">
        </div>
    </form>
</template>

<style scoped>

</style>
