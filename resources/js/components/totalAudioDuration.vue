<template>
    <span id="duration"> {{ duration || '00:00:00' }}</span>
</template>
<script>

const formatTime = second => new Date(second * 1000).toISOString().substr(11, 8);
    export default {
        props: [
            'obj'
        ],
        data() {
            return {
                duration: null,
                files: [],
            }
        },
        mounted() {
            this.obj.forEach(item => {
                this.files.push(new Audio('https://laravelmyaudiolib.s3.amazonaws.com/' + item))
            });

            setTimeout(() => {this.getFile()}, 5000);
        },
        methods: {
            getFile() {    
                this.files.forEach(item => {
                    this.duration = this.duration + item.duration;
                });
                this.duration = formatTime(this.duration)
            }
        },
    }
</script>
