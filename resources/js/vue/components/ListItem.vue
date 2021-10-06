<template>
    <div>
        <div v-for="(item, index) in items" :key="index">
            <item :item="item" class="item" v-on:itemChanged="$emit('reloadList')"/>
        </div>
    </div>
</template>

<script>
import Item from "./Item.vue";

export default {
    name: 'list-item',
    props: {
        items: {
            type: Array,
            default: []
        },
    },
    components: {
        Item
    },
};
</script>

<style scoped>
.item{
    background: #e6e6e6;
    padding: 5px;
    margin-top: 5px;
}
</style>
