/**
 * Laravel Bootstrap — sets up Axios with CSRF token for AJAX requests.
 * Minimal version: no jQuery, no Echo.
 */
import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Attach CSRF token from meta tag to every Axios request
const csrfToken = document.head.querySelector('meta[name="csrf-token"]');
if (csrfToken) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken.content;
}
