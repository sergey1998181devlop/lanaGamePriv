

@extends('admin.layouts.app')
@section('page')
<?php $page='users';?>
<title>Пользователи</title>
@endsection
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<style>
.userClubs p{
  margin-bottom: 0;
}
.userClubsCount{
  cursor: pointer;
}
</style>
@section('content')


   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Пользователи<span class="badge badge-pill badge-warning">{{count($users)}}</span></h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addUser">{{__('messages.add')}}</button> -->
    </h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable_" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>№</th>
            <th>ФИО</th>
            <th>Должность</th>
            <th>Количество клубов</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Статус активации почты</th>
            <th>Дата регистрации</th>
            <th>Дата последной активности</th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>
           @foreach($users as $user) 
          <tr>
            <td name="id" val="{{$user->id}}">{{$user->id}}</td>
            <td name="name" val="{{$user->name}}">{{$user->name}}</td>
            @if($user->rules == '1')
            <td name="rules" val="{{$user->rules}}">Админ</td>
            @elseif(($user->rules == '2'))
            <td name="rules" val="{{$user->rules}}">Супер-админ</td>
            @else
            <td ></td>
            @endif
            <?
            $clubsCount = [];
            $userClubs = [];
            if(count($user->clubsPublished) > 0 ){
              $clubsCount []=' опуб.('.count($user->clubsPublished).')';
              $userClubs[] ='<p><strong>Опубликованные</strong></p>';
              foreach($user->clubsPublished as $club){
                $userClubs[] = '<p><a href="'.url('clubs/'.$club->id.'/'.$club->url).'">'.$club->club_name.'</a></p>';
              }
            }
            if(count($user->clubsUnderEdit) > 0 ){
              $clubsCount []=' на мод.('.count($user->clubsUnderEdit).')';
              $userClubs[] ='<p><strong>На модерации</strong></p>';
              foreach($user->clubsUnderEdit as $club){
                $userClubs[] = '<p><a href="'.url('clubs/'.$club->id.'/'.$club->url).'">'.$club->club_name.'</a></p>';
              }
            }
            if(count($user->clubsDraft) > 0 ){
              $clubsCount []=' черн.('.count($user->clubsDraft).')';
              $userClubs[] ='<p><strong>Черновики</strong></p>';
              foreach($user->clubsDraft as $club){
                if($club->club_name == '')continue;
                $userClubs[] = '<p>'.$club->club_name.'</p>';
              }
            }
            $clubsCount = implode(', ', $clubsCount);
            $userClubs = implode('',$userClubs);
            ?>
            <td>
             <span class="userClubsCount">{{$clubsCount}}</span> 
              
              <div class="userClubs" style="display:none;">
                {!!$userClubs!!}
              </div>
            
            </td>
            <td name="email" val="{{$user->email}}">{{$user->email}}</td>
            <td name="phone" val="{{$user->phone}}">{{$user->phone}}</td>
            <td>{!!($user->email_verified_at === null) ? 'не активирована' : '<span style="color:green">активирована</span>'!!}</td>
            <td>{{ ($user->created_at)}}</td>
            <td>{{ ($user->last_active_at === null) ? '' : timelabe($user->last_active_at)}}</td>
            <td>
              @if(admin(2))
                <button type="button" class="btn-sm btn btn-info editUserButton"  data-toggle="modal" data-target="#editUser">{{__('messages.edit')}}</button>
              @endif
                <button type="button" class="btn-sm btn btn-secondary  sendMailButton"  data-toggle="modal" data-target="#sendMail">Написать</button>
            @if(admin(2))
                <button type="button" class="btn-sm btn btn-danger deleteUserButton"  data-toggle="modal" data-target="#deleteUser" userId="{{$user->id}}" userName="{{$user->name}}">{{__('messages.Delete')}}</button>
            @endif 

            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="alert alert-info">
   <h6>Админ не имеет права смотреть и редактировать данные пользователей</h6>
  </div>
</div>
@include('admin.users.modals.sendMail')
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
            modal.find('input#phone').val($(this).closest('tr').find('td[name="phone"]').text());
            modal.find('select#rule').val($(this).closest('tr').find('td[name="rules"]').attr('val'));
            modal.find('input#id').val($(this).closest('tr').find('td[name="id"]').text());
    });
    $('.sendMailButton').click(function(){
            var modal=$('.modal'+$(this).attr('data-target'));
            modal.find('input#name_sendMail').val($(this).closest('tr').find('td[name="name"]').text());
            modal.find('input#email_sendMail').val($(this).closest('tr').find('td[name="email"]').text());
            modal.find('input#id_sendMail').val($(this).closest('tr').find('td[name="id"]').text());
    });
    $('.deleteUserButton.btn').click(function(){
        var id=$(this).attr('userId'),
            name=$(this).attr('userName');
        $('#deleteUser .username').text(name);
        $('#deleteUser #userId').val(id);
    });
    $(document).on('submit','#sendMailForm',function(e){
      e.preventDefault();
      $(this).find('[type="submit"]').attr('disabled',true);
      var url = $(this).attr('action'),
          message = $(this).find('#message').val(),
          id = $(this).find('#id_sendMail').val(),
          token=$(this).find('[name="_token"]').val(),
          subject = $(this).find('#subject').val(),
          submetBtn = $(this).find('[type="submit"]'),
          mailResult = $(this).find('.mailResult');
          mailResult.empty();
        $.ajax({
                url: url,
                type: 'POST',
                data: {
                  'id': id,
                    'message': message,
                    '_token': token,
                    'subject':subject
                },
                success: function(data) {

                  submetBtn.attr('disabled',false);
                  if(data.status == 'success'){
                    mailResult.append('<p style="color:green">Сообщение отправлено успешно</p>');
                  }else{
                    mailResult.append('<p style="color:red">Ошибка при отправке сообщение</p>');
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  submetBtn.attr('disabled',false);
                  mailResult.append('<p style="color:red">Ошибка при отправке сообщение</p>');
                }
            });
      })
    </script>
    <script>
      $('.userClubsCount').click(function(){
        $(this).closest('td').find('.userClubs').toggle();
      })

      var table = $('#dataTable_').DataTable();
 
// #myInput is a <input type="text"> element
 <?if(isset($_GET['search'])){?>
  table.search("{{$_GET['search']}}" ).draw();
 <?}?>
    
    </script>
    
@endsection