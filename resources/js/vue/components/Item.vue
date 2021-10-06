<template>
    <div class="item">
        <input
            type="checkbox"
            @change="updateCheck()"
            v-model="item.completed"
        />
        <span :class="[item.completed ? 'completed' : '', 'itemText']">
            {{ item.name }}
        </span>
        <button class="trashcan" @click="removeItem()">
            <font-awesome-icon icon="trash" />
        </button>
    </div>
</template>

<script>
export default {
    name: 'item',
    props: {
        item: {
            type: Object,
            default: {}
        }
    },
    methods: {
        updateCheck() {
            axios
                .put('api/items/' + this.item.id, {
                    item: this.item
                })
                .then(response => {
                    if (response.status === 200) {
                        this.$emit('itemChanged');
                    }
                })
                .catch(e => console.log(e));
        },
        removeItem() {
            axios
                .delete('api/items/' + this.item.id)
                .then(response => {
                    if (response.status === 200) {
                        this.$emit('itemChanged');
                    }
                })
                .catch(e => console.log(e));
        }
    }
};
</script>

<style scoped>
.completed {
    text-decoration: line-through;
    color: #999;
}
.itemText {
    width: 100%;
    margin-left: 20px;
}
.item {
    display: flex;
    justify-content: center;
    align-items: center;
}
.trashcan {
    background: #e6e6e6;
    border: none;
    color: #ff0000;
    outline: none;
}
</style>
