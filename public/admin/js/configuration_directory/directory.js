$(document).ready(function () {
    $('#dataTableN').dataTable({
        "ordering": false,
        "language": {
            "processing": "Подождите...",
            "search": "Поиск:",
            "lengthMenu": "Показать _MENU_ записей",
            "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
            "infoEmpty": "Записи с 0 до 0 из 0 записей",
            "infoFiltered": "(отфильтровано из _MAX_ записей)",
            "infoPostFix": "",
            "loadingRecords": "Загрузка записей...",
            "zeroRecords": "Записи отсутствуют.",
            "emptyTable": "В таблице отсутствуют данные",
            "paginate": {
                "first": "Первая",
                "previous": "Предыдущая",
                "next": "Следующая",
                "last": "Последняя"
            },
            "aria": {
                "sortAscending": ": активировать для сортировки столбца по возрастанию",
                "sortDescending": ": активировать для сортировки столбца по убыванию"
            }
        }
    });
        $('.add-new-data').click(function () {
        let typeFiledForAdd = $(this).parent('td').attr('data-type');
        let nameTypeDevice = $(document).find('.nav-tabs  ').find('.active').attr('data-typeDevice');
        let idTypeDevice = $(document).find('.nav-tabs  ').find('.active').parent('li').attr('data-deviceid');

        let indexTdForSearchName = $(this).parents('.tdWithDopData').index();//имя колонки первой для модели заголовка
        let nameFirstColumn = $(this).parents('table').find('.trNameColums th').eq(indexTdForSearchName).children('.typeColumn').text();
            $(document).find('.addItems').find('input[name="firmId"]').val('');
            $(document).find('.addItems').find('input[name="new_val"]').val('');
            $(document).find('.addItems').find('input[name="idTypeDevice"]').val('');
        if(typeFiledForAdd === 'models'){

            let firmId = $(this).parents('.tdWithDopData').prev('td').attr('data-idfirm');

            $(document).find('input[name="firmId"]').val(firmId);

        }
        $(document).find('.addItems').find('.typeNewVal').text('').text(nameFirstColumn);
        $(document).find('.addItems').find('input[name="typeNewValue"]').val(typeFiledForAdd);
        $(document).find('.addItems').find('input[name="typeDevice"]').val(nameTypeDevice);
        $(document).find('.addItems').find('input[name="idTypeDevice"]').val(idTypeDevice);


    })
    $('.first-column-btn').click(function () {
        let typeFiledForAdd = $(this).parents('.table').find('input[name="type-first-column"]').val();
        let nameFirstColumn = $(this).prev('.typeColumn').text();//имя колонки первой для модели заголовка
        let nameTypeDevice = $(document).find('.nav-tabs  ').find('.active').attr('data-typeDevice');
        let idTypeDevice = $(document).find('.nav-tabs  ').find('.active').parent('li').attr('data-deviceid');
        $(document).find('.addItems').find('input[name="idTypeDevice"]').val('');
        $(document).find('.addItems').find('input[name="new_val"]').val('');
        $(document).find('.addItems').find('.typeNewVal').text('').text(nameFirstColumn);
        $(document).find('.addItems').find('input[name="typeNewValue"]').val(typeFiledForAdd);
        $(document).find('.addItems').find('input[name="typeDevice"]').val(nameTypeDevice);
        $(document).find('.addItems').find('input[name="idTypeDevice"]').val(idTypeDevice);
    })
    $('.deleteDraftButtonModal').click(function () {
        var dataSave = $(this).parents('.addItems').find('.addNewData').serialize();

        $.ajax({
            url: 'directory/save',
            type: 'post',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: dataSave,
            success: function (data) {
                $(document).find('.addItems').find('.modal-body').remove();
                $(document).find('.addItems').find('.modal-footer').remove();
                $(document).find('.addItems').find('.modal-header').find('.close').remove();

                $(document).find('#modalLabelDelDraftHeader').text('Успешное сохранение!').css({
                    'text-align' : 'center',
                    'width' : '100%'
                });

                setTimeout(function(){
                    window.location.reload();
                }, 2000);
            },
            error: function (error) {

            }
        });
    })
});
