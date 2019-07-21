<template>
    <div class="row">
        <div class="col-12">
            <li v-for="(contact, index) in contacts" :key="contact.id" @click="selectContact(index, contact)" :class="{'selected': index == selected}" style="border-bottom: 1px solid #000000; cursor: pointer;">
                {{contact.name}}
                <br>
                {{contact.email}}
            </li>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        contacts: {
            type: Array,
            default: []
        }
    },
    data() {
        return {
            selected: 0
        };
    },
    methods: {
        selectContact(index, contact){
            this.selected = index;
            this.$emit('selected', contact);
        }
    }
}
</script>

<style lang="scss" scoped>
    .selected {
        background: #dfdfdf;
    }
</style>
