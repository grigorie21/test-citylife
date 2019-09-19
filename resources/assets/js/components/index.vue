<template>
    <div class="container">
        <v-client-table :data="tableData" :columns="columns" :options="options"></v-client-table>
    </div>
</template>

<script>
    export default {
        props: [
            'model',
        ],
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
                options: {
                    perPage: 10,
                    filterable: true,
                    orderBy: {column: 'date',  ascending:false}
                }
            }
        }
    }
</script>



