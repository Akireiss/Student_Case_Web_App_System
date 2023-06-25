import './bootstrap';
import "./../../vendor/power-components/livewire-powergrid/dist/powergrid";
import "./../../vendor/power-components/livewire-powergrid/dist/powergrid.css";
import flatpickr from "flatpickr";
import Alpine from 'alpinejs';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();
