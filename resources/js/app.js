import './bootstrap';

import {Livewire, Alpine} from '../../vendor/livewire/livewire/dist/livewire.esm';

window.Alpine = Alpine;

Alpine.start();
Livewire.start();

const btn = document.getElementById('hamburger-icon');
const nav = document.getElementById('mobile-menu');

btn.addEventListener('click', () => {
    nav.classList.toggle('flex');
    nav.classList.toggle('hidden');
})
