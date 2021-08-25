
@extends('admin.layouts.app')
@section('page')
<?php $page='clubs';$title="Все клубы";?>
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')

   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Все клубы<span class="badge badge-pill badge-warning">{{count($clubs) }}</span></h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable_" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>№</th>
            <th>Название клуба</th>
            <th>Город</th>
            <th>владелец</th>
            <th>Статус</th>
            <th>Дата добавления</th>
            <th>Дата последнего обновления</th>
            <th>Администратор, <small>последний совершавший действия над клубов</small></th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>
            <? $i = 1;?>
           @foreach($clubs as $club) 
          <tr>
            <td name="id" val="{{$club->id}}">{{$i++}}</td>
            <td><a href="{{url('clubs/'.$club->id.'/'.$club->url)}}">{{$club->club_name}}</a></td>

            <td>@if(isset($club->city)){{$club->city->name}}@endif</td>
            <td><a href="{{url('panel/users')}}?search={{$club->user->phone}}">{{$club->user->name}}</a></td>
            <!-- status -->
            <?php
             if($club->published_at != null){
               if($club->hidden_at != null){
                $status = "Владелец снял с публикации";
               }else{
                $status = "Опубликован";
               }
             }else{
               if($club->published_by != null && $club->published_by != 0){
                 $status = "Снят с публикации";
               }else{
                $status = "На модерации";
               }
             }
            ?>
            <td>{{$status}}</td>
            <td>
                {{$club->created_at}}
            </td>
            <td>
                {{$club->updated_at}}
            </td>
            <td>{{($club->last_admin_edit!=null && $club->lastAdminEdit !=null  ) ? $club->lastAdminEdit->name : null}}</td>
            <td>
              <a href="{{url('personal/club/'.$club->id.'/edit')}}" class="btn btn-sm btn-primary">Редактировать</a>
              <?if($club->published_at == null){?>
                <a href="{{url('club/'.$club->id.'/active')}}" class="club_active btn btn-sm btn-success">Опубликовать</a>
                <?}else{?>
                <a href="#" data-toggle="modal" data-target="#club_comment_modal" data-id="{{$club->id}}" class="btn club_comment_modal btn-sm btn-secondary">Снять с публикации</a>
             <?}?>
             <a href="{{url('clubs/'.$club->id.'/'.$club->url)}}?action=change_user" class="btn btn-warning btn-sm">Передать другому</a>
             <a href="#" data-toggle="modal" data-target="#club_delete_modal" data-id="{{$club->id}}" club-name="{{$club->club_name}}"  href="{{url('panel/club/'.$club->id.'/delete')}}" class="btn btn-danger club_delete btn-sm">Удалить</a>
            
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
<div class="modal fade" id="club_comment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Снять с публикации</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" style="dispaly:inline">
      {{ csrf_field() }}
          <div class="modal-body">
              Напишите коммент
              <div class="form-group row">
                 <div class="col-md-10 offset-md-1"><textarea class="form-control" name="comment" cols="30" rows="10" required></textarea></div>
                  
              </div>
          </div>
      <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
              <button type="submit" class="btn btn-primary">Отправить</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="club_delete_modal">
  <div class="modal-dialog" role="documentd">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Удалить клуб</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" style="dispaly:inline">
      {{ csrf_field() }}
          <div class="modal-body">
          <p>Вы уверены,что хотите удалить <span class="clubname badge badge-secondary"></span> ? удаляется из базы клуб в "Удалённые"</p>
          </div>
      <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
              <button type="submit" class="btn btn-danger">Удалить</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
<script>
   var table = $('#dataTable_').DataTable();
   $('.club_comment_modal').click(function(){
     $('#club_comment_modal form').attr('action',"{{url('club/')}}/"+$(this).attr('data-id')+"/comment")
   })
   $('.club_delete').click(function(){
     $('#club_delete_modal form').attr('action',"{{url('panel/club/')}}/"+$(this).attr('data-id')+"/delete");
        $('#club_delete_modal .clubname').text($(this).attr('club-name'));
   })
</script>
@endsection
