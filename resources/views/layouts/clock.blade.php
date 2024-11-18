<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.css_js.metaCharset')
        @yield('extra-css')
        @include('layouts.css_js.cssadmin')
        <meta charset="utf-8">
        <title>Digital Clock With Date</title>
        <link rel="stylesheet" href="{{asset('assets/css/style2.css')}}">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" crossorigin="" />

        style{
            .float-child {
            width: 50%;
            float: left;
            padding: 20px;
         }  
        }
    </head>
    <body onload="initClock()" class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="" l>
        @include('layouts.admins-head-menu-footer.header')
        @include('layouts.admins-head-menu-footer.mainmenu')
        @include('layouts.crudDiv.clockdiv')
        <div class="table-title">
        <div class="row">
            <div class="col-sm-8"><h2><b>{{$title}}</b>&nbsp;Form</h2></div>
        </div>
    </div><hr>
        <!--digital clock start-->
        <div class="datetime" >
          <div class="date">
            <span id="dayname">Day</span>,
            <span id="month">Month</span>
            <span id="daynum">00</span>,
            <span id="year">Year</span>
          </div>
          <div class="time">
            <span id="hour">00</span>:
            <span id="minutes">00</span>:
            <span id="seconds">00</span>
            <span style ='margin-left: -9px;' id="period">AM</span>
          </div>
        </div><hr>
        <!--digital clock end-->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- <p>Click the button to get your coordinates.</p> -->
        <!-- <button type="submit" onclick="getLocation()" class="btn btn-outline-primary waves-effect">Get Your Location</button><br> -->

        <p id="demo"></p>

        <form action="{{ route('clocks.insert') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <form role="form" class="wowload fadeInRight">
            <div class="float-container">
                <!-- <div id="container" > -->
                    <!-- <div class="row"> -->
                        <div class="float-child" id="map" style="width:50%; height:280px; float: left; padding: 20px;"></div>
                <!-- </div>' -->

                <div class="float-child" style="width:50%; float: left; padding: 20px;">
                    <div>
                        <label style="font-weight:bold;text-decoration:underline">Click Here To Upload Or Capture Photo</label>
                        <span style="width: 2.5rem"></span>
                        <input type="file" name="photo_in" accept="image/*" capture="camera" id="cam"/>
                    </div><br>
                    <div class="col-sm-12">
                        <textarea class="form-control" name="reasonLate_in"  style="height:150px;" placeholder="Reason Late and Out"></textarea>
                    </div><br>
                </div>
            </div>
              <div class="form-group">
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <input type="hidden" id="latitude_in" name="latitude_in" value="">
              <input type="hidden" id="longitude_in" name="longitude_in" value="">

              <input type="hidden" id="location_in" name="location_in" value="">
              
              </div><br>
              
              <input type="hidden" name="attendance_id" value="{{ $id }}">
              <div class="clockinout d-grid col-md-12 text-center mb-2">
                  @if($type == 0)
                    <br><button class="btnclock timein active btn-primary waves-effect waves-float waves-light" name="clock" value="0" data-type="timein">Clock In</button>
                  @else
                  <br><button class="btnclock timeout active btn-primary waves-effect waves-float waves-light" name="clock" value="1" data-type="timeout">Clock Out</button>
                  @endif
              </div>
              </div>
              </form>
        </form>

        <input type="hidden" class="token" value="{{ csrf_token() }}">
        @include('layouts.admins-head-menu-footer.footer')
        @include('layouts.css_js.jsadmin')
        @yield('extraJS')

        <script src="{{asset('admin-assets/js/scripts/ui/ui-feather.js')}}"></script>
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" crossorigin=""></script>
        <script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>
        <script src="https://unpkg.com/esri-leaflet-vector@4.0.0/dist/esri-leaflet-vector.js"></script>
        <script src="https://unpkg.com/esri-leaflet-geocoder@3.1.3/dist/esri-leaflet-geocoder.js"></script>
        <script src="{{asset('assets/js/script2.js')}}"></script>
        <script>
            $(window).on("load", function () {
                if (feather) {
                    feather.replace({
                        width: 14,
                        height: 14,
                    });
                }
            });

            
        </script>
    </body>
</html>
