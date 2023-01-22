<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-secondary">
                    <div class="card-header d-flex flex-column gap-3">
                        <div class="row justify-content-between align-items-center" id="control-panel">
                            <div class="col-6 d-flex align-items-center justify-content-start gap-1">
                                <!-- <button class="btn btn-outline-success" @click="prev()" :disabled="isDisabled('prev')"><i class="fa-solid fa-backward-step"></i></button> -->
                                <button class="btn btn-outline-success" @click="prev15Sec()"><i class="fa-solid fa-backward"></i></button>
                                <button class="btn btn-outline-success" v-if="!playing" @click="play()"><i  class="fa-solid fa-play"></i></button>
                                <button class="btn btn-outline-success" v-else @click="pause()"><i class="fa-solid fa-pause"></i></button>
                                <button class="btn btn-outline-success" @click="next15Sec()"><i class="fa-solid fa-forward"></i></button>
                                <!-- <button class="btn btn-outline-success" @click="next()" :disabled="isDisabled('next')"><i class="fa-solid fa-forward-step"></i></button> -->
                            </div>
                            <div class="col-6 text-success d-flex justify-content-end ">
                                <div class="row align-items-center">
                                    <div class="col-2 d-flex align-items-center">
                                        <i class="fa-solid fa-volume-high" id="volume-icon" @click="muted()"></i>    
                                    </div>
                                    <div class="col-10 d-flex align-items-center">
                                        <input class="w-100" type="range" min="0" max="100" value="100" id="volume-input" @input="volume()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div >
                            <p>{{ currentSong.split('/')[1] }}</p>
                            <input class="w-100" type="range" min="0" max="100" value="0"  id="progress-input" >    
                            <p>{{ currentTime }} / {{ totalDuration }}</p>
                        </div>
                    </div>    
                    <div class="card-body">
                        <ul class="list-group w-100 p-2 pb-1 rounded-0 bg-gray border-0" style="overflow: auto; max-height: 300px;">
                            <li v-for="item, idx in file" class="list-group-item list-group-item-action bg-secondary p-1 mb-1 rounded text-light" @click="setSongAndPlay(idx)" :id="'_' + idx">{{item.split('/')[1]}}</li>
                            <li v-if="file.length <= 0" class="text-danger text-center">К сожилению файл не был найден</li>
                        </ul>
                    </div>
                    <audio id="player" preload="auto" src="" ></audio>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
const formatTime = second => new Date(second * 1000).toISOString().substr(11, 8);
export default {
    props: {
        file: {
            default: null
        }
    },
    data () {
        return {
            currentFile: '',
            currentSong: '',
            length: this.file.length,
            prevId: 0,
            currentId: 0,
            isMuted: false,
            volumeInput: undefined,
            progressInput: undefined,
            playing: false,
            percentage: 0,
            currentTime: '00:00:00',
            audio: undefined,
            totalDuration: 0,
            playerVolume: 0.5,
        }
    },
    created () {
        if (this.file.length > 0) {
            this.currentSong = this.file[this.currentId];
            this.currentFile = 'https://laravelmyaudiolib.s3.amazonaws.com/' + this.currentSong;
        }
    },
    mounted() {
        if(this.file.length > 0) {
            this.audio = document.getElementById('player');
            this.audio.src = this.currentFile;
            this.progressInput = document.getElementById('progress-input');
            this.volumeInput = document.getElementById('volume-input');
            document.getElementById('_' + this.currentId).classList.add('active');
            this.init();
        }
    },
    methods: {
        setSongAndPlay(id) {
            this.currentTime = 0;
            this.totalDuration = 0;
            this.currentId = id;
            this.currentSong = this.file[id];
            this.currentFile = 'https://laravelmyaudiolib.s3.amazonaws.com/' + this.currentSong;
            this.audio.src = this.currentFile;
            document.getElementById('_' + this.prevId).classList.remove('active');
            this.prevId = this.currentId;
            this.play();
        },
        play() {
            document.getElementById('_' + this.currentId).classList.add('active');
            this.audio.play().then(_ => {
                this.playing = true;
            });
        },
        pause() {
            this.audio.pause();
            this.playing = false;
        },
        next() {
            if (this.currentId < this.length - 1) {
                this.prevId = this.currentId;
                this.currentId += 1; 
                this.setSongAndPlay(this.currentId);
            }
        },
        prev() {
            if (this.currentId > 0) {
                this.prevId = this.currentId;
                this.currentId -= 1; 
                this.setSongAndPlay(this.currentId);
            }
        },
        next15Sec() {
            this.pause();
            this.audio.currentTime += 15;
            this.play();
        },
        prev15Sec() {
            this.pause();
            if (this.audio.currentTime >= 15) {
                this.audio.currentTime -= 15;
            } else {
                this.audio.currentTime = 0;
            }
            this.play();
        },
        setCurrentTime() {
            this.pause();
            this.audio.currentTime = this.progressInput.value;
            setTimeout(() => {this.play();}, 1000)           
        },
        _handleLoaded: function () {
            this.progressInput.max = this.audio.duration;
            this.totalDuration = formatTime(this.audio.duration)
        },
        _handlePlayingUI: function () {
            this.currentTime = formatTime(this.progressInput.value); 
            this.progressInput.value = this.audio.currentTime
        },
        isDisabled(btn) {
            switch (btn) {
                case 'prev':
                    if (this.currentId > 0) {
                        return false;
                    } else {
                        return true;
                    }
                case 'next':
                    if (this.currentId < this.length - 1) {
                        return false;
                    } else {
                        return true;
                    }
            }
        },
        volume(atr = '') {
           switch (atr) {
            case '':
                this.audio.volume = this.volumeInput.value * 0.01;
                break;
            case '0':
                this.audio.volume = 0;
                break;
            case '50':
                this.volumeInput.value = 50;
                this.audio.volume = this.volumeInput.value * 0.01;
                break;
           }
            if (this.audio.volume == 0) {
                document.getElementById('volume-icon').classList.replace('fa-volume-high', 'fa-volume-xmark');
                this.isMuted = true;
            } else {
                document.getElementById('volume-icon').classList.replace('fa-volume-xmark', 'fa-volume-high');
                this.isMuted = false;
            }
        },
        muted() {
            if (!this.isMuted) {
                this.volume('0');
            } else {
                if (this.volumeInput.value > 0) {
                    this.volume();
                } else {
                    this.volume('50');
                }
            }
        },
        init: function () {
            this.audio.addEventListener('timeupdate', this._handlePlayingUI);
            this.audio.addEventListener('loadeddata', this._handleLoaded);
            this.audio.addEventListener('ended', this.next);
            this.progressInput.addEventListener('click', this.setCurrentTime);
        },
    },
    beforeDestroy () {
        this.audio.removeEventListener('timeupdate', this._handlePlayingUI)
        this.audio.removeEventListener('loadeddata', this._handleLoaded)
        this.audio.removeEventListener('ended', this.next);
        this.progressInput.removeEventListener('change', this.setCurrentTime);
    }
}
</script>
<style>
    li {
        cursor: pointer;
    }
    #volume-input {
        cursor: pointer;
    }
</style>