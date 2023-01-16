<template>
    <div class="d-flex w-100">
        <input class="form-control w-100 text-light bg-secondary rounded-0 rounded-start"  type="text" name="name" id="name" placeholder="Поиск...">
        <button class="btn btn-danger rounded-0 rounded-end border border-start-0" @click="resetSearch()"><i class="fa-solid fa-xmark"></i></button>
    </div>
</template>

<script>
    export default {
        props: [
            'url'
        ],
        data() {
            return {
                input: undefined,
            }
        },
        mounted() {
            this.input = document.getElementById('name');
            this.input.addEventListener('keypress', (e) => {
                if (e.key == 'Enter') {
                    this.search();
                }
            });
        },
        methods: {
            search() {
                let text = this.input.value;
                window.location = this.url + '?name=' + text;
            },
            resetSearch() {
                window.location = this.url;
            },
        },
    }
</script>
