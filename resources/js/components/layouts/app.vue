<template>
    <div class="container">

        <createDialog></createDialog>

        <sorting :page="current"></sorting>

        <div class="row justify-center q-gutter-sm q-mt-md q-mb-md">
            <q-intersection
                v-for="(item, i) in advertisements"
                :key="i"
                class="example-item"
            >
                <q-card class="q-ma-sm">

                    <img :src="item.image">

                    <q-card-section>
                        <div class="text-h6">{{ item.name }}</div>
                        <div class="text-subtitle2">Цена: {{ item.price }}</div>
                    </q-card-section>
                    <q-card-actions>
                        <showDialog :item="item"></showDialog>
                        <q-space></q-space>
                    </q-card-actions>
                </q-card>
            </q-intersection>
        </div>

        <div class="q-pa-lg flex flex-center">
            <q-pagination
                v-model="current"
                :max="pagination.last_page"
                @click.prevent="getAdvertisements(undefined, undefined)"
            ></q-pagination>
        </div>

    </div>
</template>

<script>
import createDialog from '../create.vue'
import showDialog from '../show.vue'
import sorting from '../layouts/sorting.vue'

import {computed, onMounted} from 'vue';
import {useStore} from "vuex";

import { ref } from 'vue';

export default {
    components:{
        createDialog,
        showDialog,
        sorting
    },
    setup () {
        const store = useStore();

        const advertisements = computed(() => store.state.advertisements);
        const pagination = computed(() => store.state.pagination);

        const current = ref(1);

        const showAdvertisements = ref([]);

        const getAdvertisements = async () => {
            store.dispatch('GET_ADVERTISEMENTS', {
                page: current.value,
                query: ''
            })
        }

        onMounted(getAdvertisements())

        return {
            getAdvertisements,
            advertisements,
            showAdvertisements,
            pagination,
            createDialog,
            current,
        }
    }
}
</script>

<style scoped>
.example-item{
    width: 290px;
}

</style>
