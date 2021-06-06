
@extends('admin.layouts.app')
@section('page')
<?php $page="editpost" ;?>
<title>изменить публикаций</title>
<link rel="stylesheet" href="{{ asset('admin/css/write_article.css')}}">
@endsection

@section('content')
	@include('admin.posts.editor')
@endsection  

