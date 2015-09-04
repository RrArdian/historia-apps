@extends('layouts.master')

@section('css-content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('title')
Kategori Cagar Budaya
@stop

@section('url-breadcrumb')
<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-tags"></i> Dashboard</a></li>
<li><a href="{{ url('admin/kategori') }}">Data Kategori</a></li>
<li><a href="#">Kategori Cagar Budaya</a></li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Kategori Cagar Budaya {{ $kategori->nama_kategori }}</h3>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Alamat</th>
							<th>Kecamatan</th>
							<th>Kabupaten</th>
							<th>Detail</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($kategori->peta as $val => $d)
						<tr>
							<td>{!! $val+1 !!}</td>
							<td>{!! $d->nama_lokasi !!}</td>
							<td>{!! $d->alamat !!}</td>
							<td>{!! $d->kecamatan->nama_kecamatan !!}</td>
							<td>{!! $d->kecamatan->kabupaten->nama_kabupaten !!}</td>
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