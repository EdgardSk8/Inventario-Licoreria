import './bootstrap';
import './EspaniolTabla.js';

// =======================
// jQuery (SIEMPRE PRIMERO)
// =======================
import $ from 'jquery';
window.$ = window.jQuery = $;

// =======================
// Bootstrap (JS + CSS)
// =======================
import * as bootstrap from 'bootstrap';
window.bootstrap = bootstrap;
import 'bootstrap/dist/css/bootstrap.min.css';

// =======================
// Plugins jQuery (DESPUÉS de jQuery)
// =======================

// Select2
import 'select2/dist/js/select2.full.min.js';
import 'select2/dist/css/select2.min.css';

// DataTables
import 'datatables.net-bs5';
import 'datatables.net-bs5/css/dataTables.bootstrap5.min.css';

// =======================
// Icons
// =======================
import 'bootstrap-icons/font/bootstrap-icons.css';