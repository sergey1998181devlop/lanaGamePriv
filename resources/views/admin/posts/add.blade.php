

@extends('admin.layouts.app')
@section('page')
<?php $page='addPost';$title="addPost";$post=array();?>
<title>размещать пост</title>

<link rel="stylesheet" href="{{ asset('admin/css/write_article.css')}}">
@endsection   
@section('content')
 
	@include('admin.posts.editor')
@endsection    
