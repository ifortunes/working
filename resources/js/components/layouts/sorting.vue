<template>
    <div>
        <div class="row justify-center q-mt-md q-gutter-md">
            <q-select
                v-for="(item, i ) in sortMethods" :key="i"
                transition-show="flip-up"
                transition-hide="flip-down"
                clearable
                v-model="sortMethods[i].model"
                :options="sortMethods[i].options"
                :label="item.label"
                style="width: 250px"
                @update:model-value="sorting()"
            ></q-select>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import {useStore} from "vuex";

export default {
    name: "sorting",
    props:{
        page: {
            required: true
        }
    },
    setup(props){
        const store = useStore();

        const sortMethods = ref({
            created_at: {
                model: '',
                label: 'По дате создания',
                options: [
                    {
                        label: 'По убыванию',
                        value: 'desc',
                        prefix: 'name',
                    },
                    {
                        label: 'По возрастанию',
                        value: 'asc',
                        prefix: 'name',
                    },
                ]
            },
            price: {
                model: '',
                label: 'По цене',
                options: [
                    {
                        label: 'По убыванию',
                        value: 'desc',
                        prefix: 'price',
                    },
                    {
                        label: 'По возрастанию',
                        value: 'asc',
                        prefix: 'price',
                    },
                ]
            }
        })
        const queryString = ref('');

        return {
            sortMethods,

            clearQueryString(){
                queryString.value = ''
            },
            sorting(){
                this.clearQueryString()

                let sorts = {
                    desc: [],
                    asc: [],
                }

                Object.keys(sortMethods.value).forEach((k, i) => {
                    if (sortMethods.value[k].model) {
                        if (sortMethods.value[k].model.value !== undefined) {
                            sorts[sortMethods.value[k].model.value].push(k)
                        }
                    }
                });

                Object.keys(sorts).forEach((k, i) => {
                    if (sorts[k].length > 0) {

                        queryString.value += '&' + k + '=' + sorts[k].shift()

                        sorts[k].forEach(function(entry) {
                            queryString.value += ',' + entry
                        });
                    }
                });

                store.dispatch('GET_ADVERTISEMENTS', {
                    page: props.page,
                    query: queryString.value
                })
            },
        }
    }
}
</script>

<style scoped>

</style>
