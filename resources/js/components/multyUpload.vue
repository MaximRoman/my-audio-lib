<template>
    <div id="template">
        <div :class="['card', totalProgress == 100 ?'rounded-0' : '', totalProgress == 100 ? 'rounded-top' : '', card]" id="card">
            <div class="card-header p-3">
                <h4 class="mb-2 text-success">Название : {{ obj.title }}</h4>      
                <div :class="['progress', 'position-relative', childs]" id="total-progress" style="height: 40px;">
                    <div class="progress-bar" role="progressbar" :style="{width: totalProgress + '%'}">
                    </div>
                    <span class="position-absolute h-100 start-50 d-flex align-items-center h6">{{ totalProgress }}%</span>
                </div>
            </div>
            <div class="card-body p-3">               
                <div class="progress position-relative bg-gray text-light" id="total-progress" style="height: 40px;">
                    <div class="progress-bar" role="progressbar" :style="{width: totalDurationProgress + '%'}">
                    </div>
                    <span class="position-absolute h-100 start-50 d-flex align-items-center h6">{{ totalDurationProgress }}%</span>
                </div>     
                <div class="row justify-content-evenly mt-3">
                    <div class="col-5 row justify-content-center">
                        <select :class="['form-control', childs]" id="text1" multiple style="overflow: auto;" disabled>
                            <option  v-for="file in filesOrder">
                                {{ file.name }}  
                            </option>
                        </select>
                    </div>
                    <div class="col-5 row justify-content-center">
                        <select :class="['form-control', childs]" id="text2" multiple style="overflow: auto;" disabled>
                            <option v-for="file in filesFinish">
                                {{ file.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-3 p-3">
                <div class="w-100">
                    <input :class="['form-control', 'm-0', childs, error !== '' ? 'is-invalid' : '']" id="inp" type="file" name="book" accept="audio/mpeg" multiple  :disabled="upload" @change="setListToUpload()">
                    <span class="invalid-feedback m-0" role="alert">
                        <strong>{{ error }}</strong>
                    </span>
                </div>                               
                <div class="">
                    <button class="btn btn-success" @click="fileInputChange()" :disabled="upload"><i class="fa-solid fa-cloud-arrow-up"></i></button>
                </div>
            </div>
        </div>
        <div v-if="totalProgress == 100" class="card rounded-0 rounded-bottom card bg-secondary">
            <div class="card-footer d-flex justify-content-center gap-3 p-3">
                <button class="col-7 btn btn-success" @click="goToEditBook()" :disabled="!completeLoad">Сохранить</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'card',
            'childs',
            'obj',
        ],
        data() {
            return {
                filesInput: undefined,
                filesOrder: [],
                filesFinish: [],
                totalProgress: 0,
                error: '',
                upload: false,
                totalSize: 0,
                loaded: 0,
                filesResult: [],
                files: [],
                loadedFiles: [],
                duration: null,
                completeLoad: false,
                totalDurationProgress: 0,
            }
        },
        mounted() {
            this.filesInput = document.getElementById('inp');
        },
        methods: {
            setListToUpload() {
                this.filesOrder = this.filesInput.files;
            },
            async fileInputChange() {
                if (this.filesInput.files.length > 0) {
                    this.error = '';
                    this.upload = true;
                    let files = Array.from(this.filesInput.files);
                    files.forEach(item => {
                        this.totalSize = this.totalSize + item.size;
                    });
                    this.filesOrder = files.slice();

                    await axios.post('/add-book/delete-directory', {'title': this.obj.title})
                    
                    for (let item of files) {
                        await this.uploadFile(item);
                    }
                    this.getFiles();
                } else {
                    this.error = "Вы не выбрали файлы для загрузки!"
                }                
            },
            async uploadFile(item) {
                let form = new FormData();
            
                form.append('book', item);
                form.append('title', this.obj.title);
                
                await axios.post('/add-book/create-url', form, {
                    onUploadProgress: (itemUpload) => {
                        this.totalProgress = (((this.loaded + itemUpload.loaded) / this.totalSize) * 100).toFixed(2);
                    }
                })
                .then(response => {
                    this.loaded = this.loaded + item.size;
                    this.filesFinish.unshift(item);
                    this.filesOrder.splice(item, 1);
                })
                .catch(error => {
                    console.log(error);
                })
            },
            getFiles() {
                axios.get('/get-files/' + this.obj.id).then((result) => {
                    console.log(result.data.result);
                    this.calcDuration(result.data.result);
                }).catch((err) => {
                    console.log(err);
                });
            },
            calcDuration(arr) {
                arr.forEach((item, index) => {
                    this.files.push({audio: new Audio('https://laravelmyaudiolib.s3.amazonaws.com/' + item)});
                    this.files[index].audio.addEventListener('loadedmetadata', () => {
                        this.loadedFiles.push(true);
                        this.duration = this.duration + this.files[index].audio.duration;  
                        this.totalDurationProgress = ((this.loadedFiles.length / this.files.length) * 100).toFixed(0);      
                        this.completedLoad()
                    });
                });
            },
            completedLoad() {    
                if (this.loadedFiles.length === this.files.length) {  
                    this.completeLoad = true;
                }
            },
            goToEditBook() {
                window.location = '/set-book-duration/' + this.obj.id + '/' + this.duration;
            },
        }
    }
</script>