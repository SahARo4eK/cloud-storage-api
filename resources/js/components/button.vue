<template>
    <div class="buttonVue"
        v-if="type=='download'">
        <a :href="downloadLink" download>{{text}}</a>
    </div>
    <div class="buttonVue"
         @click="showDialog"
         v-else>

        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog"
                   v-if="type=='create'">
            <input type="text" size="30" placeholder="Введите название папки">
            <button @click="create"> Создать </button>
        </dialogvue>

        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog"
                   v-if="type=='upload'">
            Выберите файл
            <input type="file">
            <button @click="upload"> Загрузить </button>
        </dialogvue>

        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog"
                   v-if="type=='delete'">
            Вы действительно хотите удалить {{itemName}}?
            <button @click="deletee"> Удалить </button>
        </dialogvue>
        
        <dialogVue v-model:show="dialogVisible" 
                   @hideDialog="hideDialog"
                   v-if="type=='rename'">
            <input type="text" size="30" placeholder="Введите новое имя">
            <button @click="rename"> Переименовать </button>
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
            itemName: {type: String}
        },
        data() {
            return {
                dialogVisible: false,
                downloadLink: "/users-files/user1/" + this.itemName
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
            upload() {
                const inputFile = document.getElementsByTagName("input")[0].value;
                axios.post('/upload-file', {
                    file: inputFile
                })
                        .then(function () {
                            location.reload();
                        });
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
            showDialog() {
                this.dialogVisible = true;
            },
            hideDialog() {
                this.dialogVisible = false;
            }
        }
    }
</script>

<style scoped>
    .buttonVue{
        border: 1px solid green;
        border-radius: 10px;
        background-color: lightgreen;
        max-width: 200px;
        padding-left: 3px;
        padding-right: 3px;
        margin-right: 10px;
    }
    .buttonVue:hover {
        border: 1px solid green;
        border-radius: 10px;
        background-color: lightgreen;
        max-width: 200px;
        padding-left: 3px;
        padding-right: 3px;
        margin-right: 10px;
        cursor: pointer;
    }
</style>