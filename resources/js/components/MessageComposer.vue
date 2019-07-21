<template>
    <textarea class="form-control col-12" v-model="message" @keydown.enter="send" placeholder="Введите сообщение..."></textarea>
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
