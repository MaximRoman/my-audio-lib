<template>
    <div id="comments" class="card bg-gray p-0">
        <div class="card-header ">
            <div class="row align-items-center">
                <span class="col-3">Коментарии :</span>
                <div class="col-9 d-flex">
                    <input class="form-control rounded-0 rounded-start bg-secondary text-light" type="text" name="search-comment" placeholder="Поиск . . .">
                    <button class="btn btn-success rounded-0 rounded-end border border-start-0 "><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
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
                <div class="card bg-gray p-0 border-success" v-for="item in comments">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ item.name }}</span>
                            <div class="d-flex gap-2">
                                <button class="btn btn-outline-success p-1"><i class="fa-regular fa-thumbs-up"></i> {{ 0 }}</button>
                                <button class="btn btn-outline-success p-1"><i class="fa-regular fa-thumbs-down"></i> {{ 0 }}</button>
                            </div>
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
            book: null
        },
        data() {
            return {
                comments: [],
            }
        },
        mounted() {
            this.comments = "faidbidbaubd !";
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
                let form = new FormData();
                let text = document.getElementById('comment-text').value;
                form.append('comment', text);
                axios.post('/add-comment/' + this.book, form).then((result) => {
                    document.getElementById('comment-text').value = '';
                    this.refreshComments()
                }).catch((err) => {
                    console.log(err);
                });
            },
        },
    }
</script>
