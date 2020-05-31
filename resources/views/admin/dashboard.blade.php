@extends('layouts.master')

@section('icon')
<i class="mdi mdi-home menu-icon"></i>
@endsection

@push('css')
@endpush

@section('title')
	<a href="{{url('admin/dashboard')}}" style="color:black; text-decoration:none">Dashboard</a>
@endsection

@section('content')
    <div class="row">
              <div class="col-md-4 stretch-card grid-margin" >
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{url('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h1>{{ $jml_mhs }}</h1>
                    <h4 class="font-weight-normal">Pengguna <i class="mdi mdi-account mdi-24px float-right"></i>
                    </h4>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{url('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h1>{{ $jml_pengajuan }}</h1>
                    <h4 class="font-weight-normal">Pengajuan <i class="mdi mdi-file-multiple mdi-24px float-right"></i>
                    </h4>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="{{url('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image">
                    <h1>{{ $jml_prak }}</h1>
                    <h4 class="font-weight-normal">Praktikum <i class="mdi mdi-book mdi-24px float-right"></i>
                    </h4>
                  </div>
                </div>
              </div>

              <div class="col-md-7 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <div class="clearfix">
                      <h4 class="card-title float-left">Grafik Pengajuan</h4>
                      <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>
                    </div>
                    <canvas id="visit-sale-chart" class="mt-4 chartjs-render-monitor" style="display: block; width: 497px; height: 248px;" width="497" height="248"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <h4 class="card-title">Matakuliah Terfavorit</h4>
                    <canvas id="traffic-chart" width="320" height="160" class="chartjs-render-monitor" style="display: block; width: 320px; height: 160px;"></canvas>
                    <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Pengajuan Hari Ini</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> Nama </th>
                            <th> Matakuliah </th>
                            <th> Kelas </th>
                            <th> SKS </th>
                            <th> Semester </th>
                            <th> Jadwal </th>
                            <th> Status </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                          @foreach ($daftars as $item)
                            <td>
                              <img src="{{ URL::to('/') }}/images/{{ $item['foto'] }}" class="mr-2" alt="image"> {{ $item['pengguna'] }} </td>
                            <td> {{ str_limit($item['nama_matkul'], 15) }} </td>
                            <td> {{ $item['kelas'] }} </td>
                            <td> {{ $item['sks'] }} </td>
                            <td> {{ $item['semester'] }} </td>
                            <td> {{ $item['hari'] }}, {{ $item['jam_mulai'] }}-{{ $item['jam_akhir'] }} </td>
                            <td> @if($item['status'] === "daftar")
                                <label class="badge badge-gradient-warning">Daftar</label>
                                @elseif($item['status'] === "diterima")
                                <label class="badge badge-gradient-success">Diterima</label>
                                @elseif($item['status'] === "ditolak")
                                <label class="badge badge-gradient-danger">Ditolak</label>
                                @endif
                            @endforeach
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
@endsection

@push('js')
<!-- <script src="{{url('assets/js/dashboard.js')}}"></script> -->
<script>
    (function($) {
  'use strict';
  $(function() {

    
    Chart.defaults.global.legend.labels.usePointStyle = true;
    
    if ($("#visit-sale-chart").length) {
      Chart.defaults.global.legend.labels.usePointStyle = true;
      var ctx = document.getElementById('visit-sale-chart').getContext("2d");

      var gradientStrokeViolet = ctx.createLinearGradient(0, 0, 0, 181);
      gradientStrokeViolet.addColorStop(0, 'rgba(218, 140, 255, 1)');
      gradientStrokeViolet.addColorStop(1, 'rgba(154, 85, 255, 1)');
      var gradientLegendViolet = 'linear-gradient(to right, rgba(218, 140, 255, 1), rgba(154, 85, 255, 1))';
    
      var day = [@for($i=1;$i<=$tgl;$i++) '{{$i}}', @endfor];
      var data_click = [{{$grafik}}];
      var bln = <?php echo $bln; ?>;
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: day,
            datasets: [
              {
                label: "Pengajuan Pendaftaran Bulan <?php echo date('M') ?>",
                borderColor: gradientStrokeViolet,
                backgroundColor: gradientStrokeViolet,
                hoverBackgroundColor: gradientStrokeViolet,
                legendColor: gradientLegendViolet,
                pointRadius: 0,
                fill: false,
                borderWidth: 1,
                fill: 'origin',
                data: data_click
              }
          ]
        },
        options: {
          responsive: true,
          legend: false,
          legendCallback: function(chart) {
            var text = []; 
            text.push('<ul>'); 
            for (var i = 0; i < chart.data.datasets.length; i++) { 
                text.push('<li><span class="legend-dots" style="background:' + 
                           chart.data.datasets[i].legendColor + 
                           '"></span>'); 
                if (chart.data.datasets[i].label) { 
                    text.push(chart.data.datasets[i].label); 
                } 
                text.push('</li>'); 
            } 
            text.push('</ul>'); 
            return text.join('');
          },
          scales: {
              yAxes: [{
                  ticks: {
                      display: false,
                      min: 0,
                      stepSize: 20,
                      max: 80
                  },
                  gridLines: {
                    drawBorder: false,
                    color: 'rgba(235,237,242,1)',
                    zeroLineColor: 'rgba(235,237,242,1)'
                  }
              }],
              xAxes: [{
                  gridLines: {
                    display:false,
                    drawBorder: false,
                    color: 'rgba(0,0,0,1)',
                    zeroLineColor: 'rgba(235,237,242,1)'
                  },
                  ticks: {
                      padding: 20,
                      fontColor: "#9c9fa6",
                      autoSkip: true,
                  },
                  categoryPercentage: 0.5,
                  barPercentage: 0.5
              }]
            }
          },
          elements: {
            point: {
              radius: 0
            }
          }
      })
      $("#visit-sale-chart-legend").html(myChart.generateLegend());
    }
    if ($("#traffic-chart").length) {
      var gradientStrokeBlue = ctx.createLinearGradient(0, 0, 0, 181);
      gradientStrokeBlue.addColorStop(0, 'rgba(54, 215, 232, 1)');
      gradientStrokeBlue.addColorStop(1, 'rgba(177, 148, 250, 1)');
      var gradientLegendBlue = 'linear-gradient(to right, rgba(54, 215, 232, 1), rgba(177, 148, 250, 1))';

      var gradientStrokeRed = ctx.createLinearGradient(0, 0, 0, 50);
      gradientStrokeRed.addColorStop(0, 'rgba(255, 191, 150, 1)');
      gradientStrokeRed.addColorStop(1, 'rgba(254, 112, 150, 1)');
      var gradientLegendRed = 'linear-gradient(to right, rgba(255, 191, 150, 1), rgba(254, 112, 150, 1))';

      var gradientStrokeGreen = ctx.createLinearGradient(0, 0, 0, 300);
      gradientStrokeGreen.addColorStop(0, 'rgba(6, 185, 157, 1)');
      gradientStrokeGreen.addColorStop(1, 'rgba(132, 217, 210, 1)');
      var gradientLegendGreen = 'linear-gradient(to right, rgba(6, 185, 157, 1), rgba(132, 217, 210, 1))';      
      var cData = JSON.parse('<?php echo $chart_data; ?>');
      var trafficChartData = { 
        datasets: [{ 
          data: cData.jml.slice(0,3), 
          backgroundColor: [
            gradientStrokeBlue,
            gradientStrokeGreen,
            gradientStrokeRed
          ],
          hoverBackgroundColor: [
            gradientStrokeBlue,
            gradientStrokeGreen,
            gradientStrokeRed
          ],
          borderColor: [
            gradientStrokeBlue,
            gradientStrokeGreen,
            gradientStrokeRed
          ],
          legendColor: [
            gradientLegendBlue,
            gradientLegendGreen,
            gradientLegendRed
          ]
        }],
    
        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: cData.nama.slice(0,3)
      };
      var trafficChartOptions = {
        responsive: true,
        animation: {
          animateScale: true,
          animateRotate: true
        },
        legend: false,
        legendCallback: function(chart) {
          var text = []; 
          text.push('<ul>'); 
          for (var i = 0; i < trafficChartData.datasets[0].data.length; i++) { 
              text.push('<li><span class="legend-dots" style="background:' + 
              trafficChartData.datasets[0].legendColor[i] + 
                          '"></span>'); 
              if (trafficChartData.labels[i]) { 
                  text.push(trafficChartData.labels[i]); 
              }
              text.push('<span class="float-right">'+trafficChartData.datasets[0].data[i]+"%"+'</span>')
              text.push('</li>'); 
          } 
          text.push('</ul>'); 
          return text.join('');
        }
      };
      var trafficChartCanvas = $("#traffic-chart").get(0).getContext("2d");
      var trafficChart = new Chart(trafficChartCanvas, {
        type: 'doughnut',
        data: trafficChartData,
        options: trafficChartOptions
      });
      $("#traffic-chart-legend").html(trafficChart.generateLegend());      
    }
    if ($("#inline-datepicker").length) {
      $('#inline-datepicker').datepicker({
        enableOnReadonly: true,
        todayHighlight: true,
      });
    }
  });
})(jQuery);
</script>
@endpush
