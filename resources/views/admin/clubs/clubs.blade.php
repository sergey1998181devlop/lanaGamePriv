
@extends('admin.layouts.app')
@section('page')
<?php $page='clubs';$title="Все клубы";?>
<link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
          integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
          crossorigin="anonymous"/>
 <style>
   .select2.select2-container.select2-container--default{
     width:auto!important;min-width: 150px;
   }
 </style>         
@endsection
@section('content')
<?php
  $allRows =(isset($_GET['allRows']) && $_GET['allRows']=='true') ;
  $onyPublished = (isset($_GET['onlyPublished']) && $_GET['onlyPublished']=='true');
?>
   <!-- Begin Page Content -->
   <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Все клубы <?=$onyPublished  ? '(опубликованые)' : null ?> <?=($city != 'all') ? '('.$city.')': '' ?><span class="badge badge-pill badge-warning">{{count($clubs) }}</span></h1>
<p>Опубликованые <?=$total['published']?>
<?if($total['publishedClosed'] > 0 || $total['publishedHidden'] > 0) {
  echo ' из них ';
  if($total['publishedClosed'] > 0 ) echo $total['publishedClosed'].' закрытых';
  
  if($total['publishedHidden'] > 0 ){
    if($total['publishedClosed'] > 0 )echo ', ';
    echo $total['publishedHidden'].' снятых владельцами';
  } 
} ?>
</p>
<?if(!$onyPublished){?><p style="margin-top:-1rem;">На модерации <?=$total['underEdit']?><?=$total['underEditClosed'] > 0 ? ' из них '.$total['underEditClosed'].' закрытых' : ''?></p><?}?>


<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  <div class="select2_wrapper select_city_wrapper" style="display: inline-block;">
      <select class="select_city" id="city_selector">
      <option>
        <?=($city != 'all') ? $city : 'Все города' ?>        
       </option>
      </select>
  </div>
  <div class="form-check" style="display: inline-block;margin-left: 15px;">
    <input type="checkbox" class="form-check-input"  id="onlyPublished" <?=$onyPublished?'checked' : null ?>>
    <label class="form-check-label" for="onlyPublished">Только опубликованые</label>
  </div>
  <div class="form-check" style="display: inline-block;margin-left: 15px;">
    <input type="checkbox" class="form-check-input"  id="allRows" <?=$allRows ? 'checked' : null ?>>
    <label class="form-check-label" for="allRows">Доп. столбцы </label>
  </div>
  <div style="float:right">
    <a href="{{url('panel/export_clubs')}}" target="_blank">
      Export
    </a>
  </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable_" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>№</th>
            <th>Название клуба</th>
            <th>Город</th>
            <?if($allRows){?>
              <th>Телефона клуба</th>
              <th>Почта клуба</th>
              <th>ВК клуба</th>
              <th>Инста клуба</th>
            <?}?>
            <th>владелец</th>
            <th>Статус</th>
            <th>Дата добавления</th>
            <th>Дата последнего обновления</th>
            <th>Администратор, <small>последний совершавший действия над клубов</small></th>
            <th>Действие</th>
          </tr>
        </thead>
        <tbody>
            <? $i = 1;?>
           @foreach($clubs as $club) 
           <? $CUrl=url($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city->en_name);?>
          <tr>
            <td name="id" val="{{$club->id}}">{{$i++}}</td>
            <td><a href="{{url($club->id.'_computerniy_club_'.Str::slug($club->url).'_'.$club->city->en_name)}}">{{$club->club_name}}</a></td>

            <td>@if(isset($club->city)){{$club->city->name}}@endif</td>
            <?if($allRows){?>
              <td>{{$club->phone}}</td>
              <td><a href="mailto:{{$club->club_email}}">{{$club->club_email}}</a></td>
              <td><a href="{{$club->club_vk_link}}">{{$club->club_vk_link}}</a></td>
              <td><a href="{{$club->club_instagram_link}}">{{$club->club_instagram_link}}</a></td>
            <?}?>
            <td><a href="{{url('panel/users')}}?search={{$club->user->phone}}">{{$club->user->name}}</a></td>
            <!-- status -->
            <?php
             if($club->published_at != null){
               if($club->hidden_at != null){
                $status = "Владелец снял с публикации";
               }else{
                $status = "Опубликован";
               }
             }else{
               if($club->published_by != null && $club->published_by != 0){
                 $status = "Снят с публикации";
               }else{
                $status = "На модерации";
               }
             }
            ?>
            <td>{{$status}}</td>
            <td>
                {{$club->created_at}}
            </td>
            <td>
                {{$club->updated_at}}
            </td>
            <td>{{($club->last_admin_edit!=null && $club->lastAdminEdit !=null  ) ? $club->lastAdminEdit->name : null}}</td>
            <td>
              <a href="{{url('personal/club/'.$club->id.'/edit')}}" class="btn btn-sm btn-primary">Редактировать</a>
              <?if($club->published_at == null){?>
                <a href="{{$CUrl}}/active" class="club_active btn btn-sm btn-success">Опубликовать</a>
                <?}else{?>
                <a href="#" data-toggle="modal" data-target="#club_comment_modal" data-id="{{$club->id}}" class="btn club_comment_modal btn-sm btn-secondary">Снять с публикации</a>
             <?}?>
             <a href="{{$CUrl}}?action=change_user" class="btn btn-warning btn-sm">Передать другому</a>
             <a   data-id="{{$club->id}}" club-name="{{$club->club_name}}" class="btn btn-danger club_delete btn-sm pointer">Удалить</a>
            <label><input type="checkbox" name="closed" class="closed_checkbox" data-id="{{$club->id}}" <?= $club->closed ? 'checked' : null ?>>&#160;Закрыто навсегда</label>
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
<div class="modal fade" id="club_comment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Снять с публикации</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" style="dispaly:inline">
      {{ csrf_field() }}
          <div class="modal-body">
              Напишите коммент
              <div class="form-group row">
                 <div class="col-md-10 offset-md-1"><textarea class="form-control" name="comment" cols="30" rows="10" required></textarea></div>
                  
              </div>
              <div class="checkbox_holder form-group" style="margin-top: 10px;">
                  <input type="checkbox" class=""  name="send_mail" id="send_mail">
                  <label for="send_mail">Отправить письмо владельцу</label>
              </div>
          </div>
      <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
              <button type="submit" class="btn btn-primary">Отправить</button>
      </div>
      </form>
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

