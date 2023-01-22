<template>
    <div class="col-2">
        <button :id="'fav-btn-' + book" :class="['btn', checked ? 'btn-success' : 'btn-outline-success', 'rounded-circle']" @click="setFavStatus()">
            <i :id="'fav-icon-' + book" :class="[ checked ? 'fa-solid' : 'fa-regular', 'fa-star']"></i>
        </button>
    </div>
</template>

<script>
    export default {
        props: [
            'book',
            'userId'
        ],
        data() {
            return {
                user: null,
                favBtn: undefined,
                favIcon: undefined,
                checked: false
            }
        },
        mounted() {
            this.user = this.userId;
            this.favBtn = document.getElementById('fav-btn-' + this.book);
            this.favIcon = document.getElementById('fav-icon-' + this.book);
            if (this.user !== null) {
                this.getFavStatus();
            }
        },
        methods: {
            getFavStatus() {
                let form = new FormData();
                form.append('user', this.userId);
                form.append('book', this.book);
                axios.post('/get-fav-status', form).then((result) => {
                    this.checked = result.data.status;
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
                        if (!this.checked) {
                            if (window.location.href.includes('/fav-books')) {
                                window.location.reload(); 
                            }
                        }
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
