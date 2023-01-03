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
                <div class="row justify-content-evenly">
                    <div class="col-5 row justify-content-center">
                        <h3 class="text-center">Files to upload {{ filesOrder.length }}</h3>
                        <select class="form-control" id="text1" multiple style="overflow: auto;" disabled>
                            <option  v-for="file in filesOrder">
                                {{ file.name }}  
                            </option>
                        </select>
                    </div>
                    <div class="col-5 row justify-content-center">
                        <h3 class="text-center">Files uploaded   {{ filesFinish.length }}</h3>
                        <select class="form-control" id="text2" multiple style="overflow: auto;" disabled>
                            <option v-for="file in filesFinish">
                                {{ file.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input class="form-control" id="inp" type="file" name="book" accept="audio/mpeg" multiple @change="fileInputChange()">
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
                fileCurrent: '',
            }
        },
        mounted() {
            console.log(this.obj);
            document.getElementById('card').classList.value = document.getElementById('card').classList.value + ' ' + this.card;
            document.getElementById('progress').classList.value = document.getElementById('progress').classList.value + ' ' + this.childs;
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
                }
                window.location = '/book/' + this.obj.id;
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
                    this.fileProgress = 0;
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