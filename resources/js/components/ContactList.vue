<template>
    <div class="messages-inbox">
        <div class="messages-headline">
            <div class="input-with-icon">
                    <input id="autocomplete-input" type="text" placeholder="Поиск">
                <i class="icon-material-outline-search"></i>
            </div>
        </div>
        <ul>
            <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{'active-message': contact == selected, 'unread': contact.unread}">
                <a href="#">
                    <div class="message-avatar"><i class="status-icon status-online"></i><img :src="contact.avatar" alt="" /></div>

                    <div class="message-by">
                        <div class="message-by-headline">
                            <h5>{{ contact.name }}</h5>
                            <span>{{ contact.lastMessage ? contact.lastMessage.diffForHumans : ''  }}</span>
                        </div>
                        <p v-if="contact.lastMessage">{{contact.lastMessage.from_id == contact.id ? contact.name + ': ' + contact.lastMessage.text : 'Вы: ' + contact.lastMessage.text}}</p>
                        <p v-else>Сообщений пока нет!</p>
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
            selected: this.contacts.length ? this.contacts[0] : null
        };
    },
    methods: {
        selectContact(contact){
            this.selected = contact;
            this.$emit('selected', contact);
        }
    },
    computed: {
        sortedContacts(){
            return _.sortBy(this.contacts, [(contact) => {
                // if(contact == this.selected) {
                //     return Infinity;
                // }

                return contact.unread;
            }]).reverse();
        }
    }
}
</script>

<style lang="scss" scoped>
    .selected {
        background: #dfdfdf;
    }

    li.unread {
	    background-color: #2a41e81f;
    }
</style>
