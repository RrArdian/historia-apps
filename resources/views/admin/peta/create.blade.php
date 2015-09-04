@extends('layouts.master')

@section('css-content')
<link rel="stylesheet" href="{{ asset('assets/plugins/dropzone/dropzone.min.css') }}">
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
<li class="active">Tambah Peta Cagar Budaya</li>
@stop

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Tambah Peta Cagar Budaya</h3>
			</div>
			<div class="box-body">
				<div class="col-sm-12">
					<form method="POST" action="{{ url('admin/peta/tambah') }}" accept-charset="UTF-8" class="form-horizontal panel"><input name="_token" type="hidden" value="{{ csrf_token() }}">	
						<div class="form-group">
							<label for="title" class="control-label">Nama Cagar Budaya</label>
							<input class="form-control" name="nama" type="text" required>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Kategori</label>
							<select name="kategori" class="form-control" required>
								<option>-- Pilih Kategori --</option>
								@foreach($kategori as $cat => $c)
								<option value="{!! $c->id !!}">{!! $c->nama_kategori !!}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Deskripsi Singkat</label>
							<textarea class="form-control" name="singkat" cols="25" rows="5" id="content" required></textarea>	
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Deskripsi Lengkap</label>
							<textarea class="form-control" name="lengkap" cols="25" rows="5" id="content" required></textarea>	
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Kabupaten</label>
							<select name="kabupaten" id="kabupaten" class="form-control" required>
								<option>-- Pilih Kabupaten --</option>
								@foreach($kabupaten as $cat => $c)
								<option value="{!! $c->id !!}">{!! $c->nama_kabupaten !!}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Kecamatan</label>
							<select name="kecamatan" id="kecamatan" class="form-control" required>
								<option>-- Pilih Kecamatan --</option>
							</select>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Alamat</label>
							<input type="text" name="alamat" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Latitude</label>
							<input type="text" id="latitude" name="latitude" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="content" class="control-label">Longitude</label>
							<input type="text" id="longitude" name="longitude" class="form-control" required>
						</div>
						<div class="form-group">
							<small class="text-danger"><sup>*</sup>) Klik pada peta untuk menambah koordinat</small>
							<div id="map"></div>
						</div>
						<div class="form-group">
							<label for="photos">Foto</label>
							<div class="dropzone" id="dropzoneFileUpload"></div>
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
<script src="{{ asset('assets/plugins/dropzone/dropzone.min.js') }}"></script>
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
var baseUrl = "{{ url('/') }}";
var token = "{{ \Session::getToken() }}";
Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("div#dropzoneFileUpload", {
    url: baseUrl+"/admin/foto/upload",
    //autoProcessQueue: false,
    dictDefaultMessage: 'Tarik file foto ke sini atau sentuh untuk mengunggah foto',
    addRemoveLinks: true,
    maxFiles: 3,
    dictRemoveFile: 'Hapus foto',
    autoProcessQueue: false,
    params: {
       _token: token
    }
});
 Dropzone.options.myAwesomeDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    accept: function(file, done) {
    	var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    },
    init: function() {
      	var submitButton = document.querySelector("#submit-all")
      	myDropzone = this; // closure

      	submitButton.addEventListener("click", function() {
        	myDropzone.processQueue(); // Tell Dropzone to process all queued files.
      	});

      	// You might want to show the submit button only when 
      	// files are dropped here:
      	this.on("addedfile", function() {
        // Show submit button here and/or inform user to click it.
      	});
    }
};
</script>
@stop