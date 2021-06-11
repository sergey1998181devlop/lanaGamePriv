
@if(count($errors)>0)
<div class="container-fluid">
@foreach ($errors->all() as $error)
<div class="alert alert-danger">
    <strong>ошибка!</strong> {{$error}}.
    <button type="button" class="close " data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
  </div>


@endforeach
</div>
@endif

@if(session('success'))


@if(is_array(session('success')))
<div class="container-fluid">
@foreach(session('success')['msg'] as $msg)
<div class="alert alert-success">
     {{$msg}}.
    <button type="button" class="close " data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
  </div>
@endforeach
</div>
@else
<div class="container-fluid">
<div class="alert alert-success">

    {{session('success')}}.
    <button type="button" class="close " data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
  </div>
  </div>
  @endif
@endif

@if(session('error'))
<div class="container-fluid">
<div class="alert alert-danger">
    <strong>ошибка!</strong> {{session('error')}}.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
  </div>
  </div>
   
    @endif