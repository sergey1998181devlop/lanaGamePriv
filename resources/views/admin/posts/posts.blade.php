

@extends('admin.layouts.app')
@section('page')
<?php $page='posts';?>
<title>Все Статьи</title>
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')


   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Статьи<span class="badge badge-pill badge-warning">{{count($posts)}}</span></h1>


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
            <th>Просмотры</th>
            <th>Дата добавления</th>
            <th>Приоритет</th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>
           @foreach($posts as $post) 
          <tr>  
            <td name="name"><a href="{{url('post/read/'.$post->id.'/'.$post->url)}}">{{$post->name}}</a></td>
            <td name="views">{{$post->views}}</td>
            <td name="phone">{{$post->created_at}}</td>
            <td><button type="button" class="btn-sm btn btn-primary reOrderPostButton"  data-toggle="modal" data-target="#reOrderPost" contactId="{{$post->id}}">{{$post->order_no}}</button></td>
            <td>
                <a class="btn-sm btn btn-info" href="{{url('post/edit/')}}/{{$post->id}}">Отредактировать</a>
                <button type="button" class="btn-sm btn btn-danger deletePostButton"  data-toggle="modal" data-target="#deletePost" contactId="{{$post->id}}" contactName="{{$post->name}}">{{__('messages.Delete')}}</button>
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
<div class="modal fade" id="deletePost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="deletePostForm">
          {{ csrf_field() }}
          <input type="number" hidden name="panel" value="1">
          <div class="modal-body">
                  <p>Вы уверены, что хотите удалить статью?</p>
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
<div class="modal fade" id="reOrderPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Редактировать порядок отображения</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{url('panel/posts/order_no')}}" method="post" id="reOrderPostForm">
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

$('.deletePostButton.btn').click(function(){
    var id=$(this).attr('contactId');
    var url = "{{url('post/delete')}}";
    $('#deletePostForm').attr('action',url + '/' + id);
});
$('.reOrderPostButton.btn').click(function(){
    $('#reOrderPost #targetId').val($(this).attr('contactId'));
    $('#reOrderPost #order_no').val($(this).text())
});


    </script>
@endsection