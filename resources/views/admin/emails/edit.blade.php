
@extends('admin.layouts.app')
@section('page')
<?php $page="editemail" ;?>
<title>изменить Email</title>
<link rel="stylesheet" href="{{ asset('admin/css/write_article.css')}}">
@endsection

@section('content')
	@include('admin.emails.editor')
@endsection  

