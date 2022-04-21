

@extends('admin.layouts.app')
@section('page')
<?php $page='addEmail';$title="addEmail";$email=array();?>
<title>добавить Email</title>

<link rel="stylesheet" href="{{ asset('admin/css/write_article.css')}}">
@endsection   
@section('content')
 
	@include('admin.emails.editor')
@endsection    
