import './bootstrap'; // Importe la config de base (axios, etc.)
import 'bootstrap';   // Importe le JS de Bootstrap 5
import $ from 'jquery';

window.$ = window.jQuery = $;

// Vous pouvez ajouter ici vos scripts globaux (auto-hide alerts, etc.)
document.addEventListener('DOMContentLoaded', function() {
    console.log('Digital’SOS JS chargé avec succès !');
});

import Quill from 'quill';
import 'quill/dist/quill.snow.css'; // Importe le CSS directement dans votre JS

window.Quill = Quill;