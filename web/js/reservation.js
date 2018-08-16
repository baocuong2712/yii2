$(function() {
    "use strict";
    $('#reservation-room_id').change(function(ev) {
        var roomId = $(this).val();
        $.get(
            // '{$urlPricePerDatByRoom}', { 'room_id' : roomId },
            'get-price-per-day', { 'room_id' : roomId }, function(data) {
                $('#reservation-price_per_day').val(data);
            }
        );

        $.ajax({
            type: 'GET',
            url: 'get-block-by-room',
            data: { room_id : roomId },
            dataType: 'json',
            cache: false,
            success: function(data) {
                $('#reservation-block').html('<option value="'+ data[1] +'">' + data[0] + '</option>');
                $('#reservation-block').trigger("change");
            }
        });

        ev.preventDefault();
    });

    $('#reservation-block').change(function(ev) {
        var blockId = $(this).val();
        $.ajax({
            type: 'GET',
            url: 'get-hotel-by-block',
            data: { block_id : blockId },
            cache: false,
            success: function(data) {
                $('#reservation-hotel').val(data);
            }
        });
    });

    $('#reservation-date_from').change(function(ev){
        $('#reservation-date_to').removeAttr('disabled');
    });
});