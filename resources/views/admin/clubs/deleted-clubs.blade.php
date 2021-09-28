
@extends('admin.layouts.app')
@section('page')
<?php $page='deleted-clubs';$title="Удалённые клубы";?>
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')

   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Удалённые клубы<span class="badge badge-pill badge-warning">{{count($clubs)}}</span></h1>


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
            <th>Дата удаления</th>
            <th>Кто удалил</th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>
            <? $i = 1;?>
           @foreach($clubs as $club)
           <? $CUrl=url($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city->en_name);?>
          <tr>
            <td name="id" val="{{$club->id}}">{{$i++}}</td>
            <td><a href="{{$CUrl}}">{{$club->club_name}}</a></td>

            <td>{{$club->city->name}}</td>
            <td><a href="{{url('panel/users')}}?search={{$club->user->phone}}">{{$club->user->name}}</a></td>
            <?php
              $status = ($club->created_at == $club->updated_at ) ? 'первичная модерация' : 'повторная модерация';
              $color= (count($club->comments) > 0 && $club->updated_at > $club->comments[0]->created_at) ? 'background:#ffcf92':null;
            ?>
            <td style="{{ $color}}">{{$status}}</td>
            <td>
              {{(count($club->comments) > 0) ? count($club->comments) : null }}
              <br>
              <small>
              {{(isset($club->comments[0])) ? \Illuminate\Support\Str::limit(strip_tags($club->comments[0]->comment),50, '...')  : null}}
              </small>
            </td>
            <td>
                {{$club->created_at}}
            </td>
            <td>
                {{$club->deleted_at }}
            </td>
            <td>
              {{(is_object($club->deletedBy)) ? $club->deletedBy->name : null}}
            </td>
            <td>
                <a href="{{url('personal/club/'.$club->id.'/edit')}}" class="btn btn-sm btn-primary">Редактировать</a>
                <a href="{{url('panel/club/'.$club->id.'/recover')}}" class="btn btn-sm btn-success">Вернуть</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
@endsection
@section('scripts')
  <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
@endsection
