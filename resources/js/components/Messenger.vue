<template>
    <div class="messages-container margin-top-0">
        <div class="messages-container-inner">
            <ContactList :contacts="contacts" @selected="startConversationWith"/>
            <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
        </div>
    </div>
</template>

<script>
    import Conversation from './Conversation';
    import ContactList from './ContactList';

    export default {
        data(){
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        mounted() {
            axios.get('/messenger/contacts')
                .then((response) => {
                    console.log(response.data);
                    this.contacts = response.data;
                });
        },
        methods: {
            startConversationWith(contact){
                axios.get(`/messenger/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    });
            },
            saveNewMessage(message){
                this.messages.push(message);
            }
        },
        components: {
            Conversation,
            ContactList
        }
    }
</script>
