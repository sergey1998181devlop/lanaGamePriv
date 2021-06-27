
@extends('admin.layouts.app')
@section('page')
<?php $page='clubs';$title="clubs";?>
@endsection
@section('content')

   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Все клубы<span class="badge badge-pill badge-warning">{{$clubs->total() }}</span></h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>№</th>
            <th>Название клуба</th>
            <th>Город</th>
            <th>владелец</th>
            <th>Дата последнего обновления</th>
          </tr>
        </thead>
        <tbody>
            <? $i = 1;?>
           @foreach($clubs as $club) 
          <tr>
            <td name="id" val="{{$club->id}}">{{$i++}}</td>
            <td><a href="{{url('clubs/'.$club->id.'/'.$club->url)}}">{{$club->club_name}}</a></td>

            <td>@if(isset($club->city)){{$club->city->name}}@endif</td>
            <td>{{$club->user->name}}</td>
            <td>
                {{$club->updated_at}}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{$clubs->links()}}
  </div>

</div>

</div>
@endsection
@section('scripts')
@endsection
