<template>
    <div class="message-reply">
        <textarea v-model="message" cols="1" v-on:keydown.enter="send" rows="1" placeholder="Введите сообщение..." data-autoresize></textarea>
        <button v-on:click="send" class="button ripple-effect">Отправить</button>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                message: ''
            };
        },
        methods: {
            send(e){
                e.preventDefault();
                if(this.message == '') return;
                
                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
</script>
