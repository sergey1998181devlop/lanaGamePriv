

@extends('admin.layouts.app')
@section('page')
<?php $page='addnew';$title="addnew";$post=array();?>
<title>размещать пост</title>

<link rel="stylesheet" href="{{ asset('admin/css/write_article.css')}}">
@endsection   
@section('content')
 
	@include('admin.posts.editor')
@endsection    
