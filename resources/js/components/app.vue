<template>
    <div class="table">
        <div class="table__menu">
            <buttonVue :buttonText="'Создать папку'"/>
            <buttonVue :buttonText="'Загрузить файл'"/>
        </div>
        <div class="table__items">
            <div class="table__item" 
                v-for="object in objects">
                <div class="item__folder"
                    v-if= "object.type=='folder'">
                    <div style="margin-right: 10px"> {{object.name}}</div>
                    <buttonVue :buttonText="'Переименовать'"/>
                    <buttonVue :buttonText="'Удалить'"/>
                </div>
                <div class="item__file"
                     v-else>
                    <div style="margin-right: 10px">{{object.name}}</div>
                    <buttonVue :buttonText="'Переименовать'"/>
                    <buttonVue :buttonText="'Удалить'"/>
                    <buttonVue :buttonText="'Скачать'"/>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    import ButtonVue from '../components/button.vue';
    import axios from 'axios';
    export default {
    components: {
        ButtonVue
    },
    data() {
        return {
            text: "Some Text",
            objects: []
        }
    },
    mounted() {
        axios.get('/get-directory') 
        .then(res => {
            this.objects = res.data;
        });
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
</style>