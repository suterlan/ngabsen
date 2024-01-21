import './bootstrap';

import Alpine from 'alpinejs';
import sidemenu from './utilities/sidemenu.js';
import multiselect from './utilities/multiselect.js';
import persist from '@alpinejs/persist';
import showImage from './utilities/show-image.js';

window.Alpine = Alpine;

Alpine.data('sidemenu', sidemenu);
Alpine.data('multiselect', multiselect);

Alpine.plugin(persist);

Alpine.data('showImage', showImage);


Alpine.start();
