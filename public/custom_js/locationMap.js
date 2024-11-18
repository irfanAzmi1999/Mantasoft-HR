var x = document.getElementById("demo");

const apiKey = "AAPK20956aef3c0d4f2e86fa91b12abc2c47bHl72mxfujxsrsI1nofT2NR0pBh47muxPrsCrwR_-n-15CgykbZZ9YgEGUn8uCQu";

const map = L.map('map', {
    center: [51.517327, -0.120005],
    zoom: 5.5,
    scrollWheelZoom: false,
    zoomControl: false
  }); 

map.dragging.disable();

map.locate({setView: true, maxZoom: 16});
//map.setView([3.140853, 101.693207], 12);

L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.control.scale().addTo(map);

var searchControl = new L.esri.Controls.Geosearch().addTo(map);

const results = new L.LayerGroup().addTo(map);

searchControl.on('results', function(data){
  results.clearLayers();
  for (var i = data.results.length - 1; i >= 0; i--) {
    results.addLayer(L.marker(data.results[i].latlng));
    getSearchAddress(data.results[i].latlng);
  }
});

 function getSearchAddress(latlng){
  $('#latitude').val(latlng.lat);
  $('#longitude').val(latlng.lng);

  $.get("https://nominatim.openstreetmap.org/reverse?lat="+ latlng.lat+ "&lon=" + latlng.lng + "&format=json",
  function(data, status){
    $('#location').val(data.display_name);
  });
 }

$(document).on("click", "#post_ot", function () {
  var date = $("#date").val();
  var time_in = $("#time_in").val();
  var time_out = $("#time_out").val();
  var longitude = $("#longitude").val();
  var latitude = $("#latitude").val();
  var location = $("#location").val();

  if (date == "" || typeof date == undefined) {
      $("#date").focus();
      $("#startError").attr("style", "display: unset");
      return false;
  } else {
      $("#date").blur();
      $("#startError").attr("style", "display: none");
  }
  if (time_in < "18:00:00" || typeof time_in == undefined) {
      $("#time_in").focus();
      $("#endError").attr("style", "display: unset");
      alert("The Overtime starts at and after 18:00:00.")
      return false;
  } else {
      $("#time_in").blur();
      $("#endError").attr("style", "display: none");
  }
  if (location == "" || typeof location == undefined) {
      $("#location").focus();
      $("#endError").attr("style", "display: unset");
      return false;
  } else {
      $("#location").blur();
      $("#endError").attr("style", "display: none");
  }

});
