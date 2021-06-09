
@extends('admin.layouts.app')
@section('page')
<?php $page='clubs';$title="clubs";?>
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
            <th>владелец</th>
            <th>Дата последнего обновления</th>
          </tr>
        </thead>
        @if(count($clubs)>5)
        <tfoot>
          <tr>
            <th>№</th>
            <th>Название клуба</th>
            <th>владелец</th>
            <th>Дата последнего обновления</th>
          </tr>
        </tfoot>
        @endif
        <tbody>
            <? $i = 1;?>
           @foreach($clubs as $club) 
          <tr>
            <td name="id" val="{{$club->id}}">{{$i++}}</td>
            <td><a href="{{url('clubs/'.$club->id.'/'.$club->url)}}">{{$club->club_name}}</td>
            <td>{{$club->user->name}}</td>
            <td>
                {{$club->updated_at}}
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
