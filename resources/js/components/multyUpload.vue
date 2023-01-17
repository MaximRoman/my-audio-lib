<template>
    <div id="template">
        <div class="card" id="card">
            <div class="card-header">
                <h4 class="mb-2 text-success">Название : {{ obj.title }}</h4>
                <div class="progress" id="progress" style="height: 40px;">
                    <div class="progress-bar" role="progressbar" :style="{width: fileProgress + '%'}">
                        {{ fileProgress }}%
                    </div>
                </div>
            </div>
            <div class="card-body">               
                <div class="progress" id="total-progress" style="height: 40px;">
                    <div class="progress-bar" role="progressbar" :style="{width: totalProgress + '%'}">
                        {{ totalProgress }}%
                    </div>
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
                <input class="form-control" id="inp" type="file" name="book" accept="audio/mpeg" multiple @change="fileInputChange()">
                <button class="btn btn-success" @click=""><i class="fa-solid fa-cloud-arrow-up"></i></button>
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
                filesOrder: [],
                filesFinish: [],
                fileProgress: 0,
                totalProgress: 0,
                fileCurrent: '',
            }
        },
        mounted() {
            document.getElementById('card').classList.value = document.getElementById('card').classList.value + ' ' + this.card;
            document.getElementById('progress').classList.value = document.getElementById('progress').classList.value + ' ' + this.childs;
            document.getElementById('total-progress').classList.value = document.getElementById('total-progress').classList.value + ' ' + this.childs;
            document.getElementById('text1').classList.value = document.getElementById('text1').classList.value + ' ' + this.childs;
            document.getElementById('text2').classList.value = document.getElementById('text2').classList.value + ' ' + this.childs;
            document.getElementById('inp').classList.value = document.getElementById('inp').classList.value + ' ' + this.childs;
        },
        methods: {
            async fileInputChange() {
                let files = Array.from(event.target.files);
            
                this.filesOrder = files.slice();

                await axios.post('/add-book/delete-directory', {'title': this.obj.title})
                
                for (let item of files) {
                    await this.uploadFile(item);
                    await this.calcTotalProgress();
                }
            },
            calcTotalProgress() {
                this.totalProgress = Math.round((this.filesFinish.length * 100) / (this.filesFinish.length + this.filesOrder.length));
                if (this.totalProgress < 100) {
                    this.fileProgress = 0;
                } else {
                    window.location = '/book/' + this.obj.id;
                }
            },
            async uploadFile(item) {
                let form = new FormData();
            
                form.append('book', item);
                form.append('title', this.obj.title);
                await axios.post('/add-book/create-url', form, {
                    onUploadProgress: (itemUpload) => {
                        this.fileProgress = Math.round((itemUpload.loaded / itemUpload.total) * 100);
                        this.fileCurrent = item.name + ' ' + this.fileProgress;
                    }
                })
                .then(response => {
                    this.fileCurrent = '';
                    this.filesFinish.push(item);
                    this.filesOrder.splice(item, 1);
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>