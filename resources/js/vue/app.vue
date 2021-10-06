<template>
    <div>
        <div class="todoListContainer">
            <div class="heading">
                <h2 id="title">Todo List</h2>
                <add-item-form v-on:reloadList="getListItem()" />
            </div>
            <list-item :items="items" v-on:reloadList="getListItem()"/>
        </div>
    </div>
</template>

<script>
import AddItemForm from './components/AddItemForm.vue';
import ListItem from './components/ListItem.vue';

export default {
    name: 'app',
    data() {
        return {
            items: []
        }
    },
    methods: {
        getListItem() {
            axios.get('api/items')
            .then(response => {
                this.items = response.data.items;
            })
            .catch(e => console.log(e));
        }
    },
    created() {
        this.getListItem();
    },
    components: {
        AddItemForm,
        ListItem
    },
};
</script>

<style scoped>
.todoListContainer {
    width: 350px;
    margin: auto;
}
.heading {
    background: #e6e6e6;
    padding: 10px;
}
#title {
    text-align: center;
}
</style>
