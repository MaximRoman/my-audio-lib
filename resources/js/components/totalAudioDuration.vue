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
            }
        },
        mounted() {
            this.duration = formatTime(this.obj);
        },
    }
</script>
