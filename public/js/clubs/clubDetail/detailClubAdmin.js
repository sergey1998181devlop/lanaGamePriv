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
    $('#select_new_user').autocomplete({
        serviceUrl: '{{url("/panel/find-user")}}',
        dataType: 'json',

        onSelect: function (suggestion) {
            $('#new_user_id').val(suggestion.data);
        },
    });
});
