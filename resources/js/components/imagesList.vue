<template>
    <div class="row bg-secondary p-3 rounded">
        <div class="d-flex">
            <input class="form-control w-100 text-light bg-secondary rounded-0 rounded-start"  type="text" id="search" placeholder="Поиск..." @input="search()">
            <button class="btn btn-danger rounded-0 rounded-end border border-start-0" id="clear-search" @click="resetSearch()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div v-for="item in list" class="col-3 mt-3">
            <a class="btn btn-warning w-100 rounded-0 rounded-top" :href="'/edit-image/' + item.id"><i class="fa-solid fa-gear"></i></a>
            <img class="img-fluid" :src="'https://laravelmyaudiolib.s3.amazonaws.com/' + item.image" >
            <h5 class="bg-secondary m-0 p-1">{{item.name}}</h5>
            <a class="btn btn-success w-100 rounded-0 rounded-bottom" :href="url + item.id">Выбрать</a>
        </div>     
    </div>
</template>

<script>
    export default {
        props: [
            'images',
            'url'
        ],
        data() {
            return {
                list: [],
                searchInput: undefined,
                searchClear: undefined,
                message: '',
            }
        },
        mounted() {
            this.list = this.images;
            this.searchInput = document.getElementById('search');
            this.searchClear = document.getElementById('clear-search');
        },
        methods: {
            search() {
                if (this.searchInput.value.length > 0) {
                    this.list =  this.images;
                    this.list =  this.list.filter(element => element['name'].toLowerCase().includes(this.searchInput.value.toLowerCase()));  
                    this.message = "Нет результата";
                } else {
                    this.resetSearch();
                }
            },
            resetSearch() {
                this.list =  this.images;
                this.searchInput.value = '';
            },
        }
    }
</script>
