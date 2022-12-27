<template>
    <div id="template">
        <div class="card bg-gray">
            <div class="card-header">
                <div class="progress bg-secondary" style="height: 40px;">
                    <div class="progress-bar" role="progressbar" :style="{width: fileProgress + '%'}">
                        {{ fileProgress }}%
                    </div>
                </div>
            </div>
            <div class="card-body">               
                <div class="row justify-content-evenly">
                    <div class="col-5 row justify-content-center">
                        <h3 class="text-center">Files to upload {{ filesOrder.length }}</h3>
                        <select class="form-control bg-secondary" multiple style="overflow: auto;" disabled>
                            <option  v-for="file in filesOrder">
                                {{ file.name }}  
                            </option>
                        </select>
                    </div>
                    <div class="col-5 row justify-content-center">
                        <h3 class="text-center">Files uploaded   {{ filesFinish.length }}</h3>
                        <select class="form-control bg-secondary" multiple style="overflow: auto;" disabled>
                            <option v-for="file in filesFinish">
                                {{ file.name }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input class="form-control bg-secondary text-light" type="file" name="book" accept="audio/mpeg" multiple @change="fileInputChange()">
            </div>
            <a id="home" href="/"></a>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        data() {
            return {
                filesOrder: [],
                filesFinish: [],
                fileProgress: 0,
                fileCurrent: '',
            }
        },
        methods: {
            async fileInputChange() {
                let files = Array.from(event.target.files);
            
                this.filesOrder = files.slice();
            
                for (let item of files) {
                    await this.uploadFile(item);
                }
               // window.location = '/add-book/complete';
            },
        
            async uploadFile(item) {
                let form = new FormData();
            
                form.append('book', item);
                
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