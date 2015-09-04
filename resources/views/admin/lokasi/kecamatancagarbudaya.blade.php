@extends('layouts.master')

@section('css-content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('title')
Daftar Cagar Budaya Kecamatan
@stop

@section('url-breadcrumb')
<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-tags"></i> Dashboard</a></li>
<li><a href="{{ url('admin/lokasi') }}">Data Lokasi</a></li>
<li><a href="{{ url('admin/lokasi') }}/{{ $lokasi->kabupaten->slug_nama }}">Daftar Kecamatan</a></li>
<li><a href="#">Daftar Cagar Budaya Kecamatan</a></li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Daftar Cagar Budaya Kecamatan {{ $lokasi->nama_kecamatan }}</h3>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Kategori</th>
							<th>Alamat</th>
							<th>Detail</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($lokasi->peta as $val => $d)
						<tr>
							<td>{!! $val+1 !!}</td>
							<td>{!! $d->nama_lokasi !!}</td>
							<td>{!! $d->kategori->nama_kategori !!}</td>
							<td>{!! $d->alamat !!}</td>
							<td><a href="{{ url('admin/peta') }}/{{ $d->slug_nama }}"><i class="fa fa-angle-double-right"></i> Selengkapnya</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop

@section('js-content')
<script src="{{ asset('/assets/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
<script>
$('#example1').dataTable();
</script>
@stop