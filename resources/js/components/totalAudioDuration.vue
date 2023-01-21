<template>
    <span id="duration"> {{ totalDuration || '00:00:00' }}</span>
    <!-- <button class="btn btn-success ms-2" @click="setBookDuration()" :disabled="!completed">S</button> -->
</template>
<script>

const formatTime = second => new Date(second * 1000).toISOString().substr(11, 8);
    export default {
        props: [
            // 'obj',
            // 'book',
            'durationValue'
        ],
        data() {
            return {
                totalDuration: null,
                // duration: null,
                // files: [],
                // loaded: [],
                // completed: false,
            }
        },
        mounted() {
            this.totalDuration = formatTime(this.durationValue);
            // this.obj.forEach((item, index) => {
            //     this.files.push({audio: new Audio('https://laravelmyaudiolib.s3.amazonaws.com/' + item)});
            //     this.files[index].audio.addEventListener('loadeddata', () => {
            //         this.loaded.push(true);
            //         this.duration = this.duration + this.files[index].audio.duration;  
            //         this.totalDuration = formatTime(this.duration);
            //         this.complete();
            //     });
            // });
        },
        methods: {
            complete() {
                if (this.files.length == this.loaded.length) {
                    this.completed = true;
                    console.log(this.duration);
                }
            },
            setBookDuration() {
                window.location = '/set-book-duration/' + this.book + '/' + this.duration;
            }
        },
    }
</script>
