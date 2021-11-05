$(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.star', function(e) {
        e.preventDefault();
        let route = $('#addStar').data('route');
        let starClass = $(this).attr("class").split(/\s+/)[1]
        let star = starClass.split(/-/)[1]
        $.ajax({
            url: route,
            type: 'POST',
            data: {'starId': star},
            dataType: 'json',
            success: function(data) {
                $('input.'+starClass).prop("checked", true);
            },
            error: function(data) {
                console.log('Error: ', data);
            }
        });
    });

});
