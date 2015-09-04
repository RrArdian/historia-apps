@extends('layouts.master')

@section('css-content')
<style>
	#map {
		height:300px;
		background:#6699cc;
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
				<p>{!! $peta->deskripsi_singkat !!}</p>
        	    <p>{!! $peta->deskripsi_lengkap !!}</p>
        	    <p>
        	    	<strong>Alamat :</strong> {!! $peta->alamat !!}, {!! $peta->kecamatan->nama_kecamatan !!}, {!! $peta->kecamatan->kabupaten->nama_kabupaten !!}
        	    </p>
        	    <p><strong>Periodisasi :</strong> {!! $peta->kategori->nama_kategori !!}</p>
        	    <p><strong>Lokasi Cagar Budaya</strong></p>
        		<div id="map"></div>
        	</div>
		</div>
	</div>
</div>
@stop