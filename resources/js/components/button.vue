<template>
    <div class="buttonVue"
         @click="upload">
        {{buttonText}}
    </div>
</template>

<script>
    import axios from 'axios';
export default {
    props: {
        buttonText: {type: String}
    },
    methods: {
        upload(){
            //axios.get('/test');
        }
    }
}
</script>

<style scoped>
    * {
        border: 1px solid green;
        border-radius: 10px;
        background-color: lightgreen;
        max-width: 200px;
        padding-left: 3px;
        padding-right: 3px; 
        margin-right: 10px;
    }
    .buttonVue:hover {
        cursor: pointer;
    }
</style>