@php
use App\orders;

    $orders = new orders();

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


    $stat = $m_status_order->StatusOrder();

    $arr_deskripsi_type_order = array();
    $arr_data = array();
    $arr_name = array();
    $arr_month = array();
    $arr_month_val = array();
    
    $no=0;
    $date1_replace  =str_replace("-","",$date1);
    $date2_replace  =str_replace("-","",$date2);


      foreach($data as $i){

        if($jenis_page == "permintaan" ){
          $name = $m_type_order->getTypeOrder($i->id_type_order);
        }else{
          $name = $m_user->getUserFromId($i->id_eksekutor)['user_telegram'];
        }
        

        if($jenis_page == "permintaan" ){
          $id = $i->id_type_order;
        }else{
          $id = $i->id_eksekutor;
        }
        
        if($date1 == ""){
          $data_line= $orders->getChartLine($jenis_page,$id,"","");
        }else{
          $data_line= $orders->getChartLine($jenis_page,$id,$date1_replace,$date2_replace);
        }

        $arr_dot = array();
        foreach($data_line as $in){
          $arr_dot[] = intval($in->close);
          if(!in_array($in->month,$arr_month)){
            $arr_month[] = $in->month;
            $arr_month_val[] = $m_orders->convertDate($in->month);
          }
        }

        $arr_data[] = array("name"=>$name,"data"=>$arr_dot);
        }
    
    
    if(count($arr_month_val) > 0){
      $data_parse_to_js = json_encode($arr_data);
      $data_parse_to_js_month = json_encode($arr_month_val);
    }
    
    // echo $m_orders->convertDate("01"); 
            
@endphp
@extends('admin_template')


{{-- header --}}
@section('header')
    Grafik <?=$jenis_page?>
@endsection
{{-- end header --}}


{{-- menu title --}}
@section('menu_title')
    <li class="breadcrumb-item"><a href="#">Table User</a></li>
@endsection
{{-- end menu title --}}

{{-- content --}}
@section('content')


<label>Entity :</label>
<div class="input-group" style="width: 30%">
    <div class="input-group-prepend">
      <span class="input-group-text">
     
      </span>
    </div>
    <select id="entity" class="form-control float-right"  >
        <option value="eksekutor">Eksekutor</option>
        <option value="permintaan">Permintaan</option>
    </select>
  </div>
  <br/>
  <label>Search Date Start :</label>
  <div class="input-group" style="width: 30%">
      
  <div class="input-group-prepend">
      <span class="input-group-text">
        <i class="far fa-calendar-alt"></i>
      </span>
    </div>
    <input type="date" 
    @if ($date1 != "")
        value = "{{$date1}}"
    @endif
    class="form-control float-right" id="date_start">
  </div>
  <br/>
  <label>Search Date End :</label>
<div class="input-group" style="width: 30%">
    
<div class="input-group-prepend">
    <span class="input-group-text">
      <i class="far fa-calendar-alt"></i>
    </span>
  </div>
  <input type="date" 
  @if ($date2 != "")
        value = "{{$date2}}"
    @endif
  class="form-control float-right" id="date_end">
</div>

<br/>
<button id="filter_line" class="btn btn-primary">Filter</button>
<br/>
<br/>

<div class="row" style="
  overflow-y: scroll;">
    <div class="col-12">
      <div class="card" >
          
<div class="card card-primary card-outline">
    <div class="card-header">
      

<script src='{{asset("bower_components/Highcharts/code/highcharts.js")}}'></script>
<script src='{{asset("bower_components/Highcharts/code/modules/exporting.js")}}'></script>
<script src='{{asset("bower_components/Highcharts/code/modules/export-data.js")}}'></script>
<script src='{{asset("bower_components/Highcharts/code/modules/accessibility.js")}}'></script>

<figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        This chart shows how data labels can be added to the data series. This
        can increase readability and comprehension for small datasets.
    </p>
</figure>

<script type="text/javascript">

<?php 
if(count($arr_month_val) > 0){
?>
var data_in_line = JSON.parse('<?php echo $data_parse_to_js?>')
var data_in_category = JSON.parse('<?php echo $data_parse_to_js_month?>')
<?php
}
?>
    Highcharts.chart('container', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Type Tiket'
        },
        xAxis: {
            
            categories: data_in_category
        },
        yAxis: {
            title: {
                text: 'Tiket'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        series: data_in_line
    });
            </script>
@endsection
{{-- end content --}}



