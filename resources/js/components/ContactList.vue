<template>
    <div class="messages-inbox">
        <div class="messages-headline">
            <div class="input-with-icon">
                    <input id="autocomplete-input" type="text" placeholder="Search">
                <i class="icon-material-outline-search"></i>
            </div>
        </div>
        <ul>
            <li v-for="(contact, index) in contacts" :key="contact.id" @click="selectContact(index, contact)" :class="{'active-message': index == selected}">
                <a href="#">
                    <div class="message-avatar"><i class="status-icon status-online"></i><img src="/images/user-avatar-placeholder.png" alt="" /></div>

                    <div class="message-by">
                        <div class="message-by-headline">
                            <h5>{{ contact.name }}</h5>
                            <span>@ дней назад</span>
                        </div>
                        <p>Последнее сообщение!</p>
                    </div>
                </a>
            </li>

        </ul>
    </div>
    <!-- Messages / End -->
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
            selected: -1
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
