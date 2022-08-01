<template>
    <div class="exitButton"><buttonVue :text="'Выйти'" :type="'logout'"/></div>
    <div class="table">
        <div class="table__menu">
            <buttonVue :text="'Создать папку'" :type="'create'"/>
            <buttonVue :text="'Загрузить файл'" :type="'upload'"/>
            <buttonVue :text="'Размер директории'" :type="'dirSize'"/>
        </div>
        <div class="table__items">
            <div class="table__item" 
                 v-for="object in objects">
                <div class="item__folder"
                     v-if= "object.type=='folder'">
                    <div class="item__name" style="margin-right: 10px"> {{object.name}}</div>
                    <buttonVue :text="'Переименовать'" :type="'rename'" :itemName="object.name"/>
                    <buttonVue :text="'Удалить'" :type="'delete'" :itemName="object.name"/>
                    <buttonVue :text="'Загрузить файл сюда'" :type="'folderUpload'" :itemName="object.name"/>
                    <buttonVue :text="'Размер'" :type="'folderSize'" :itemName="object.name"/>
                </div>
                <div class="item__file"
                     v-else>
                    <div class="item__name" style="margin-right: 10px">{{object.name}}</div>
                    <buttonVue :text="'Переименовать'" :type="'rename'" :itemName="object.name"/>
                    <buttonVue :text="'Удалить'" :type="'delete'" :itemName="object.name"/>
                    <buttonVue :text="'Скачать'" :type="'download'" :itemName="object.name"/>
                    <buttonVue :text="'Ссылка'" :type="'link'" :itemName="object.name"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DialogVue from '../components/dialog.vue';
    import ButtonVue from '../components/button.vue';
    import axios from 'axios';
    export default {
        components: {
            ButtonVue,
            DialogVue
        },
        data() {
            return {
                text: "Some Text",
                objects: [],
            }
        },
        mounted() {
            axios.get('/get-directory')
                    .then(res => {
                        this.objects = res.data;
                    });
        },
        methods: {
        }
    }
</script>

<style scoped>
    * {
        width: auto;
        height: auto;
    }
    .table {
        border: 2px solid #000;
        margin:15px;
    }
    .table__menu {
        display: flex;
        flex-direction: row;
        margin: 7px;
    }
    .table__item {
        border: 1px solid #000;
        padding:  3px;
    }
    .item__file, .item__folder {
        display: flex;
        flex-direction: row;
    }
    .exitButton {
        margin: 15px;
    }
</style>