import './bootstrap';

import Alpine from 'alpinejs';
import focus from '@alpinejs/focus'

import 'boxicons';

import {livewire_hot_reload} from 'virtual:livewire-hot-reload'

livewire_hot_reload();

// import 'video.js';

import jQuery from 'jquery';
window.$ = jQuery;


window.Alpine = Alpine;

Alpine.start();
Alpine.plugin(focus)

