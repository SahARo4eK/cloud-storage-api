<template>
    hi
    <div class='table'>
        <div v-for="object in objects">
            {{object.name}} {{object.route}}
        </div>
    </div>
</template>

<script>
    import Test2 from '../components/test2.vue';
    export default {
    components: {
        Test2
    },
    data() {
        return {
            objects: [
                {name: 'папка'},
                {name: 'файл1'},
                {name: 'файл2'}
            ]
        }
    }
}
</script>

