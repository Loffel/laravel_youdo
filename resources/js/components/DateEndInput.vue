<template>
    <div>
    <datetime format="yyyy-LL-dd HH:mm:00" auto input-id="date_end" input-class="mywith-border" :phrases="{ok: 'Выбрать', cancel: 'Закрыть'}" type="datetime" @input="changeInput(date_end)" v-model="date_end"></datetime>
    <input type="hidden" name="date_end" required>
    </div>

</template>

<script>
import { Datetime } from 'vue-datetime';
import { DateTime } from 'luxon';
import 'vue-datetime/dist/vue-datetime.css'
 
Vue.component('datetime', Datetime);
export default {
    props: {
        curdate: {
            type: String
        }
    },
    data(){
        return {
            'date_end': DateTime.fromSQL(this.curdate).toISO() 
        }
    },
    mounted(){
    },
    render(){
    },
    methods: {
        changeInput(value){
            if(value == '' || value == undefined) return;
            var dateTime = DateTime.fromISO(value).toFormat("yyyy-LL-dd HH:mm:00");
            $("input[name='date_end']").val(dateTime);
        }
    }
}
</script>