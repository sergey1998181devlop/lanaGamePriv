$(function () {
    $(document).on('click' , '.deleteDraftButton' , function () {
        var idDraft = $(this).data('iddraft');
        console.log(idDraft);
        $(document).find('input[name="idDraft"]').val(idDraft);
    })
    // $(document).on('click' , '.deleteDraftButtonModal' , function () {
    //     var idDraft = $(this).find('input[name="idDraft"]').val();
    //     $(document).find('form[data-idformdraft="'+idDraft+'"]').submit();
    // })
    $(document).on('click' , '.deleteDraftButtonModal' , function () {
        let idDraft = $(this).parent('.modal-footer').find('input[name="idDraft"]').val();

         table = $('#dataTable').DataTable();

        $.ajax({
            url: 'drafts/' + idDraft,
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                '_method': 'delete',
            },
            success: function (data) {
                // Success logic goes here..!

                $('#deleteDraft').modal('hide');
                let removeRow = $(document).find('td[val="'+idDraft+'"]').parent('tr');
                    // table.row( $(this) ).remove().draw();
                // var removingRow = $(this).closest('tr');
                table.row(removeRow).remove().draw();

            },
            error: function (error) {
                // Error logic goes here..!
            }
        });
    });
});
