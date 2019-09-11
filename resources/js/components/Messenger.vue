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
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data(){
            return {
                selectedContact: null,
                messages: [],
                contacts: []
            };
        },
        mounted() {
            Echo.private(`messages.${this.user.id}`)
                .listen('NewMessage', (e) => {
                    this.handleIncoming(e.message);
                });
            
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
            },
            handleIncoming(message){
                if(this.selectedContact && message.from_id == this.selectedContact.id){
                    this.saveNewMessage(message);
                    return;
                }

                alert(message.text);
            }
        },
        components: {
            Conversation,
            ContactList
        }
    }
</script>
