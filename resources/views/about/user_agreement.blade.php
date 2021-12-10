@extends('layouts.app') @section('page')
<title>Соглашение об обработке песональных данных LANGAME.RU</title>
<meta name="keywords" content="Соглашение об обработке песональных данных" />
<meta name="description" content="Соглашение об обработке песональных данных LANGAME.RU" />
@endsection @section('content')
<!--SECTION TERMS OF USE PAGE CONTENT START-->
<section class="terms_of_use_content_wrapper">
	<div class="container-fluid">
		 @include('about.user_agreement_text')
	</div>
</section>@endsection
