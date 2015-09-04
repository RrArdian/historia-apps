@extends('layouts.master')

@section('css-content')
<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.css') }}">
@stop

@section('title')
Peta Cagar Budaya
@stop

@section('url-breadcrumb')
<li><a href="{{ url('admin/dashboard') }}"><i class="fa fa-tags"></i> Dashboard</a></li>
<li><a href="#">Peta Cagar Budaya</a></li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Data Peta Cagar Budaya</h3>
				<a href="{{ url('admin/peta/tambah') }}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Data Peta</a>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Kategori</th>
							<th>Alamat</th>
							<th>Kecamatan</th>
							<th>Kabupaten</th>
							<th>Detail</th>
							<th>Ubah</th>
							<th>Hapus</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($peta as $val => $d)
						<tr>
							<td>{!! $val+1 !!}</td>
							<td>{!! $d->nama_lokasi !!}</td>
							<td>{!! $d->kategori->nama_kategori !!}</td>
							<td>{!! $d->alamat !!}</td>
							<td>{!! $d->kecamatan->nama_kecamatan !!}</td>
							<td>{!! $d->kecamatan->kabupaten->nama_kabupaten !!}</td>
							<td>
								<a href="{{ url('admin/peta') }}/{{ $d->slug_nama }}"><i class="fa fa-angle-double-right"></i> Selengkapnya</a>
							</td>
							<td><a href="{{ url('admin/peta/ubah') }}/{{ $d->slug_nama }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
							<td>
								<form action="{{ url('admin/peta/hapus') }}/{{ $d->id }}" method="POST">
									<input type="hidden" name="_method" value="DELETE">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<button type="button" class="btn btn-danger btn-sm hapus"><i class="fa fa-trash"></i> Hapus</button>
								</form>
							</td>
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
@if($errors->has())
	toastr.error('Terjadi kesalahan. Silakan ulangi lagi!')
	@foreach($errors->all() as $error)
		toastr.error('{{ $error }}');
	@endforeach
@elseif(\Session::has('message'))
	toastr.success("{{ \Session::get('message') }}")
@endif
$('#example1').dataTable();
$('.hapus').click(function() {
	bootbox.confirm("Apakah anda yakin akan menghapus berita ini?", function(result){
		if (result) {
			toastr.options.timeOut = 0;
			toastr.options.extendedTimeOut = 0;
			toastr.info('<i class="fa fa-spinner fa-spin"></i><br>Sedang menghapus...');
			toastr.options.timeOut = 5000;
			toastr.options.extendedTimeOut = 1000;
			$('form').submit();
		}
	});
});
</script>
@stop