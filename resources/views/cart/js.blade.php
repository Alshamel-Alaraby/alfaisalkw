<script>

    $(document).on("click", ".addItemToCart", function (e) {
        e.preventDefault();
        var qty = 1;
        if($("#requiredQty").length){
            qty = $("#requiredQty").val();
        }
        AddToCart($(this).attr("rel"),qty);
    });
    $(document).on("change", ".itemQty", function (e) {
        updateCart($(this).closest(".produtItem").find('.ItemID').val(),$(this).val());
    });
    function AddToCart(productId,Qty){
        $.ajax({
            url:"{{route('frontend.cart.add')}}",
            type:'POST',
            data:{
                productId:productId,
                Qty:Qty,
                _token:"{{csrf_token()}}"
            },
            success:function(result){
                var result = JSON.parse(result);
                toastr.success(result.msg);
                if($(".TQ").length) {
                    $(".TQ").html(result.totalQty);
                }
                if($(".CARTTOTAL").length) {
                    $(".CARTTOTAL").html(result.total);
                }
            }
        });
    }
    function updateCart(productId,Qty){
        $.ajax({
            url:"{{route('frontend.cart.update')}}",
            type:'POST',
            data:{
                productId:productId,
                Qty:Qty,
                _token:"{{csrf_token()}}"
            },
            success:function(result){
                var result = JSON.parse(result);
                toastr.success(result.msg);
                if($(".TQ").length) {
                    $(".TQ").html(result.totalQty);
                }
                if($(".CARTTOTAL").length) {
                    $(".CARTTOTAL").html(result.total);
                }
            }
        });
    }
    function removeItemCart(productId){
        $.ajax({
            url:"{{route('frontend.cart.remove')}}",
            type:'POST',
            data:{
                productId:productId,
                _token:"{{csrf_token()}}"
            },
            success:function(result){
                var result = JSON.parse(result);
                toastr.error(result.msg);
                if($(".TQ").length) {
                    $(".TQ").html(result.totalQty);
                }
                if($(".CARTTOTAL").length) {
                    $(".CARTTOTAL").html(result.total);
                }
            }
        });
    }
</script>
