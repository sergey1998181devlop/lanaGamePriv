

@extends('admin.layouts.app')
@section('page')
<?php $page='users';?>
<title>Пользователи</title>
@endsection
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@section('content')

   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Пользователи<span class="badge badge-pill badge-warning">{{count($users)}}</span></h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">{{__('messages.add')}}</button>
    </h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>№</th>
            <th>{{__('messages.Name')}}</th>
            <th>{{__('messages.Email')}}</th>
         
            <th>действие</th>
          </tr>
        </thead>
        @if(count($users)>5)
        <tfoot>
          <tr>
            <th>№</th>
            <th>{{__('messages.Name')}}</th>
            <th>{{__('messages.Email')}}</th>
             
            <th>действие</th>
          </tr>
        </tfoot>
        @endif
        <tbody>
           @foreach($users as $user) 
          <tr>
            <td name="id" val="{{$user->id}}">{{$user->id}}</td>
            <td name="name" val="{{$user->name}}">{{$user->name}}</td>
            <td name="email" val="{{$user->email}}">{{$user->email}}</td>
          
            <td>
                <button type="button" class="btn-sm btn btn-info editUserButton"  data-toggle="modal" data-target="#editUser">{{__('messages.edit')}}</button>
            @if($user->id!=1)
             
                <button type="button" class="btn-sm btn btn-danger deleteUserButton"  data-toggle="modal" data-target="#deleteUser" userId="{{$user->id}}" userName="{{$user->name}}">{{__('messages.delete')}}</button>
                

            @endif 
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
@include('admin.users.modals.add')
@include('admin.users.modals.edit')
@include('admin.users.modals.delete')

      @endsection


@section('scripts')
  <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>

  <script>
  
  $('.editUserButton').click(function(){
            var modal=$('.modal'+$(this).attr('data-target'));
            modal.find('input#name').val($(this).closest('tr').find('td[name="name"]').text());
            modal.find('input#email').val($(this).closest('tr').find('td[name="email"]').text());
            modal.find('input#id').val($(this).closest('tr').find('td[name="id"]').text());
             
    });
    $('.deleteUserButton.btn').click(function(){
        var id=$(this).attr('userId'),
            name=$(this).attr('userName');
        $('#deleteUser .username').text(name);
        $('#deleteUser #userId').val(id);
    });
    </script>
@endsection