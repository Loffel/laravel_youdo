<template>
    <ul v-if="notice">
        <li>
            <i class="icon-material-outline-info"></i>
            <span>Номер</span>
            <h5><a target="_blank" :href="notice.link">{{ notice.id }}</a></h5>
        </li>
        <li>
            <i class="icon-material-outline-local-atm"></i>
            <span>НМЦК</span>
            <h5>₽{{ notice.price }}</h5>
        </li>
        <li>
            <i class="icon-material-outline-business-center"></i>
            <span>Наименование объекта закупки</span>
            <h5>{{ notice.object }}</h5>
        </li>
        <li>
            <i class="icon-material-outline-note-add"></i>
            <span>Разместил</span>
            <h5>{{ notice.publishedBy }}</h5>
        </li>
        <li>
            <i class="icon-material-outline-access-time"></i>
            <span>Дата и время окончания подачи заявок</span>
            <h5>{{ notice.endDate }}</h5>
        </li>
        <li>
            <i class="icon-material-outline-gavel"></i>
            <span>Дата проведения аукциона</span>
            <h5>{{ notice.auctionDate }}</h5>
        </li>
    </ul>
    <ul v-else>
        Получаем данные...
    </ul>
    
</template>

<script>
export default {
    props: {
        notice_id: {
            type: String
        }
    },
    data(){
        return {
            notice: null
        };
    },
    mounted() {
        console.log(this.notice_id);
        this.getNoticeInfo(this.notice_id);
    },
    methods: {
        getNoticeInfo(id){
            axios.get('/tasks/notice/' + id)
                .then((response) => {
                    console.log(response.data);
                    this.notice = response.data;
                });
        }
    }
}
</script>