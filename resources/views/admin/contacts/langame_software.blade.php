

@extends('admin.layouts.app')
@section('page')
<?php $page='langame_soft';?>
<title>Заявки LanGame Software</title>
@endsection
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
            <td name="city">{{$request->city_name->name}}</td>
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
@endsection

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
          </div>
        </div>
      </div>
@section('scripts')
  <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
  <script>

$(document).ready( function() {
    $('#dataTableN').dataTable({
        /* No ordering applied by DataTables during initialisation */
        "order": []
    });
});

$('.deleterequestButton.btn').click(function(){
    var id=$(this).attr('requestId');
    $('#deleterequest #messageId').val(id);
});
    </script>
@endsection