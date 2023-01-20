<template>
    <div v-if="admin" class="d-flex gap-2">
        <button class="btn btn-warning h4" @click="editBook()"><i class="fa-solid fa-pen"></i></button>
        <button class="btn btn-danger h4" @click="deleteBook()"><i class="fa-solid fa-trash"></i></button>
    </div>
</template>

<script>
    export default {
        props: [
            'book',
            'adminProp',
        ],
        data() {
            return {
                admin: false
            }
        },
        mounted() {
            this.admin = this.adminProp;
        },
        methods: {
            getAdminInfo() {
                axios.get('/get-admin/info').then((result) => {
                    this.admin = result.data.admin;
                }).catch((err) => {
                    console.log(err);
                });
            },
            editBook() {
                window.location = '/edit-book/' + this.book;
            },
            deleteBook() {
                window.location = '/delete-book/' + this.book;
            },
        },
    }
</script>
