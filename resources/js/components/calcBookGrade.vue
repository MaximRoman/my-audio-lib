<template>
    <span class="h5 text-primary">{{ result || 0 }} / 10</span>
</template>

<script>
    export default {
        props: {
            grades: null
        },
        data() {
            return {
                totalGrades: 0,
                totalLikes: 0,
                totalDislikes: 0,
                result: null,
            }
        },
        mounted() {
            if (this.grades.length > 0) {
                this.totalGrades = this.grades.length;
                this.grades.forEach(item => {
                    if (item.status) {
                        this.totalLikes = this.totalLikes + 1;
                    } else {
                        this.totalDislikes = this.totalDislikes + 1;
                    }
                });
                this.calcGrades();
            } else {
                this.result = '?';
            }
        },
        methods: {
          calcGrades() {
            let likePercents = (10 * this.totalLikes) / this.totalGrades
            this.result = likePercents.toFixed(0);
          }  
        },
    }
</script>
