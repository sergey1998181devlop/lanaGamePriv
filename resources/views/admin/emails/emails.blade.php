

@extends('admin.layouts.app')
@section('page')
<?php $page='emails';?>
<title>Все Emails</title>
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')


   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Emails<span class="badge badge-pill badge-warning">{{count($emails)}}</span>&nbsp;
  <a class="btn-sm btn btn-info" href="/panel/emails/add">Добавить</a></h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTableN" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Название клуба</th>
            <th>ФИО</th>
            <th>Город</th>
            <th>Должность</th>
            <th>Email</th>
            <th>Телефон</th>
            <th>Telegram</th>
            <th>Дата оплаты</th>
            <th>Сумма оплаты</th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>          
           @foreach($emails as $email) 
          <tr>  
            <td name="name">{{$email->name_club}}</td>
            <td name="name">{{$email->name}}</td>
            <td name="name">{{$email->city}}</td>
            <td name="name">{{$email->boss}}</td>
            <td name="email">{{$email->user_email}}</td>
            <td name="name">{{$email->phone}}</td>
            <td name="name">{{$email->telegram}}</td>
            <td name="datepay">{{$email->payed_at}}</td>
            <td name="datepay">{{$email->price}}</td>
            <td>
                <?if($email->published_at == null){?>
                    <a href="{{url('/panel/emails/active')}}/{{$email->id}}" class="club_active btn btn-sm btn-success">Активировать</a>
                  <?}else{?>
                    <a href="{{url('/panel/emails/deactive')}}/{{$email->id}}" class="club_active btn btn-sm btn-success">ДеАктивировать</a>
                <?}?>
                <a class="btn-sm btn btn-info" href="{{url('/panel/emails/edit/')}}/{{$email->id}}">Отредактировать</a>
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

<!-- Modal -->
@endsection
@section('scripts')
  <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script>
      
    </script>
@endsection