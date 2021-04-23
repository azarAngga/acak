<?php
use App\orders;

$m_orders = new orders();

$design_tiket = $m_orders->table(1,1,1,null,null); 
$assign_tiket = $m_orders->table(2,1,1,null,null); 
$konstruksi_tiket = $m_orders->table(3,1,1,null,null); 
$golive_tiket = $m_orders->table(4,1,1,null,null); 

$data_point = $m_orders->getPoint();
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


<div class="col-md-12">
    <div class="panel">
       
        <div class="panel-body">
          <h4>Performansi </h4>
          <hr/>
          <table class="table table-hover text-nowrap" >
           <thead>
             <tr>
               <th>NO</th>
               <th >MITRA</th>
               <th >POINT PRODUKTIF</th>
             </tr>
           </thead>
           <tbody>
            @foreach ($data_point as $index => $i)
            
                <tr>
                    <td>
                        {{$index+1}}
                    </td>
                        <td><a href="#" id="open_row_{{$i['id']}}" class="open_row">{{$i["nama_mitra"]}}</a></td>
                    
                    <td>
                        {{$i['point']}}
                    </td>
                </tr>
                <tr>
                    <td colspan="3"   id="subrow_{{$i['id']}}" class="subrow"  style="background:#008000;display:none">
                      <table class="table_expand table table-hover text-nowrap">
                        <thead>
                          <tr>
                            <th>Nama Mitra</th>
                            <th>Alamat</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td>{{$i['nama_mitra']}}</a></td>
                              <td>{{$i["alamat"]}}</td>
                            </tr>  
                            
                        </tbody>
                      </table>
                    </td>
                </tr>

            @endforeach
           </tbody>
          </table>
        </div>
    </div>
  </div>
  <!-- /.col-md-6 -->
  
@endsection
{{-- end content --}}

