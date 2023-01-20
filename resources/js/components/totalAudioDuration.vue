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
                loaded: [],
            }
        },
        mounted() {
            this.obj.forEach((item, index) => {
                this.files.push({audio: new Audio('https://laravelmyaudiolib.s3.amazonaws.com/' + item)});
                this.files[index].audio.addEventListener('canplaythrough', () => {
                    this.loaded.push(true);
                    console.log('a');  
                    this.getFile()
                });
            });
        },
        methods: {
            getFile() {    
                if (this.loaded.length === this.files.length) {  
                    console.log('a');  
                    this.files.forEach(item => {
                        this.duration = this.duration + item.duration;
                    });
                    this.duration = formatTime(this.duration)
                }
            }
        },
    }
</script>
