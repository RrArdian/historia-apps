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
<li class="active">Ubah Peta Cagar Budaya</li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Ubah Peta Cagar Budaya</h3>
			</div>
			<div class="box-body">
				<div class="col-sm-12">
					<form method="POST" action="{{ url('admin/peta/ubah') }}/{{ $peta->id }}" accept-charset="UTF-8" class="form-horizontal panel"><input name="_token" type="hidden" value="{{ csrf_token() }}">
						<input type="hidden" name="_method" value="PUT">	
						<div class="form-group">
							<label for="title" class="control-label">Nama Cagar Budaya</label>
							<input class="form-control" name="nama" type="text" value="{!! $peta->nama_lokasi !!}" required>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Kategori</label>
							<select name="kategori" class="form-control" required>
								<option value="{!! $peta->kategori->id !!}">{!! $peta->kategori->nama_kategori !!}</option>
								@foreach($kategori as $cat => $c)
								<option value="{!! $c->id !!}">{!! $c->nama_kategori !!}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Deskripsi Singkat</label>
							<textarea class="form-control" name="singkat" cols="25" rows="5" required>{!! $peta->deskripsi_singkat !!}</textarea>	
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Deskripsi Lengkap</label>
							<textarea class="form-control" name="lengkap" cols="25" rows="5" required>{!! $peta->deskripsi_lengkap !!}</textarea>	
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Kabupaten</label>
							<select name="kabupaten" id="kabupaten" class="form-control" required>
								<option value="{!! $peta->kecamatan->kabupaten->id !!}">{!! $peta->kecamatan->kabupaten->nama_kabupaten !!}</option>
								@foreach($kabupaten as $cat => $c)
								<option value="{!! $c->id !!}">{!! $c->nama_kabupaten !!}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Kecamatan</label>
							<select name="kecamatan" id="kecamatan" class="form-control" required>
								<option value="{!! $peta->kecamatan->id !!}">{!! $peta->kecamatan->nama_kecamatan !!}</option>
							</select>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Alamat</label>
							<input type="text" name="alamat" class="form-control" value="{!! $peta->alamat !!}" required>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Latitude</label>
							<input type="text" id="latitude" name="latitude" class="form-control" value="{!! $peta->latitude !!}" required>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Longitude</label>
							<input type="text" id="longitude" name="longitude" class="form-control" value="{!! $peta->longitude !!}" required>
						</div>
						<div class="form-group">
							<small class="text-danger"><sup>*</sup>) Klik pada peta untuk menambah koordinat</small>
							<div id="map"></div>
						</div>
						<div class="form-group">
							<button class="btn btn-primary btn-md" type="submit"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('js-content')
<script src="//maps.google.com/maps/api/js?sensor=true"></script>
<script src="{{ asset('assets/js/gmaps.min.js') }}"></script>
<script src="{{ asset('assets/js/maps-script.min.js') }}"></script>
<script>
@if($errors->has())
	toastr.error('Terjadi kesalahan. Silakan ulangi lagi!')
	@foreach($errors->all() as $error)
		toastr.error('{{ $error }}');
	@endforeach
@elseif(\Session::has('message'))
	toastr.success("{{ \Session::get('message') }}")
@endif
$(document).ready(function() {
    $("#kabupaten").change(function() {
        $.getJSON("{{ url('admin/cari-kecamatan/') }}/" + $("#kabupaten").val(), function(data) {
            var $kecamatan = $("#kecamatan");
            $kecamatan.empty();
            $.each(data, function(index, value) {
                $kecamatan.append('<option value="' + index +'">' + value + '</option>');
            });
        $("#kecamatan").trigger("change");
        	/* trigger next drop down list not in the example */
        });
    });
});
</script>
@stop