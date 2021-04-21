@php

     function getTime($date1){
      $open_date = $date1;

      $date =  Date('Y-m-d h:i:s');
      $start_date = new DateTime($open_date);

      $since_start = $start_date->diff(new DateTime($date));
      

      $minutes = $since_start->days * 24 * 60;
      $minutes += $since_start->h * 60;
      $minutes += $since_start->i;

        return $minutes;
    }


    function textLong($text){

      if(strlen($text) > 50){
        $text = substr($text,0,50);
        $text =  $text.".....";
      }
      //echo substr("Hello world",6);


      return $text;
    }
@endphp
@extends('admin_template')


{{-- header --}}
@section('header')
    Report
@endsection
{{-- end header --}}


{{-- menu title --}}
@section('menu_title')
    <li class="breadcrumb-item"><a href="#">Table User</a></li>
@endsection
{{-- end menu title --}}

{{-- content --}}
@section('content')

<div class="row" style="
  overflow-y: scroll;">
    <div class="col-12">
      <div class="card" >
        
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0 frame" style="
      
  width: 100%;
  height: 600px;
  overflow-x: scroll;">
          
<div class="card card-primary card-outline">
    <div class="card-header">
      <h3 class="card-title">
        <i class="far fa-chart-bar"></i>
        Line Chart
      </h3>

      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    <div class="card-body">
      <div id="line-chart" style="height: 300px;"></div>
    </div>
    <!-- /.card-body-->
  </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
  
@endsection
{{-- end content --}}



