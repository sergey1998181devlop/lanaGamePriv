
@extends('admin.layouts.app')
@section('page')
<?php $page='drafts';$title="Черновики";?>
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')

   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Черновики<span class="badge badge-pill badge-warning">{{count($clubs)}}</span></h1>


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
            <th>Дата добавления</th>
            <th>Дата последнего редактирования</th>
            <th>Действия</th>
          </tr>
        </thead>
        <tbody>
            <? $i = 1;?>
           @foreach($clubs as $club)
          <tr>
            <td name="id" val="{{$club->id}}">{{$i++}}</td>
            <td>{{$club->club_name}}</td>
            <td>{{$club->city->name}}</td>
            <td><a href="{{url('panel/users')}}?search={{$club->user->phone}}">{{$club->user->name}}</a></td>
            <td>
                {{$club->created_at}}
            </td>
            <td>
                {{$club->updated_at }}
            </td>
              <td>
{{--                  если текущий пользователь админ или это создатель--}}
                  @if(admin(1)  || admin(2) || $club->user->id == $currentUserId)
                      <a href="{{ route('admin.clubs.edit' , $club->id) }}"
                         class="btn-sm btn btn-info editUserButton">{{__('messages.edit')}}</a>
                  @endif
                  @if(admin(1)  ||  admin(2) || $club->user->id == $currentUserId)
                      <form method="POST" action="{{ route('admin.clubs.destroy' , $club->id) }}"  data-idFormDraft="{{ $club->id }}" class="d-none" >
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="btn-sm btn btn-danger deleteUserButton" data-toggle="modal"
                                  data-target="#deleteUser"
                          >{{__('messages.Delete')}}</button>
                      </form>
                      <button type="button" class="btn-sm btn btn-danger deleteDraftButton" data-idDraft="{{ $club->id }}" data-toggle="modal" data-target="#deleteDraft">{{__('messages.Delete')}}</button>
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
   <!-- Modal -->
   <div class="modal fade deleteDraftModel" id="deleteDraft" tabindex="-1" role="dialog" aria-labelledby="modalLabelDelDraft" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="modalLabelDelDraft">Подтверждение удаления</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
{{--               <form method="POST" action="{{ route('admin.clubs.destroy') }}">--}}
{{--                   @method('DELETE')--}}
{{--                   @csrf--}}
                   <div class="modal-body">
                       <p>Вы уверены, что хотите удалить объявление?</p>
                   </div>
                   <div class="modal-footer">
                       <input type="hidden" name="idDraft" value="">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                       <button type="submit" class="btn  btn-danger deleteDraftButtonModal" data-toggle="modal"
                               data-target="#deleteUser"
                       >{{__('messages.Delete')}}</button>
                   </div>>
{{--               </form>--}}
           </div>
       </div>
   </div>
@endsection
@section('scripts')
  <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
  <script src="{{asset('admin/js/drafts/draftsList.js')}}"></script>
@endsection
