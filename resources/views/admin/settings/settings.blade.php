@extends('admin.layouts.app')
@section('page')
<title>настройки</title>
<?php $page='settings';?>

@endsection

@section('content')

<?php
$settingsAr=array();
foreach($settings as $setting){
$settingsAr[$setting->name]=$setting;
}
?>

  <!-- Begin Page Content -->
  <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Настройки</h1>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  
  </div>
  <div class="card-body">
  <form action="{{url('panel/settings/update')}}" method="post" >
    {{ csrf_field() }}
 


    <div class="col-sm-12 form-group"> 
        <div class="col-sm-4 font-xs ">
            <label>
                <a data-toggle="popover" >Цена туристического приглашения:</a>
            </label>
        </div>
        <div class="col-sm-8 col-xs-12">
                <input type="number" id="turism-visa" name="turism-visa" value="{{$settingsAr['turism-visa']->value}}" class="form-control col-sm-8 col-xs-12 inline" required >
        </div>
    </div>
    <div class="col-sm-12 form-group"> 
        <div class="col-sm-4 font-xs ">
            <label>
                <a data-toggle="popover" >Цена делового приглашения:</a>
            </label>
        </div>
        <div class="col-sm-8 col-xs-12">
                <input type="number" id="business-visa" name="business-visa" value="{{$settingsAr['business-visa']->value}}" class="form-control col-sm-8 col-xs-12 inline" required >
        </div>
    </div>
    
 
    <div class="clear"></div>
    <button type="submit" class="btn btn-primary" >Изменить</button>
</form>

  </div>
</div>

</div>
@endsection