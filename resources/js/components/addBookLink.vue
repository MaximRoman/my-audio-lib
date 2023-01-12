<template>
    <a v-if="admin" class="dropdown-item" href="/add-book">Добавить Книгу</a>
</template>

<script>
    export default {
        data() {
            return {
                admin: false
            }
        },
        mounted() {
            this.getAdminInfo();
        },
        methods: {
            getAdminInfo() {
                axios.get('/get-admin/info').then((result) => {
                    this.admin = result.data.admin;
                }).catch((err) => {
                    console.log(err);
                });
            },
        },
    }
</script>
