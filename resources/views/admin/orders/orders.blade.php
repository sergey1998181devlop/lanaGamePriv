@extends('admin.layouts.app')
@section('page')
<?php $page='orders';?>
<title>Заказы</title>


@endsection   
@section('content')
 
<?php
//if(count($orders)>0){

    if(isset($_GET['page'])){
        $i =  ((intval($_GET['page']) - 1) * $pagation) + 1; 
    }else{
        $i=1;
    }

    $statusFil='paid';
    $typeFil='all';
    if(isset($_GET['status'])){
        if($_GET['status']=='created' || $_GET['status']=='done' ){
        $statusFil=$_GET['status'];
    }
}
    if(isset($_GET['type'])){
        if($_GET['type']=='1' || $_GET['type']=='2' ){
        $typeFil=$_GET['type'];
        }
    }

?>
 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Заказы</h1>
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <div id="filters">
      <div class="left">
            <div class="btn-group btn-group-toggle " data-toggle="buttons">
                    <label class="btn btn-primary  <?php if($statusFil=='paid')echo 'active';?>">
                        <input type="radio" name="status" id="status1" <?php if($statusFil=='paid')echo 'checked';?>   value="paid" autocomplete="off" checked>оплаченые
                    </label>
                    <label class="btn btn-primary <?php if($statusFil=='created')echo 'active';?>">
                        <input type="radio" name="status" id="status2"  <?php if($statusFil=='created')echo 'checked';?> value="created" autocomplete="off">не оплаченые
                    </label>
                    <label class="btn btn-primary <?php if($statusFil=='done')echo 'active';?>">
                        <input type="radio" name="status" id="status3" <?php if($statusFil=='done')echo 'checked';?> value="done" autocomplete="off">выполнены
                    </label>
                  </div>
      </div>
    <div class="right">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-secondary  <?php if($typeFil=='all')echo 'active';?>">
                        <input type="radio" name="type" id="type1" value="all" autocomplete="off" <?php if($typeFil=='all')echo 'checked';?> > все
                    </label>
                    <label class="btn btn-secondary <?php if($typeFil=='1')echo 'active';?>">
                        <input type="radio" name="type" id="type2" value="1" autocomplete="off" <?php if($typeFil=='1')echo 'checked';?>>туристические
                    </label>
                    <label class="btn btn-secondary <?php if($typeFil=='2')echo 'active';?>">
                        <input type="radio" name="type" id="type3" value="2" autocomplete="off" <?php if($typeFil=='2')echo 'checked';?>>деловие
                    </label>
                  </div>
    </div>
</div>
  </div>
  <div class="card-body">
        <div class="table-responsive">
          
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th>#</th>
        <th>{{__('messages.name')}} {{__('messages.family')}}</th>
        <th>{{__('messages.pasport_no')}}</th>
        <th>{{__('messages.сitizenship')}}</th>
        <th>Тип</th>
        <th>Создано</th>
        <th>Действии</th>
      </tr>
    </thead>
    <tbody>
    
    @foreach($orders as $order)
      <tr>
        <td>{{$i++}}</td>
        <td><a href="{{url('panel/orders')}}/{{$order->id}}" target="_blank">{{$order->name}} {{$order->family}}</a></td>
        <td>{{$order->pasport_no}}</td>
        <td>{{countries($order->сitizenship)}}</td>
        <td>{{__('messages.visa_'.$order->type)}}</td>
        <td >{{timelabe($order->created_at)}}</td>
        <td>
          @if($order->status=="created")
            <button type="button" class="btn-sm btn btn-danger deleteorderButton"  data-toggle="modal" data-target="#deleteorder" orderId="{{$order->id}}" orderName="{{$order->name}} {{$order->family}}">{{__('messages.delete')}}</button>
          @elseif($order->status=="paid")
            <button type="button" class="btn-sm btn btn-success orderDoneButton"  data-toggle="modal" data-target="#orderDone" orderId="{{$order->id}}" orderName="{{$order->name}} {{$order->family}}">выполнен</button>
          @endif
         
                
        </td>
       
      </tr>
      @endforeach
    </tbody>
  </table>
  @if(count($orders)==0)
      <tr>
    <b> Нет заказов </b>
      </tr>
      @endif
  </div>
</div>
</div>

{{ $orders->appends(['status' => $statusFil])->appends(['type' => $typeFil])->links() }}

</div>





<?php // }

//else{
  //echo "<div></div>";
//}?>



<!-- Modal -->
<div class="modal fade" id="deleteorder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{url('orders/delete')}}" method="post">
            {{ csrf_field() }}
            <input type="number" hidden name="orderId" id="orderId">
        <div class="modal-body">
                <p>Вы уверены,что хотите удалить <span class="ordername badge badge-secondary"></span> ?:</p>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                <button type="submit" class="btn btn-danger">{{__('messages.Delete')}}</button>
        </div>
        </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="orderDone" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Подтверждение операция</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{url('orders/statusdone')}}" method="post">
            {{ csrf_field() }}
            <input type="number" hidden name="orderId" id="orderId">
        <div class="modal-body">
                <p>Вы уверены,что хотите отметить заказа <span class="ordername badge badge-secondary"></span>  как выполнен?</p>
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                <button type="submit" class="btn btn-success">выполнен</button>
        </div>
        </form>
      </div>
    </div>
</div>
@endsection    
@section('scripts')
<script>
$('.deleteorderButton.btn').click(function(){
        var id=$(this).attr('orderId'),
            name=$(this).attr('orderName');
        $('#deleteorder .ordername').text(name);
        $('#deleteorder #orderId').val(id);
    });
    $('.orderDoneButton.btn').click(function(){
        var id=$(this).attr('orderId');
        $('#orderDone #orderId').val(id);
    });
    
   ;
  $('#filters input[type="radio"]').change(function(){
    var type=$("input[name='type']:checked").val();
    var status=$("input[name='status']:checked").val();
    var url=window.location.href.split('?')[0];
        window.location.replace(url+"?status="+status+"&type="+type);
  });
    
</script>

@endsection    
