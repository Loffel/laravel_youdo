<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Сообщения</div>

                    <div class="card-body row">
                        <div class="col-8">
                            <Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>
                        </div>
                        <div class="col-4" style="border-left: 1px solid #d8d8d8;">
                            <ContactList :contacts="contacts" @selected="startConversationWith"/>
                        </div>
                    </div>                   
                </div>
            </div>
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
