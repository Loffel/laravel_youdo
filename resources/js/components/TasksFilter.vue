<script>
export default {
    mounted(){
        $("input#priceFilter").change(function(){
            var priceRange = $(this).val().split(","),
                minPrice = $("input[name='min_price']"),
                maxPrice = $("input[name='max_price']");

            minPrice.val(priceRange[0]);
            maxPrice.val(priceRange[1]);
        });
    },
    render(){

    }
}
</script>