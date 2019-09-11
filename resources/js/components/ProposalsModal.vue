<script>
export default {
    mounted(){
        $("a#proposalEdit").on('click', function(){
        var ID = $(this).data("id");
        var maxPrice = $(this).data("price");
        var curPrice = $(this).data("current-price");
        var desc = $(this).data("desc");

        $("#small-dialog").find("#proposal_id").val(ID);
        // $("#small-dialog").find(".bidding-slider").data('slider-max', maxPrice);
        // $("#small-dialog").find(".bidding-slider").val(curPrice);
        $("#small-dialog").find("#description").val(desc);
        });
    },
    render(){

    }
}
</script>