<template>
    <div>
        <q-btn flat label="Читать" color="primary" @click="showDialog()"></q-btn>

        <q-dialog v-model="open">
            <q-card class="my-card" style="min-width: 600px">
                <div class="q-pa-md" style="max-width: 600px">
                    <q-card class="my-card">
                        <img :src="item.image">

                        <q-card-section>
                            <div class="text-h6">{{ item.name }}</div>
                            <div class="text-subtitle2">{{ item.price }}</div>
                        </q-card-section>

                        <q-card-section class="q-pt-none">
                            {{ item.description }}
                        </q-card-section>
                    </q-card>
                </div>
            </q-card>
        </q-dialog>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    name: "show",
    props: {
      item: {
          required: true
      }
    },
    setup(){
        const open = ref(false);

        return {
            open,
            showDialog() {
                open.value = true
            },
        }
    }
}
</script>

<style scoped>

</style>
