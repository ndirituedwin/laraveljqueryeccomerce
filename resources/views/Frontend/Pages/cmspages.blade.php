<?php
use App\Models\Product;
?>
@extends('Frontend.frontendlayout.frontendmainlayout')
@section('content')
<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">{{ $cmspagesdetails['title'] }}</li>
    </ul>
	<h3>{{ $cmspagesdetails['title'] }}</h3>
	<hr class="soft"/>
	<p>
        {{ $cmspagesdetails['description'] }}
    </p>


</div>
@endsection
