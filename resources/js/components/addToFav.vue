<template>
    <div class="col-2">
        <button :id="'fav-btn-' + book" :class="['btn', checked == 1 ? 'btn-success' : 'btn-outline-success', 'rounded-circle']" @click="setFavStatus()">
            <i :id="'fav-icon-' + book" :class="[ checked == 1 ? 'fa-solid' : 'fa-regular', 'fa-star']"></i>
        </button>
    </div>
</template>

<script>
    export default {
        props: [
            'book',
            'favProp',
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
                if (this.favProp.length > 0) {
                this.favProp.forEach(item => {
                    if (item.book_id === this.book && item.status == 1) {
                        this.checked = true;
                    }
                });
            }
            }
        },
        methods: {
            setFavStatus() {
                if (this.user !== null) {
                    let form = new FormData();
                    form.append('book', this.book);
                    form.append('status', !this.checked ? 1 : 0); 
                    
                    axios.post('/set-fav-book', form).then((result) => {
                        this.checked = !this.checked;
                        if (this.checked) {
                            window.location = '/fav-books';
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
