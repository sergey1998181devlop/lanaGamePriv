@extends('admin.layouts.app')
@section('page')
<?php $page='club_errors';?>
<title>Форма комментарий к клубу</title>
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')


   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Новые заявки<span class="badge badge-pill badge-warning">{{$newCount}}</span></h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTableN" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Сообщение</th>
            <th>{{__('messages.Name')}}</th>
            <th>{{__('messages.Email')}}</th>
            <th>{{__('messages.phone')}}</th>    
            <th>Отпралено</th>        
            <th>Действие</th>
          </tr>
        </thead>
        @if(count($reports)>5)
        <tfoot>
          <tr>
            <th>Сообщение</th>
            <th>{{__('messages.Name')}}</th>
            <th>{{__('messages.Email')}}</th>
            <th>{{__('messages.phone')}}</th>
            <th>Отпралено</th>
            <th>Действие</th>
          </tr>
        </tfoot>
        @endif
        <tbody>
           @foreach($reports as $report) 
          <tr @if($report->seen_at==null) style="background: #ffed85;" @endif>  
            <td>{{substr($report->message, 0, 100)}}</td>
            <td name="name" >{{$report->name}}</td>
            <td name="email">{{$report->email}}</td>
            <td name="phone">{{$report->phone}}</td>
            <td>{{$report->created_at}}</td>
            <td>
                <button type="button" class="btn-sm btn btn-info showMessage" contactId="{{$report->id}}" data-toggle="modal" data-target="#showMessage">Посмотреть</button>
                <button type="button" class="btn-sm btn btn-danger deletecontactButton"  data-toggle="modal" data-target="#deletecontact" contactId="{{$report->id}}" contactName="{{$report->name}}">{{__('messages.Delete')}}</button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="showMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-body">

      </div>
      </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="deletecontact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('panel/club-error-reports/delete')}}" method="post">
                {{ csrf_field() }}
                <input type="number" hidden name="id" id="messageId">
              <div class="modal-body">
                      <p>Вы уверены,что хотите удалить сообщение?</p>
              </div>
              <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                      <button type="submit" class="btn btn-danger">{{__('messages.Delete')}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
  @endsection
@section('scripts')
  <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script>

$(document).ready( function() {
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
  } );
});

$('.deletecontactButton.btn').click(function(){
    var id=$(this).attr('contactId');
    $('#deletecontact #messageId').val(id);
});

$('.showMessage').click(function(){
    
    var
    id=$(this).attr('contactId'),
    modal=$('.modal'+$(this).attr('data-target'));
    modal.find(".modal-body").empty();
    jQuery.ajax({
    type: 'get',
    data : {'id' : id},
    url: "{{url('panel/club-get-report')}}",
    success: function(data) {
        modal.find(".modal-body").append(data.html)
    },
    error: function() {
        alert('Ошибка')
    }
});
})
    </script>
@endsection