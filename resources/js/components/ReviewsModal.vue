<script>

export default {
    mounted() {
        $("a#reviewOpen").on('click', function(){
            var taskElem = $(this).parent().find(".item-content h4");
            var taskLink = taskElem.data("user-url");
            var taskTitle = taskElem.html();
            var userLink = taskElem.data("user-url");
            var userName = taskElem.data("user-name");
            var taskID = taskElem.data("task-id");

            $("a#reviewName").attr("href", userLink);
            $("a#reviewName").html(userName);
            $("a#reviewTask").attr("href", taskLink);
            $("a#reviewTask").html(taskTitle);
            $("input#task_id").val(taskID);
        });

        $("a#reviewOpen.gray").on('click', function(){
            var ratingElem = $(this).parent().find(".star-rating");
            var courtesy = ratingElem.data("courtesy");
            var ID = ratingElem.data("id");
            var punctuality = ratingElem.data("punctuality");
            var adequacy = ratingElem.data("adequacy");
            var comment = $(this).parent().find(".item-description > p").text();

            $("#small-dialog-1").find("input#courtesy-radio-" + courtesy).prop('checked', true);
            $("#small-dialog-1").find("input#punctuality-radio-" + punctuality).prop('checked', true);
            $("#small-dialog-1").find("input#adequacy-radio-" + adequacy).prop('checked', true);
            $("#small-dialog-1").find("#comment").val(comment);
            $("#small-dialog-1").find("#review_id").val(ID);
        });
    },
    render(){

    }
}
</script>