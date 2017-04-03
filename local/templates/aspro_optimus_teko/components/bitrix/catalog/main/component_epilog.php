<script>
$('.teko_available_block label').on('click', function(){
    $.ajax({
        url: '/ajax/catalog_available_product.php',
        success: function(e){ 
            window.location.reload();                                                                       
        }
    });        
});
</script>