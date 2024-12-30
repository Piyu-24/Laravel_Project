import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Initialize Flatpickr
document.addEventListener('DOMContentLoaded', function () {
    flatpickr("#pickup-time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i", // Format as hours:minutes
        time_24hr: true,
    });

    flatpickr("#return-time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });
});
