$(function () {
    $('.comment button[data-role-remove-comment]').click(function () {
        var id = $(this).attr('data-id'),
            comment = $(this).closest('.comment');
        comment.css('background', '#cccccc');
        $.ajax({
            url: "{{url('club').'/'.$club->id.'/remove_comment'}}",
            type: 'post',
            data: {
                'id': id,
                '_token': $('[name="_token"]').val(),
            },
            success: function (data) {
                comment.remove();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                comment.css('background', '');
            },
        });
    });
    $(document).on('click' , '.club_calling' , function (e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '/clubs/saveCountBooking',
            data: ({
                'club_id' : $(document).find('input[name="club_id"]').val()
            }),
            success: function (data) {
                console.log('Успешное увеличение брони');
            },
            error: function () {
                console.log('Ошибка увеличения брони');
            }
        });
    });
});
