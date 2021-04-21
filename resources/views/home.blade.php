<?php
use App\orders;

$m_orders = new orders();

$design_tiket = $m_orders->table(1,1,1,null,null); 
$assign_tiket = $m_orders->table(2,1,1,null,null); 
$konstruksi_tiket = $m_orders->table(3,1,1,null,null); 
$golive_tiket = $m_orders->table(4,1,1,null,null); 
?>
@extends('admin_template')


{{-- header --}}
@section('header')
    Home
@endsection
{{-- end header --}}


{{-- menu title --}}
@section('menu_title')

    <li class="breadcrumb-item"><a href="#">Home</a></li>
@endsection
{{-- end menu title --}}

{{-- content --}}
@section('content')

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a class="dashboard-stat bg-primary" href="#">
        <span class="number counter">{{count($design_tiket)}}</span>
        <span class="name">DESIGN</span>
        <span class="bg-icon"><i class="fa fa-comments"></i></span>
    </a>
    <!-- /.dashboard-stat -->

    
</div>
<!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a class="dashboard-stat bg-danger" href="#">
        <span class="number counter">{{count($assign_tiket)}}</span>
        <span class="name">ASSIGN</span>
        <span class="bg-icon"><i class="fa fa-ticket"></i></span>
    </a>
    <!-- /.dashboard-stat -->

    
</div>
<!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a class="dashboard-stat bg-warning" href="#">
        <span class="number counter">{{count($konstruksi_tiket)}}</span>
        <span class="name">CONSTRUKSI</span>
        <span class="bg-icon"><i class="fa fa-bank"></i></span>
    </a>
    <!-- /.dashboard-stat -->

    
</div>
<!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <a class="dashboard-stat bg-success" href="#">
        <span class="number counter">{{count($golive_tiket)}}</span>
        <span class="name">GO LIVE</span>
        <span class="bg-icon"><i class="fa fa-thumbs-o-up"></i></span>
    </a>
    <!-- /.dashboard-stat -->

    
</div>
<!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

    
@endsection
{{-- end content --}}

