@extends('layouts.master')

@section('css-content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('title')
Daftar Kecamatan
@stop

@section('url-breadcrumb')
<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-tags"></i> Dashboard</a></li>
<li><a href="{{ url('admin/lokasi') }}">Data Lokasi</a></li>
<li><a href="#">Daftar Kecamatan</a></li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Daftar Kecamatan {{ ($lokasi->nama_kabupaten != 'Yogyakarta') ? 'Kabupaten' : 'Kota' }} {{ $lokasi->nama_kabupaten }}</h3>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Kecamatan</th>
							<th>Data Cagar Budaya</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($lokasi->kecamatan as $val => $d)
						<tr>
							<td>{!! $val+1 !!}</td>
							<td>{!! $d->nama_kecamatan !!}</td>
							<td><a href="{{ url('admin/lokasi/kecamatan') }}/{{ $d->slug_nama }}">Daftar Cagar Budaya</a></td>
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