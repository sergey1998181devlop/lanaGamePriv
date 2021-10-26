

@extends('admin.layouts.app')
@section('page')
<?php $page='offers';?>
<title>Все объявления</title>
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')


   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Объявления<span class="badge badge-pill badge-warning">{{count($offers)}}</span>&nbsp;
<a class="btn-sm btn btn-info" href="/offers/newBrand">Добавить</a></h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTableN" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Заголовок</th>
            <th>Дата добавления</th>
            <th>Просмотров</th>
            <th>Показать контакт</th>
            <th>Приоритет</th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>          
           @foreach($offers as $offer) 
          <tr>  
            <td name="name"><a href="/clubs-offers">{{$offer->name}}</a></td>
            <td name="phone">{{$offer->created_at}}</td>
            <td name="views">{{$offer->views}}</td>
            <td name="views_click">{{$offer->views_click}}</td>
            <td><button type="button" class="btn-sm btn btn-primary reOrderOfferButton"  data-toggle="modal" data-target="#reOrderOffer" contactId="{{$offer->id}}">{{$offer->order_no}}</button></td>
            <td>
                <a class="btn-sm btn btn-info" href="{{url('offer/edit/')}}/{{$offer->id}}">Отредактировать</a>
                <button type="button" class="btn-sm btn btn-danger deleteOfferButton"  data-toggle="modal" data-target="#deleteOffer" contactId="{{$offer->id}}" contactName="{{$offer->name}}">{{__('messages.Delete')}}</button>
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
<div class="modal fade" id="deleteOffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="offer" id="deleteOfferForm">
          {{ csrf_field() }}
          <input type="number" hidden name="panel" value="1">
          <div class="modal-body">
                  <p>Вы уверены, что хотите удалить объявление?</p>
          </div>
          <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                  <button type="submit" class="btn btn-danger">{{__('messages.Delete')}}</button>
          </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="reOrderOffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Редактировать порядок отображения</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('panel/offers/order_no')}}" method="offer" id="reOrderOfferForm">
          {{ csrf_field() }}
          <input type="number" hidden name="id" id="targetId" value="">
          <div class="modal-body">
                  <div class="form-group row">
                    <label for="order_no" class="col-md-12 col-form-label">Назначайте новый приоритет</label>
                    <div class="col-md-12">
                      <input id="order_no" type="number" class="form-control" min="0" name="order_no" required autofocus="">
                    </div>
                  </div>
          </div>
          <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                  <button type="submit" class="btn btn-primary">Сохранить</button>
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
      "language": {
          "processing": "Подождите...",
          "search": "Поиск:",
          "lengthMenu": "Показать _MENU_ записей",
          "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
          "infoEmpty": "Записи с 0 до 0 из 0 записей",
          "infoFiltered": "(отфильтровано из _MAX_ записей)",
          "infoOfferFix": "",
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

$('.deleteOfferButton.btn').click(function(){
    var id=$(this).attr('contactId');
    var url = "{{url('offer/delete')}}";
    $('#deleteOfferForm').attr('action',url + '/' + id);
});
$('.reOrderOfferButton.btn').click(function(){
    $('#reOrderOffer #targetId').val($(this).attr('contactId'));
    $('#reOrderOffer #order_no').val($(this).text())
});


    </script>
@endsection