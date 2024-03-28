import './bootstrap';

import Alpine from 'alpinejs';

import sidemenu from './utilities/sidemenu.js';
import multiselect from './utilities/multiselect.js';
import persist from '@alpinejs/persist';
import showImage from './utilities/show-image.js';
import camera from './utilities/camera.js';
import Location from './utilities/location.js';
import MapSearch from './utilities/map-search.js';

window.Alpine = Alpine;

Alpine.data('sidemenu', sidemenu);
Alpine.data('multiselect', multiselect);

Alpine.plugin(persist);

Alpine.data('showImage', showImage);

// jalankan fungsi camera yang diimport dari utils camera.js 
Alpine.data('camera', camera);
//end 

// Jalankan fungsi lokasi dari import utils location.js
Alpine.data('location', () => ({
  init() {
    Location();
  },
}));
// end

Alpine.data('searchlocation', () => ({
  init() {
    MapSearch();
  },
}));

Alpine.start();
