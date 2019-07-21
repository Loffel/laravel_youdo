<template>
    <div class="row">
        <div class="col-12" style="width: 100%">
            <h4> {{contact ? 'Беседа с ' + contact.name : ''}} </h4>
            <MessagesHistory :contact="contact" :messages="messages"/>
            <MessageComposer @send="sendMessage"/>
        </div>
    </div>
</template>

<script>
    import MessagesHistory from './MessagesHistory';
    import MessageComposer from './MessageComposer';

    export default {
        props: {
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            }
        },
        methods: {
            sendMessage(text){
                if(!this.contact) return;

                axios.post('/messenger/conversation/send', {
                    contact_id: this.contact.id,
                    text: text
                }).then((response) => {
                    this.$emit('new', response.data);
                });
            }
        },
        components:{
            MessagesHistory,
            MessageComposer
        }
        
    }
</script>

