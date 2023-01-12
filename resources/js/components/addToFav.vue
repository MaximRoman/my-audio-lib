<template>
    <div class="col-2">
        <button :id="'fav-btn-' + book" class="btn btn-outline-success rounded-circle" @click="setFavStatus()"><i :id="'fav-icon-' + book" class="fa-regular fa-star"></i></button>
    </div>
</template>

<script>
    export default {
        props: [
            'book'
        ],
        data() {
            return {
                user: null,
                favBtn: undefined,
                favIcon: undefined,
                checked: true
            }
        },
        mounted() {
            this.favBtn = document.getElementById('fav-btn-' + this.book);
            this.favIcon = document.getElementById('fav-icon-' + this.book);
            this.getFavStatus();
        },
        methods: {
            check() {
                if (this.checked == 1) {    
                    this.favBtn.classList.replace('btn-outline-success', 'btn-success');
                    this.favIcon.classList.replace('fa-regular', 'fa-solid');
                } else {
                    this.favBtn.classList.replace('btn-success', 'btn-outline-success');
                    this.favIcon.classList.replace('fa-solid', 'fa-regular');
                }
            },
            getFavStatus() {
                axios.get('/get-fav-status/' + this.book).then((result) => {
                    this.checked = result.data.status;
                    this.user = result.data.user;
                    this.check();
                }).catch((err) => {
                    console.log(err);
                });
            },
            setFavStatus() {
                if (this.user !== null) {
                    let form = new FormData();
                    form.append('book', this.book);
                    form.append('status', !this.checked ? 1 : 0); 
                    
                    axios.post('/set-fav-book', form).then((result) => {
                        this.checked = !this.checked;
                        this.check();
                    }).catch((err) => {
                        console.log(err);
                    });
                } else {
                    window.location = '/login';
                }
            },
        },
    }
</script>
