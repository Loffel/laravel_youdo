<script>
export default {
    mounted(){
        $("a#openAccept").on('click', function(){
            var ID = $(this).data("id"),
                price = $(this).data("price"),
                actionLink = $(this).data("url"),
                userName = $(this).data("user-name");

            $("#small-dialog-1").find("h3#username").text("Принять предложение от " + userName);
            $("#small-dialog-1").find("#proposal_id").val(ID);
            $("#small-dialog-1").find("form#terms").attr('action', actionLink);
            $("#small-dialog-1").find("#price").html(price.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,') + ' руб.');
          });
          
          $("a#openDM").on('click', function(){
            var userID = $(this).data("user-id"),
                userName = $(this).data("user-name");

            $("#small-dialog-2").find("h3#username").text("Сообщение для " + userName);
            $("#small-dialog-2").find("input#contact_id").val(userID);
        });
    },
    render(){

    }
}
</script>