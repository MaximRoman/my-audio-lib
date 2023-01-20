<template>
    <div id="template">
        <div class="card" id="card">
            <div class="card-header">
                <h4 class="mb-2 text-success">Название : {{ obj.title }}</h4>
                <div class="progress position-relative" id="progress" style="height: 40px;">
                    <div class="progress-bar" role="progressbar" :style="{width: fileProgress + '%'}">
                    </div>
                    <span class="position-absolute h-100 start-50 d-flex align-items-center h6">{{ fileProgress }}%</span>
                </div>
            </div>
            <div class="card-body">                  
                <div class="progress position-relative" id="total-progress" style="height: 40px;">
                    <div class="progress-bar" role="progressbar" :style="{width: totalProgress + '%'}">
                    </div>
                    <span class="position-absolute h-100 start-50 d-flex align-items-center h6">{{ totalProgress }}%</span>
                </div>
                <div class="row justify-content-evenly mt-3">
                    <div class="col-5 row justify-content-center">
                        <select class="form-control" id="text1" multiple style="overflow: auto;" disabled>
                            <option  v-for="file in filesOrder">
                                {{ file.name }}  
                            </option>
                        </select>
                    </div>
                    <div class="col-5 row justify-content-center">
                        <select class="form-control" id="text2" multiple style="overflow: auto;" disabled>
                            <option v-for="file in filesFinish">
                                {{ file.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex gap-3">
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
            <a id="home" href="/"></a>
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
                fileProgress: 0,
                totalProgress: 0,
                fileCurrent: '',
                error: '',
                upload: false,
                totalSize: 0,
                loaded: 0,
            }
        },
        mounted() {
            this.filesInput = document.getElementById('inp');
            document.getElementById('card').classList.value = document.getElementById('card').classList.value + ' ' + this.card;
            document.getElementById('progress').classList.value = document.getElementById('progress').classList.value + ' ' + this.childs;
            document.getElementById('total-progress').classList.value = document.getElementById('total-progress').classList.value + ' ' + this.childs;
            document.getElementById('text1').classList.value = document.getElementById('text1').classList.value + ' ' + this.childs;
            document.getElementById('text2').classList.value = document.getElementById('text2').classList.value + ' ' + this.childs;
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
                    setTimeout(() => { window.location = '/book/' + this.obj.id; }, 3000);
                } else {
                    this.error = "Вы не выбрали файлы для загрузки!"
                }                
            },
            async uploadFile(item) {
                let form = new FormData();
            
                form.append('book', item);
                form.append('title', this.obj.title);
                this.fileProgress = 0;
                await axios.post('/add-book/create-url', form, {
                    onUploadProgress: (itemUpload) => {
                        this.fileProgress = ((itemUpload.loaded / itemUpload.total) * 100).toFixed(2);
                        this.totalProgress = (((this.loaded + itemUpload.loaded) / this.totalSize) * 100).toFixed(2) ;
                        console.log(this.loaded + itemUpload.loaded);
                        this.fileCurrent = item.name + ' ' + this.fileProgress;
                    }
                })
                .then(response => {
                    console.log(item);
                    this.fileCurrent = '';
                    this.loaded = this.loaded + item.size;
                    this.filesFinish.unshift(item);
                    this.filesOrder.splice(item, 1);
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>