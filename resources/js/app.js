require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.onload = function() {
    document.getElementsByTagName('body')[0].style.display = 'block';
}
