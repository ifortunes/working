<template>
    <div>
        <div class="row justify-center q-mt-md">
            <q-btn
                padding="xl"
                color="primary"
                round
                icon="add"
                @click="createDialog = true"
            ></q-btn>
        </div>

        <q-dialog v-model="createDialog">
            <q-card class="my-card" style="min-width: 600px">
                <div class="q-pa-md" style="max-width: 600px">
                    <q-form
                        @submit.prevent="onSubmit"
                        class="q-gutter-md"
                    >
                        <q-input
                            v-model.trim="form.name"
                            label="Название объявления"
                            lazy-rules
                            :rules="[ val => val && val.length > 0 || 'Please type something']"
                        ></q-input>

                        <q-input
                            v-model.trim="form.price"
                            label="Цена"
                            lazy-rules
                            :rules="[ val => val && val.length > 0 || 'Please type something']"
                        ></q-input>

                        <q-input
                            type="textarea"
                            v-model="form.description"
                            label="Описание"
                            lazy-rules
                            :rules="[ val => val && val.length > 0 || 'Please type something']"
                        ></q-input>
                        <q-input
                            v-for="(link, i) in form.images"
                            :key="i"
                            v-model="link.url"
                            label="Ссылка на изображение"
                        ></q-input>
                        <div>
                            <q-btn label="Submit" type="submit" color="primary"></q-btn>
                        </div>
                    </q-form>

                </div>
            </q-card>
        </q-dialog>
    </div>
</template>

<script>
import { ref } from 'vue';
import {useStore} from "vuex";

export default {
    name: "create",
    setup(){
        const store = useStore();

        const createDialog = ref(false);

        const form = ref({
            name: '',
            description: '',
            price: '',
            images: [
                { url: 'https://cdn.quasar.dev/img/mountains.jpg' },
                { url: 'https://cdn.quasar.dev/img/parallax2.jpg' },
                { url: '' }
            ]
        })

        return {
            form,
            createDialog,
            onSubmit () {
                let images = [];

                form.value.images.forEach(function(entry) {
                    images.push(entry.url)
                });

                form.value.images = images

                store.dispatch('SET_ADVERTISEMENT', {
                    name: form.value.name,
                    description: form.value.description,
                    price: form.value.price,
                    // image: images[0],
                    images: images
                })

                createDialog.value = false

                store.dispatch('GET_ADVERTISEMENTS', {
                    page: 1,
                    query: ''
                })
            },
        }
    }
}
</script>

<style scoped>

</style>
