function updateClock(){
  var now = new Date();
  var dname = now.getDay(),
      mo = now.getMonth(),
      dnum = now.getDate(),
      yr = now.getFullYear(),
      hou = now.getHours(),
      min = now.getMinutes(),
      sec = now.getSeconds(),
      pe = "AM";

      if(hou >= 12){
        pe = "PM";
      }
      if(hou == 0){
        hou = 12;
      }
      if(hou > 12){
        hou = hou - 12;
      }

      Number.prototype.pad = function(digits){
        for(var n = this.toString(); n.length < digits; n = 0 + n);
        return n;
      }

      var months = ["January", "February", "March", "April", "May", "June", "July", "Augest", "September", "October", "November", "December"];
      var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
      var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
      for(var i = 0; i < ids.length; i++)
      document.getElementById(ids[i]).firstChild.nodeValue = values[i];
}

function initClock(){
  updateClock();
  window.setInterval("updateClock()", 1);
}

var x = document.getElementById("demo");

// function getLocation() {
//   if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(showPosition);
//   } else {
//     x.innerHTML = "Geolocation is not supported by this browser.";
//   }
// }

const apiKey = "AAPK20956aef3c0d4f2e86fa91b12abc2c47bHl72mxfujxsrsI1nofT2NR0pBh47muxPrsCrwR_-n-15CgykbZZ9YgEGUn8uCQu";

const basemapEnum = "ArcGIS:Navigation";

const map = L.map("map", {
  minZoom: 2,
  scrollWheelZoom: false,
  zoomControl: false
})

map.dragging.disable();

map.setView([3.140853, 101.693207], 12); // Kuala Lumpur

L.esri.Vector.vectorBasemapLayer(basemapEnum, {
  apiKey: apiKey
}).addTo(map);

const layerGroup = L.layerGroup().addTo(map);

function showPosition(position) {
  $('#latitude_in').val(position.coords.latitude);
  $('#longitude_in').val(position.coords.longitude);

  const marker1 = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);

  $.get("https://nominatim.openstreetmap.org/reverse?lat="+ position.coords.latitude +"&lon="+ position.coords.longitude +"&format=json",
  function(data, status){
    console.log(data);
    $('#location_in').val(data.display_name);

    marker = L.marker({
      lat: position.coords.latitude,
      lng: position.coords.longitude,
    }).addTo(layerGroup);

    marker.bindPopup(`<p>${data.display_name}</p>`);
    marker.openPopup();
 });
}

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors' }).addTo(map);
