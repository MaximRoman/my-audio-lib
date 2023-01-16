<template>
    <div class="row justify-content-center">
        <ul class="col-7 list-group bg-secondary p-3">
            <label class="d-flex w-100 justify-content-between align-items-center">
                <span>{{ listName }}</span>
                <div class="d-flex">
                    <input class="form-control w-100 text-light bg-secondary rounded-0 rounded-start"  type="text" id="search" placeholder="Поиск..." @input="search()">
                    <button class="btn btn-danger rounded-0 rounded-end border border-start-0" id="clear-search" @click="resetSearch()"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </label>
            <li v-for="item in list" class="list-group-item bg-gray text-light d-flex justify-content-between mt-2 rounded" :id="'li-' + item.id" @click="this.click(item.id)">
                <span>{{ item[nameInput] }}</span>
                <button v-if="typeInput == 'checkbox'" class="btn btn-light d-flex align-items-center justify-content-center" style="width: 20px; height: 20px;" :id="item.id" value="0">
                    <div class="">
                        <i :id="'icon-' + item.id" class="fa-solid fa-check text-transparent w-100 h-100"></i>
                    </div>
                </button>
            </li>
            <li v-if="list.length == 0" class="list-group-item bg-gray text-light d-flex justify-content-between mt-2 rounded border-danger"><h5 class="m-0 text-danger">{{ message }}</h5></li>
        </ul>        
    </div>
</template>

<script>
    export default {
        props: [
            'listName',
            'items',
            'nameInput',
            'typeInput',
            'emptyMessage',
            'url',
        ],
        data() {
            return {
                list: [],
                checked: false, 
                searchInput: undefined,
                searchClear: undefined,
                message: '',
            }
        },
        mounted() {
            this.message = this.emptyMessage;
            this.searchInput = document.getElementById('search');
            this.searchClear = document.getElementById('clear-search');
            this.list = this.items;
            this.resetSession();
        },
        methods: {
            async click(id) {
                const li = document.getElementById('li-' + id);
                const btn = document.getElementById(id);
                const icon = document.getElementById('icon-' + id);
                let form = new FormData();
                
                if (btn.value == 1) {
                    form.append('author', id);
                    form.append('checked', 2);
                    await axios.post(this.url, form).then((result) => {
                        li.classList.remove('active');
                        btn.classList.replace('btn-success', 'btn-light');
                        icon.classList.replace('text-white', 'text-transparent');
                        btn.value = 0;
                    }).catch((err) => {
                       console.log(err); 
                    });
                } else {
                    form.append('author', id);
                    form.append('checked', 1);
                    await axios.post(this.url, form).then((result) => {
                        li.classList.add('active');
                        btn.classList.replace('btn-light', 'btn-success');
                        icon.classList.replace('text-transparent', 'text-white');
                        btn.value = 1;
                    }).catch((err) => {
                       console.log(err); 
                    });
                }
            },
            async resetSession() {
                let form = new FormData();
                form.append('author', 0);
                form.append('checked', 3);
                await axios.post(this.url, form).then((result) => {
                }).catch((err) => {
                   console.log(err); 
                });
            },
            search() {
                if (this.searchInput.value.length > 0) {
                    this.list =  this.list.filter(element => element[this.nameInput].includes(this.searchInput.value));  
                    this.message = "Нет результата";
                } else {
                    this.resetSearch();
                }
            },
            resetSearch() {
                this.list =  this.items;
                this.message = this.emptyMessage;
                this.searchInput.value = '';
            },
        }
    }
</script>
