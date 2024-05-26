$(document).ready(function(){

    //plus button click
    $('.btn-plus').click(function(){
        $parentNode = $(this).parents('tr');
        $price =Number( $parentNode.find('#price').text().replace('kyats',''));
        $quantity = Number($parentNode.find('#quantity').val());

        $total = $price * $quantity;
        $parentNode.find('#total').html(`${$total} kyats`);

        summaryCalculation();
    });


    //minus button click
    $('.btn-minus').click(function(){

        $parentNode = $(this).parents('tr');
        $price =Number( $parentNode.find('#price').text().replace('kyats',''));
        $quantity = Number($parentNode.find('#quantity').val());

        $total = $price * $quantity;
        $parentNode.find('#total').html(`${$total} kyats`);

        summaryCalculation();

    });

   


    function summaryCalculation(){
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index,row){
            $totalPrice += Number($(row).find('#total').text().replace('kyats',''));
        })

        $('#totalPrice').html(`${$totalPrice} kyats`);

        $finalPrice = $totalPrice +3000;
        $('#finalPrice').html(`${$finalPrice} kyats`);

    }
})
