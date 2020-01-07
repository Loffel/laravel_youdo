<template>
    <div class="messages-container margin-top-0">
        <div class="messages-container-inner">
            <ContactList :contacts="contacts" @selected="startConversationWith"/>
            <Conversation :avatar="avatar" :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
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
            },
            avatar: {
                type: String
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
                this.updateUnread(contact, true);

                axios.get(`/messenger/conversation/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data;
                        this.selectedContact = contact;
                    });
            },
            saveNewMessage(message){
                this.messages.push(message);
                this.selectedContact.lastMessage = message;
            },
            handleIncoming(message){
                if(this.selectedContact && message.from_id == this.selectedContact.id){
                    this.saveNewMessage(message);
                    return;
                }

                this.updateUnread(message.from, false);
                this.updateLastMessage(message);
            },
            updateUnread(contact, reset){
                this.contacts = this.contacts.map((single) => {
                    if(single.id != contact.id)
                        return single;

                    if(reset)
                        single.unread = 0;
                    else single.unread += 1;



                    return single;
                });
            },
            updateLastMessage(message){
                this.contacts = this.contacts.map((single) => {
                    if(single.id != message.from.id)
                        return single;

                    single.lastMessage = message;

                    return single;
                });
            }
        },
        components: {
            Conversation,
            ContactList
        }
    }
</script>
