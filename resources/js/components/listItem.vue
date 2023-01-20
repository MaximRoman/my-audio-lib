<template>
    <div class="row justify-content-center">
        <div class="col-7 p-2 bg-secondary rounded-top">
            <label class="d-flex w-100 justify-content-between align-items-center">
                <span>{{ listName }}</span>
                <div class="d-flex">
                    <input class="form-control w-100 text-light bg-secondary rounded-0 rounded-start"  type="text" id="search" placeholder="Поиск..." @input="search()">
                    <button class="btn btn-danger rounded-0 rounded-end border border-start-0" id="clear-search" @click="resetSearch()"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </label>
        </div>
        <ul class="col-7 list-group bg-secondary rounded-0 p-3 mvh-50" style="overflow: auto;">
            <li v-for="item in list" 
                :class="[
                            'list-group-item', 
                            'bg-gray', 'text-light', 
                            'd-flex', 'justify-content-between', 
                            'mt-2', 'rounded', checked.includes(item.id) ? 'active' : '' 
                        ]" 
                :id="'li-' + item.id" 
                @click="typeInput == 'checkbox' ?  
                                    this.clickCheckbox(item.id) : 
                                    typeInput == 'radio' ? 
                                                this.clickRadio(item.id) : 
                                                this.resetSession()"
            >
                <span>{{ item[nameInput] }}</span>
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
                checked: [],
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
            console.log(this.items);
            this.resetSession();
        },
        methods: {
            async postFunction(form, status) {
                await axios.post(this.url, form).then((result) => {
                    console.log(result.data.result);
                }).catch((err) => {
                    console.log(err); 
                    switch (status) {
                        case 1:
                            this.checked.push(id);
                            break;
                        case 2:
                            this.checked = this.checked.filter(item => item != id); 
                            break;
                        case 3:
                            this.checked = []; 
                            break;
                    }
                });
            },
            clickCheckbox(id) {
                const li = document.getElementById('li-' + id);
                let form = new FormData();
                
                if (this.checked.includes(id)) {
                    this.checked = this.checked.filter(item => item != id);
                    form.append('checked', JSON.stringify(this.checked));
                    this.postFunction(form, 1);
                } else {
                    this.checked.push(id);
                    form.append('checked', JSON.stringify(this.checked));
                    this.postFunction(form, 2);
                }
            },
            clickRadio(id) {
                const li = document.getElementById('li-' + id);
                let form = new FormData();

                this.checked = [id];
                form.append('checked', JSON.stringify(this.checked));
                this.postFunction(form, 1);
            },
            resetSession() {
                let form = new FormData();
                form.append('checked', JSON.stringify([]));
                this.postFunction(form, 3);
            },
            search() {
                if (this.searchInput.value.length > 0) {
                    this.list =  this.items;
                    this.list =  this.list.filter(element => element[this.nameInput].toLowerCase().includes(this.searchInput.value.toLowerCase()));  
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