@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
        integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
<script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script>
  
   var table = $('#dataTable_').DataTable({
      "language": {
          "processing": "Подождите...",
          "search": "Поиск:",
          "lengthMenu": "Показать _MENU_ записей",
          "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
          "infoEmpty": "Записи с 0 до 0 из 0 записей",
          "infoFiltered": "(отфильтровано из _MAX_ записей)",
          "infoPostFix": "",
          "loadingRecords": "Загрузка записей...",
          "zeroRecords": "Записи отсутствуют.",
          "emptyTable": "В таблице отсутствуют данные",
          "paginate": {
              "first": "Первая",
              "previous": "Предыдущая",
              "next": "Следующая",
              "last": "Последняя"
          },
          "aria": {
              "sortAscending": ": активировать для сортировки столбца по возрастанию",
              "sortDescending": ": активировать для сортировки столбца по убыванию"
          }
      }
  } );
   $('.club_comment_modal').click(function(){
     $('#club_comment_modal form').attr('action',"{{url('club/')}}/"+$(this).attr('data-id')+"/comment")
   });
     $(document).on('click','.club_delete',function(e){
       e.preventDefault;
      $('#club_delete_modal form').attr('action',"{{url('panel/club/')}}/"+$(this).attr('data-id')+"/delete");
        $('#club_delete_modal .clubname').text($(this).attr('club-name'));
       $('#club_delete_modal').modal();
     });
     var onlyPublished = <?=$onyPublished ? 'true' : 'false' ?>;
     var allRows = <?=$allRows ? 'true' : 'false' ?>;
     var SelectedCity = "<?=(isset($_GET['city'])) ? $_GET['city'] : '' ?>";
     
     $(document).on('change','#onlyPublished',function(e){
       if($(this).is(':checked')){
        window.location.href = "{{url('panel/clubs/clubs')}}?city="+SelectedCity+"&onlyPublished=true&allRows="+allRows;
       }else{
        window.location.href = "{{url('panel/clubs/clubs')}}?city="+SelectedCity+"&allRows="+allRows;

       }
     });
     $(document).on('change','#allRows',function(e){
       if($(this).is(':checked')){
        window.location.href = "{{url('panel/clubs/clubs')}}?city="+SelectedCity+"&allRows=true&onlyPublished="+onlyPublished ;
       }else{
        window.location.href = "{{url('panel/clubs/clubs')}}?city="+SelectedCity+"&onlyPublished="+onlyPublished;
       }
     });
     
    $('#city_selector').on('select2:select', function(e) {
        window.location.href = '{{url("panel/clubs/clubs")}}' + '?city=' + e.params.data.id + '&onlyPublished=' +onlyPublished+'&allRows='+allRows ;
    });

    $('#city_selector').select2({
        ajax: {
            url: '{{url('')}}' + '/searchCities?hasAll=true',
            dataType: 'json'
        },
        cache: true
    });

</script>
<script>
  $(document).on('change','.closed_checkbox',function(){
    var id=$(this).attr('data-id');
    $.ajax({
        url: "{{url('panel/club/toggle-closed')}}",
        type: 'post',
        dataType: 'json',
        data: {
            'id': id,
            '_token': $('[name="_token"]').val()
        },
        success: function(data) {
        },
        error: function(xhr, ajaxOptions, thrownError) {
        }
    });
  })
</script>
@endsection
