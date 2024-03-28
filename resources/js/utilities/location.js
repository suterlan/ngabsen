import L from "leaflet";

export default function Location(){
  
  const successCallback = async (position) => {
    // console.log(position);
    let lokasi = document.getElementById('location');
    lokasi.value = await position.coords.latitude + ',' + position.coords.longitude;

    let map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 17);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // set marker
    let marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);

    let circle = L.circle([-6.920715092599272, 107.61023226322612], {
        color: 'red',
        fillColor: '#66ff66',
        fillOpacity: 0.5,
        radius: 50 //radius satuan meter
    }).addTo(map);
  };
  
  const errorCallback = async (error) => {
    console.log(await error);
  };

  const options = {
    enableHighAccuracy: true,
  };

  if (Geolocation = navigator.geolocation) {
    Geolocation.getCurrentPosition(successCallback, errorCallback, options)
  } else {
    console.log('Ups, browser anda tidak mendukung Geolocation');
  }

};