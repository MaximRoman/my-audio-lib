<template>
    <div class="d-flex gap-2">
        <button :id="'like-' + book.id" class="btn btn-outline-success" @click="likeFunction(1)"><i class="fa-regular fa-thumbs-up"></i> {{ like }}</button>
        <button :id="'dislike-' + book.id" class="btn btn-outline-success" @click="likeFunction(0)"><i class="fa-regular fa-thumbs-down"></i> {{ dislike }}</button>
        <a v-if="btn" class="btn btn-outline-success" :href="'/book/' + book.id + '/#comments'"><i class="fa-regular fa-comment"></i> {{ comments }}</a>
    </div>
</template>

<script>
    export default {
        props: [
            'book',
            'user',
            'btn',
        ],
        data() {
            return {
                usersGrades: null,
                grades: [],
                like: 0,
                dislike: 0,
                comments: 0,
            }
        },
        mounted() {
            this.getJson();
        },
        methods: {
            showGrades() {
                this.like = 0;
                this.dislike = 0;
                this.grades.forEach(item => {
                    switch (item.status) {
                        case 1:
                            this.like = this.like + 1;
                            break;
                        case 0:
                            this.dislike = this.dislike + 1;    
                            break;
                    }
                })
                if (this.usersGrades !== null) {
                    if (this.usersGrades) {
                        document.getElementById('like-' + this.book.id).classList = "btn btn-success";
                        document.getElementById('dislike-' + this.book.id).classList = "btn btn-outline-success";
                    } else {
                        document.getElementById('like-' + this.book.id).classList = "btn btn-outline-success";
                        document.getElementById('dislike-' + this.book.id).classList = "btn btn-success";
                    }
                } else {
                    document.getElementById('like-' + this.book.id).classList = "btn btn-outline-success";
                    document.getElementById('dislike-' + this.book.id).classList = "btn btn-outline-success";
                }
            },
            getJson() {
                axios.get('/get-book-grades/' + this.book.id).then((response) => {
                    this.usersGrades = response.data.usersGrades;
                    this.grades = response.data.grades;
                    this.comments = response.data.comments;
                    this.showGrades()
                })
            },
            likeFunction(item) {
                if (!this.user) {
                    window.location = '/login';
                }
                axios.get('/set-book-grade/' + this.book.id + '/' + item).then((response) => {
                    this.getJson();
                });
            },
        },
    }
</script>
