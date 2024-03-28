import L from "leaflet";
import { GeoSearchControl, OpenStreetMapProvider } from "leaflet-geosearch";

export default function MapSearch(){
  
  const success = async (position) => {

    let myMap = await new L.Map('mapsearch').setView([position.coords.latitude, position.coords.longitude], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(myMap);

    const provider = new OpenStreetMapProvider();

    const searchControl = new GeoSearchControl({
      provider: provider,
      notFoundMessage: 'Sorry, that address could not be found.',
      style: 'bar',
      // popupFormat: ({ query, result }) => result.label, // optional: function    - default returns result label,
      // resultFormat: ({ result }) => result.label, 
    });

    myMap.addControl(searchControl);

    // tampilkan result ke input text
    myMap.on('geosearch/showlocation', function(e){
      let latlong = document.getElementById('latlong');
      let officeLocation = document.getElementById('office_location');
      
      latlong.value = e.location.y + ', ' + e.location.x;
      officeLocation.value = e.location.y + ', ' + e.location.x;
      // console.log(e.location);
    });
  } 

  const errorCallback = async (error) => {
    console.log(await error);
  };

  const options = {
    enableHighAccuracy: true,
  };

  if (Geolocation = navigator.geolocation) {
    Geolocation.getCurrentPosition(success, errorCallback, options)
  } else {
    console.log('Ups, browser anda tidak mendukung Geolocation');
  }
}; 