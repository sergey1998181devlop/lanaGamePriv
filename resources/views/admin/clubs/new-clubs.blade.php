
@extends('admin.layouts.app')
@section('page')
<?php $page='new-clubs';$title="Новые клубы";?>
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')

   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Новые клубы<span class="badge badge-pill badge-warning">{{count($clubs)}}</span></h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>№</th>
            <th>Название клуба</th>
            <th>Город</th>
            <th>владелец</th>
            <th>Статус</th>
            <th>Комментарий</th>
            <th>Дата добавления</th>
            <th>Дата последнего редактирования</th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>
            <? $i = 1;?>
           @foreach($clubs as $club) 
          <tr>
            <td name="id" val="{{$club->id}}">{{$i++}}</td>
            <td><a href="{{url($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city_en_name)}}">{{$club->club_name}}</a></td>

            <td>{{$club->city->name}}</td>
            <td><a href="{{url('panel/users')}}?search={{$club->user->phone}}">{{$club->user->name}}</a></td>
            <?php
              $status = ($club->created_at == $club->updated_at ) ? 'первичная модерация' : 'повторная модерация';
              $color= (count($club->comments) > 0 && $club->updated_at > $club->comments[0]->created_at) ? 'background:#ffcf92':null;
            ?>
            <td style="{{ $color}}">{{$status}}</td>
            <td>
              {{(count($club->comments) > 0) ? count($club->comments) : null }}
            </td>
            <td>
                {{$club->created_at}}
            </td>
            <td>
                {{($club->created_at == $club->updated_at ) ? '' : $club->updated_at}}
            </td>
            <td>
            <a href="{{url('personal/club/'.$club->id.'/edit')}}" class="btn btn-sm btn-primary">Редактировать</a>
            <a href="{{url($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city_en_name.'/active')}}" class="club_active btn-sm btn btn-success">Опубликовать</a>
            <a href="#" data-toggle="modal" data-target="#club_delete_modal" data-id="{{$club->id}}" club-name="{{$club->club_name}}"  href="{{url('panel/club/'.$club->id.'/delete')}}" class="btn btn-danger club_delete btn-sm">Удалить</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
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
</div>
@endsection
@section('scripts')
  <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
  <script>
     $('.club_delete').click(function(){
     $('#club_delete_modal form').attr('action',"{{url('panel/club/')}}/"+$(this).attr('data-id')+"/delete");
        $('#club_delete_modal .clubname').text($(this).attr('club-name'));
   })
  </script>
@endsection
