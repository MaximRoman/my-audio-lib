<template>
    <span id="duration"> {{ '00:00:00' }}</span>
    <div v-for="(item, index) in fN">
        <audio :id="'audio' + index" :src="item"></audio>
    </div>
</template>
<script>

const formatTime = second => new Date(second * 1000).toISOString().substr(11, 8);
    export default {
        props: [
            'totalDuration'
        ],
        data() {
            return {
                duration: null,
            }
        },
        mounted() {
            console.log(this.totalDuration);
            // this.duration = formatTime(this.totalDuration.duration);
        },
    }
</script>
