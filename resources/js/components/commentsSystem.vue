<template>
    <div id="comments" class="card bg-gray p-0">
        <div class="card-header ">
            <div class="row align-items-center">
                <span class="col-3">Коментарии :</span>
                <div class="col-9 d-flex">
                    <input id="search-comment" class="form-control bg-secondary text-light" type="text" name="search-comment" placeholder="Поиск . . ." @input="searchComment()">
                    <button id="search-comment-btn" class="btn btn-danger rounded-0 rounded-end border border-start-0 invisible" @click="searchResetInput()"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row gap-3">
                <div class="card bg-gray border-light p-0">
                    <div class="card-header d-flex align-items-center justify-content-between border-light">
                        <label for="comment">Добавить Коментарий:</label>
                        <button class="btn btn-success" @click="addComment()">Добавить</button>
                    </div>
                    <div class="card-body p-0">
                        <textarea class="form-control border-0 rounded-0 rounded-bottom bg-secondary text-light" name="comment" id="comment" cols="30" rows="5"></textarea>
                    </div>
                </div>
                <div v-if="err !== null" class="card bg-gray p-0 border-danger text-danger">
                    <div class="card-body">
                        <span class="h5">{{ err }}</span>
                    </div>
                </div>
                <div class="card bg-gray p-0 border-success" v-for="item in comments">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ item.name }}</span>
                            <div v-if="user !== null" >
                                <button v-if="user.id == item.user_id" class="btn btn-danger" @click="deleteComment(item.id, item.user_id)"><i class="fa-solid fa-trash"></i></button>
                            </div>
                            
                            <!-- <div class="d-flex gap-2">
                                <button class="btn btn-outline-success p-1"><i class="fa-regular fa-thumbs-up"></i> {{ 0 }}</button>
                                <button class="btn btn-outline-success p-1"><i class="fa-regular fa-thumbs-down"></i> {{ 0 }}</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <pre class="form-control border-0 rounded-0 rounded-bottom bg-secondary text-light m-0" name="comment" id="comment-text" disabled>{{ item.comment }}</pre>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            book: null,
            user: null
        },
        data() {
            return {
                comments: [],
                err: null,
            }
        },
        mounted() {
            document.getElementById('search-comment').addEventListener('input', (event) => {
                switch (event.target.value.length) {
                    case 0:
                        document.getElementById('search-comment-btn').classList.add('invisible');
                        document.getElementById('search-comment').classList.remove('rounded-0');
                        document.getElementById('search-comment').classList.remove('rounded-start');
                        break;
                
                    default:
                        document.getElementById('search-comment-btn').classList.remove('invisible');
                        document.getElementById('search-comment').classList.add('rounded-0');
                        document.getElementById('search-comment').classList.add('rounded-start');
                        break;
                }
            });
            this.refreshComments();
        },
        methods: {
            refreshComments() {
                axios.get("/get-comments/" + this.book).then((result) => {
                    this.comments = result.data.comments;
                }).catch((err) => {
                    console.log(err);
                });
            },
            addComment() {
                if (this.user !== null) {
                    if (this.user.email_verified_at !== null) {
                        let form = new FormData();
                        let text = document.getElementById('comment').value;
                        form.append('comment', text);
                        axios.post('/add-comment/' + this.book, form).then((result) => {
                            document.getElementById('comment').value = '';
                            this.refreshComments()
                        }).catch((err) => {
                            console.log(err);
                        });
                    } else {    
                        window.location = '/email/verify';
                    }
                } else {
                    window.location = '/login';
                }
            },
            deleteComment(id, user) {
                let form = new FormData();
                form.append('comment', id);
                form.append('user', user);

                axios.post('/delete-comment', form).then((result) => {
                    this.refreshComments();
                }).catch((err) => {
                    console.log(err);
                });
            },
            searchResetInput() {
                document.getElementById('search-comment').value = '';
                document.getElementById('search-comment-btn').classList.add('invisible');
                document.getElementById('search-comment').classList.remove('rounded-0');
                document.getElementById('search-comment').classList.remove('rounded-start');
                this.err = null;
                this.searchComment();
            },
            searchComment() {
                let form = new FormData();
                const inp = document.getElementById('search-comment');
                if (inp.value.length > 0) {
                    form.append('book', this.book);
                    form.append('comment', inp.value);

                    axios.post('/search-comments', form).then((result) => {
                        if (result.data.comments.length > 0) {
                            this.comments = result.data.comments;
                            this.err = null;
                        } else {
                            this.comments = [];
                            this.err = "По вашему запросу ничего не найдено.";
                        }
                    }).catch((err) => {
                        console.log(err);
                    });
                } else {
                    this.refreshComments();
                }
            },
        },
    }
</script>
