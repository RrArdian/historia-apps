@extends('layouts.master')

@section('css-content')
<style>
    .gmaps {
    height: 300px;
    width: 100%;
}
</style>
@stop

@section('title')
Dashboard Admin
@stop

@section('url-breadcrumb')
<li><a href="{{ url('myadmin/home') }}"><i class="fa fa-tags"></i> Home</a></li>
<li><a href="#">Dashboard</a></li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                Basic
                <span class="tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </span>
            </header>
            <div class="panel-body">
                <div id="gmap_basic" class="gmaps"></div>
            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                Markers
                <span class="tools pull-right">
                  <a href="javascript:;" class="fa fa-chevron-down"></a>
                  <a href="javascript:;" class="fa fa-remove"></a>
              </span>
            </header>
            <div class="panel-body">
                <div id="gmap_marker" class="gmaps"></div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                Geolocation
                <span class="tools pull-right">
                  <a href="javascript:;" class="fa fa-chevron-down"></a>
                  <a href="javascript:;" class="fa fa-remove"></a>
              </span>
            </header>
            <div class="panel-body">
                <div id="gmap_geo" class="gmaps"></div>
            </div>
        </section>
    </div>
    <div class="col-lg-6">
        <section class="panel">
            <header class="panel-heading">
                Polylines
                <span class="tools pull-right">
                  <a href="javascript:;" class="fa fa-chevron-down"></a>
                  <a href="javascript:;" class="fa fa-remove"></a>
              </span>
            </header>
            <div class="panel-body">
                <div id="gmap_polylines" class="gmaps"></div>
            </div>
        </section>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Peta Cagar Budaya</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <form class="form-inline" role="form" id="cari_lokasi">
                    <div class="form-group">
                        <input type="text" id="gmap_geocoding_address" class=" form-control" placeholder="Address..." />
                    </div>
                    <input type="submit" class="btn" value="Search" />
                </form>
                <br>
                <div id="gmap_geocoding" class="gmaps"></div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js-content')
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="{{ asset('assets/js/gmaps.min.js') }}"></script>
<script src="{{ asset('assets/js/gmaps-scripts.js') }}"></script>
<script>
jQuery(document).ready(function() {
  GoogleMaps.init();
});
</script>
@stop