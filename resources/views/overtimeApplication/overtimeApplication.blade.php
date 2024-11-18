@extends('layouts.app')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
<link rel="stylesheet" href=
"https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin="" />

    <link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">


@section('extra-css')
    @include('layouts.css_js.DDSearch.css')
    @include('layouts.css_js.templateDate.css')
@endsection
@section('content')
    @include('layouts.crudDiv.attendancediv')
    <div class="table-title">
        <div class="row">
            <div class="col-sm-8"><h2><b>{{$title}}</b>&nbsp;Form</h2></div>
        </div>
    </div>
    <div class="col-sm-4">
            <a href="{{route('overtime.index',['id'=>Auth::user()->id])}}" class="btn btn-primary" id="overtime">
            Overtime List (OT)</a>
    </div><hr>

    <p id="demo"></p>

    <form action="/createOvertimeApp" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div id="story" class="card story">

        @foreach ($user as $s)
        <input type="hidden" name="user_id" class="form-control" value="{{$s->id}}">
        @endforeach

            <div class="row">
            <div class="row mt-2">
                <div class="col-sm-5 col-12 mb-1 mb-sm-0">
                    <label style="margin-bottom: 0.25em"><strong>Overtime Date</strong></label>
                    <input type="text" id="date" name="date" class="bg-white form-control flatpickr-basic" placeholder="Overtime Date (D-M-Y)" required>
                    <strong id="startError" class="col-form-label text-danger" style="display: none">Overtime date.</strong>
                </div>
                <div class="col-sm-3 col-12 mb-1 mb-sm-0">
                    <label style="margin-bottom: 0.25em"><strong>Expected Time In</strong></label>
                    <input type="text" id="time_in" name="time_in" class="form-control" placeholder="24 hours (00:00:00)">
                </div>
                <div class="col-sm-3 col-12 mb-1 mb-sm-0">
                    <label style="margin-bottom: 0.25em"><strong>Expected Time Out</strong></label>
                    <input type="text" id="time_out" name="time_out" class="form-control" placeholder="24 hours (00:00:00)" readonly><br>
                </div>
                <div class="col-sm-14 col-12 mb-1 mb-sm-0">
                    <label style="margin-bottom: 0.25em"><strong>Location</strong></label>
                    <input type="text" id="location" name="location" class="form-control" placeholder="Search on the map" readonly>
                    <input type="hidden" id="latitude" name="latitude" value="">
                    <input type="hidden" id="longitude" name="longitude" value=""><br>
                </div>
            </div>
    </div>
    </form>
    <div id="map" style="width: 100%; height: 400px"></div><br>
    <div class="d-grid col-md-12 text-center mb-2">
        <button type="submit" id="post_ot" class="btn btn-primary waves-effect waves-float waves-light">Apply Overtime</button>
    </div>
    @include('layouts.crudDiv.endmainCrud')
@endsection
@section('extraJS')
    @include('layouts.css_js.DDsearch.js')
    @include('layouts.css_js.templateDate.js')
    
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{asset('admin-assets/js/scripts/ui/ui-feather.js')}}"></script>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
    <script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>
    <script src="https://unpkg.com/esri-leaflet-vector@4.0.0/dist/esri-leaflet-vector.js"></script>
    <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.js"></script>
     <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
    crossorigin=""></script>
    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
    <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
    
    <script src={{ asset('custom_js/locationMap.js') }}></script>
@endsection