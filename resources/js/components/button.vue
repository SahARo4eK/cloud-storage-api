<template>    
    <div class="buttonVue"
         v-if="type=='download'">
        <a :href="downloadLink" download>{{text}}</a>
    </div>
    <div class="buttonVue"
         v-else-if="type=='dirSize'"
         @click="dirSize(); showDialog()">
        {{text}}
        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog">
            Общий размер файлов в диектории: {{ itemSize }} Б
        </dialogvue>
    </div>
    <div class="buttonVue"
         v-else-if="type=='folderSize'"
         @click="dirSize(this.itemName); showDialog()">
        {{text}}
        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog">
            Размер папки: {{ itemSize }} Б
        </dialogvue>
    </div>
    <div class="buttonVue"
         @click="showDialog"
         v-else>
        <!--При нажатии на кнопку "Создать папку"-->
        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog"
                   v-if="type=='create'">
            <input type="text" size="30" placeholder="Введите название папки">
            <button @click="create"> Создать </button>
        </dialogvue>
        
        <!--При нажатии на кнопку "Загрузить файл"-->
        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog"
                   v-if="type=='upload'">
            Выберите файл
            <input enctype="multipart/form-data" type="file" ref="file">
            <button @click="upload('')"> Загрузить </button>
        </dialogvue>
        
        <!--При нажатии на кнопку "Загрузить файл в папку"-->
        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog"
                   v-if="type=='folderUpload'">
            Выберите файл
            <input enctype="multipart/form-data" type="file" ref="file">
            <button @click="upload(this.itemName)"> Загрузить </button>
        </dialogvue>
        
        <!--При нажатии на кнопку "Удалить"-->
        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog"
                   v-if="type=='delete'">
            Вы действительно хотите удалить {{itemName}}?
            <button @click="deletee"> Удалить </button>
        </dialogvue>
        
        <!--При нажатии на кнопку "Переименовать"-->
        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog"
                   v-if="type=='rename'">
            <input type="text" size="30" placeholder="Введите новое имя">
            <button @click="rename"> Переименовать </button>
        </dialogvue>        

        <!--При нажатии на кнопку "Выйти"-->
        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog"
                   v-if="type=='logout'">
            Вы действительно хотите выйти из учетной записи?
            <button @click="logout"> Выйти </button>
        </dialogvue>

        {{text}}
    </div>
</template>

<script>
    import axios from 'axios';
    import DialogVue from '../components/dialog.vue';
    export default {
        components: {
            DialogVue
        },
        props: {
            text: {type: String},
            type: {type: String},
            itemName: {type: String},
            
        },
        data() {
            return {
                dialogVisible: false,
                downloadLink: "/users-files/user1/" + this.itemName,
                file: '',
                itemSize: 0
            }
        },
        methods: {
            create() {
                const inputText = document.getElementsByTagName("input")[0].value;
                axios.post('/create-folder', {
                    folderName: inputText
                })
                    .then(function () {
                        location.reload();
                    });
            },
            upload(folder) {
                if('undefined' === folder) folder = '';  
                this.file = this.$refs.file.files[0];
                if (this.validate(this.file)) {
                    let formData = new FormData();
                    formData.append('file', this.file);
                    formData.append('folder', folder);
                    axios.post('/upload-file',
                        formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                        .then(function () {
                            location.reload();
                        });
                }
            },
            deletee() {
                axios.post('/delete-item', {
                    itemName: this.itemName
                })
                    .then(function () {
                        location.reload();
                    });
            },
            rename() {
                const inputText = document.getElementsByTagName("input")[0].value;
                axios.post('/rename-item', {
                    itemName: this.itemName,
                    newName: inputText
                })
                    .then(function () {
                        location.reload();
                    });
            },
            dirSize(folder) {
                let params = '';
                if(!! folder) params = 'folder=' + folder;
                axios.get('/get-directory-size?' + params)
                    .then(res => {
                        this.itemSize = res.data;
                    });
            },
            logout() {
                axios.get('/logout', {
                })
                    .then(function () {
                        location.reload();
                    });
            },
            showDialog() {
                this.dialogVisible = true;
            },
            hideDialog() {
                this.dialogVisible = false;
            },
            validate(file) {
                if (file.size > 20480000) {
                    alert('Вес файла не должен превышать 20 МБ!');
                    return false;
                }
                if (file.name.match(/\.([^.]+)$|$/)[1] === 'php') {
                    alert('Расширение .php не разрешено для загрузки!');
                    return false;
                }
                return true;
            }
        }
    }
</script>

<style scoped>
    .buttonVue{
        border: 1px solid green;
        border-radius: 10px;
        background-color: lightgreen;
        max-width: 250px;
        padding-left: 3px;
        padding-right: 3px;
        margin-right: 10px;
    }
    .buttonVue:hover {
        border: 1px solid green;
        border-radius: 10px;
        background-color: lightgreen;
        max-width: 250px;
        padding-left: 3px;
        padding-right: 3px;
        margin-right: 10px;
        cursor: pointer;
    }
</style>