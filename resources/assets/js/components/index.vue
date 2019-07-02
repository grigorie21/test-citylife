<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
cxvcxvcxvcxvxcv
                <!--Быстрый поиск-->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Поиск</span>
                    </div>
                    <input name="searchWord" type="text" v-model="searchWord" class="form-control"
                           placeholder="Введите слово">
                </div>



                <!--Кнопка для показа результатов быстрого поиска-->
                <!--<button type="button" class="btn btn-primary" @click="find()">Показать центры</button>-->

            </div>
            <!--<div class="col-6">-->

            <!--</div>-->
        </div>

        <!--таблица-->
        <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>


    </div>
</template>

<script>
    export default {
        props: [
            'model',
        ],
        mounted() {
            console.log('Component mounted.')
        },
        data() {

            return {
                searchWord: null,


                loading: true,



                columns: [
                    'serial_title_ru',
                    'serial_title_en',
                    'chapter_title_ru',
                    'chapter_title_en',
                    'url',
                    'date'
                ],

                tableData: this.model,

                sortOrder: [
                    {
                        field: 'date',
                        direction: 'ASC'
                    }
                ]
                options: {
                    perPage: 10,
                    filterable: true
                }

            }
        },
        methods: {
            // find() {
            //     axios
            //         .post('find', {
            //             searchWord: this.searchWord,
            //             checkBig: this.checkBig,
            //         })
            //         .then(response => {
            //             this.tableData = response.data.tableData;
            //             this.coordinates = response.data.coordinates;
            //         }).finally(() => (this.map(this.coordinates)));
            //
            // }


        }
    }


</script>



