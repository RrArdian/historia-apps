@extends('layouts.master')

@section('css-content')
<style>
	#map {
		height:300px;
		background:#6699cc;
	}
	#instructions{
	  margin-top: 10px;
	}
	#instructions li{
	  display:none;
	}
</style>
@stop


@section('title')
Peta Cagar Budaya
@stop

@section('url-breadcrumb')
<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-tags"></i> Dashboard</a></li>
<li><a href="{{ url('admin/peta') }}">Peta</a></li>
<li class="active">Peta Cagar Budaya</li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title text-primary">{!! $peta->nama_lokasi !!}</h3>
            </div>
            <div class="box-body">
        	    <p>{!! $peta->deskripsi_lengkap !!}</p>
        	    <p>
        	    	<strong>Alamat :</strong> {!! $peta->alamat !!}, {!! $peta->kecamatan->nama_kecamatan !!}, {!! $peta->kecamatan->kabupaten->nama_kabupaten !!}
        	    </p>
        	    <p><strong>Periodisasi :</strong> {!! $peta->kategori->nama_kategori !!}</p>
        	    <p><strong>Galeri Foto</strong></p>
        	    <div>
        	    	@foreach ($peta->foto as $q)
        	    	<img width="200" src="{{ url('/') }}/{{ $q->url_foto }}" alt="{{ $q->keterangan_foto }}">
        	    	@endforeach
        	    </div>
        	    <p><strong>Lokasi Cagar Budaya</strong></p>
        		<div id="map"></div>
        		<br>
        		<div><p><a href="#" id="start_travel" class="btn btn-sm btn-primary">Tampilkan Rute ke Lokasi</a></p>
        		<ul id="instructions">
          		</ul></div>
                <p>Total jarak : <span id="jarak"></span></p>
                <p>Waktu Tempuh : <span id="waktu"></span></p>
        	</div>
		</div>
	</div>
</div>
@stop

@section('js-content')
<script src="//maps.google.com/maps/api/js?sensor=true"></script>
<script src="{{ asset('assets/js/gmaps.min.js') }}"></script>
<script>
var map, curlat, curlong;
$(document).ready(function(){
    map = new GMaps({
    	div: '#map',
        lat: -7.791615672503019,
        lng: 110.37277221679688,
        zoom: 10
    });
    map.addMarker({
    	lat: {{ $peta->latitude }},
        lng: {{ $peta->longitude }},
        title: 'Peta Cagar Budaya',
        infoWindow: {
        	content: '<p>{{ $peta->nama_lokasi }}</p>'
        }
    });
    GMaps.geolocate({
        success: function(position){
	       	map.addMarker({
	       		lat: position.coords.latitude,
	        	lng: position.coords.longitude,
	       	    title: 'location',
	       	    infoWindow: {
	      	        content: '<p>Lokasi anda</p>'
	        	}
	       	});
	        curlat = position.coords.latitude;
	        curlong = position.coords.longitude;
	    },
	    error: function(error){
	        alert('Geolocation failed: '+error.message);
	    },
	    not_supported: function(){
	       	alert("Your browser does not support geolocation");
	    },
	    always: function(){
            toastr.success('Lokasi anda sudah ditemukan!');
	        //alert("Lokasi anda sudah ditemukan!");
	    }
    });
    $('#start_travel').click(function(e){
        e.preventDefault();
        map.travelRoute({
          	origin: [curlat, curlong],
          	destination: [{{ $peta->latitude }}, {{ $peta->longitude }}],
          	travelMode: 'driving',
          	step: function(e){
            	$('#instructions').append('<li>'+e.instructions+'</li>');
            	$('#instructions li:eq('+e.step_number+')').delay(450*e.step_number).fadeIn(200, function(){
              		map.setCenter(e.end_location.lat(), e.end_location.lng());
              		map.drawPolyline({
                		path: e.path,
                		strokeColor: '#2980b9',
                		strokeOpacity: 0.6,
                		strokeWeight: 6
              		});
            	});
          	}
        });
        map.getRoutes({
        	origin: [curlat, curlong],
          	destination: [{{ $peta->latitude }}, {{ $peta->longitude }}],
        	callback: function (e) {
        	    var time = 0;
        	    var distance = 0;
        	    for (var i=0; i<e[0].legs.length; i++) {
        	        time += e[0].legs[i].duration.value;
        	        distance += e[0].legs[i].distance.value;
        	    }
        	    //alert(time + " " + distance);
        	    var waktu = (time > 3600) ? Math.floor(time / 3600) + ' jam' : Math.floor(time / 3600 * 60) + ' menit';
                var sisa = (time > 3600) ? Math.ceil(((time / 3600) % Math.floor(time / 3600)) * 60) + ' menit' : '';
        	    var jarak = Math.floor(distance / 1000);
                $('#waktu').text(waktu + ' ' + sisa);
                $('#jarak').text(jarak + ' km');
                console.log(time);
        	}
       	});
    });
});
</script>
@stop