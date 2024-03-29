

@extends('admin.layouts.app')
@section('page')
<?php $page='langame_soft';?>
<title>Заявки LanGame Software</title>
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')


   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">LanGame Software - Новые заявки<span class="badge badge-pill badge-warning">{{$newCount}}</span></h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTableN" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>{{__('messages.Name')}}</th>
            <th>{{__('messages.Email')}}</th>
            <th>{{__('messages.phone')}}</th>
            <th>Название клуба</th>
            <th>Количество клубов</th>
            <th>Общее количество ПК и консолей</th>
            <th>Роль в клубе</th>
            <th>Город</th>
            <th>Отпралено</th>        
            <th>Действие</th>
          </tr>
        </thead>
        @if(count($requests)>5)
        <tfoot>
          <tr>
            <th>{{__('messages.Name')}}</th>
            <th>{{__('messages.Email')}}</th>
            <th>{{__('messages.phone')}}</th>
            <th>Название клуба</th>
            <th>Количество клубов</th>
            <th>Общее количество ПК и консолей</th>
            <th>Роль в клубе</th>
            <th>Город</th>
            <th>Отпралено</th>
            <th>Действие</th>
          </tr>
        </tfoot>
        @endif
        <tbody>
           @foreach($requests as $request) 
          <tr @if($request->seen_at==null) style="background: #ffed85;" @endif>  
            <td name="name" >{{$request->name}}</td>
            <td name="email">{{$request->email}}</td>
            <td name="phone">{{$request->phone}}</td>
            <td name="club_name">{{$request->club_name}}</td>
            <td name="club_name">{{$request->club_count}}</td>
            <td name="club_name">{{$request->club_pk_count}}</td>
            <td name="club_name">{{$request->boss}}</td>
            <td name="city">@if (!empty($request->city_name)) {{$request->city_name->name}} @endif</td>
            <td>{{$request->created_at}}</td>
            <td>
            @if($request->seen_at==null)
                <a type="button" class="btn-sm btn btn-info " href="{{url('panel/langame-requests/toggle')}}/{{$request->id}}">Отметить как принята</a>
            @else
                <a type="button" class="btn-sm btn btn-light " href="{{url('panel/langame-requests/toggle')}}/{{$request->id}}">Отметить как не принята</a>
            @endif    
                <button type="button" class="btn-sm btn btn-danger deleterequestButton"  data-toggle="modal" data-target="#deleterequest" requestId="{{$request->id}}" requestName="{{$request->name}}">{{__('messages.Delete')}}</button>
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
<div class="modal fade" id="deleterequest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('/panel/langame-requests/delete')}}" method="post">
                {{ csrf_field() }}
                <input type="number" hidden name="id" id="messageId">
                <div class="modal-body">
                        <p>Вы уверены,что хотите удалить заявки?</p>
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

$('.deleterequestButton.btn').click(function(){
    var id=$(this).attr('requestId');
    $('#deleterequest #messageId').val(id);
});
    </script>
@endsection