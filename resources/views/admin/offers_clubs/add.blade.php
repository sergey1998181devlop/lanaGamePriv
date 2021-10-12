

@extends('admin.layouts.app')
@section('page')
<?php $page='addOffer';$title="addOffer";$offer=array();?>
<title>размещать пост</title>

<link rel="stylesheet" href="{{ asset('admin/css/write_article.css')}}">
@endsection   
@section('content')
 
	@include('admin.offers_clubs.editor')
@endsection    
