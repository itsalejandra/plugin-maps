<?php
/**
 * Plugin Mapas
 *
 * @package           Mapa de geolocalizacion
 * @author            Alejandra Sanchez
 * @copyright         2023 Alejandra Sanchez Lorenzo
 * @license           GPL-2.0-or-later
 * @link              https://github.com/itsalejandra/plugin-maps.git
 * @author            itsalejandra
 *
 * @wordpress-plugin
 * Plugin Name:       Mapa de geolocalizacion
 * Plugin URI:        https://github.com/itsalejandra/plugin-maps.git
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Alejandra Sanchez Lorenzo
 * Author URI:        https://github.com/itsalejandra
 * Text Domain:       plugin-slug
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Update URI:        https://github.com/itsalejandra/plugin-maps.git
 * Description:       Es un plugin que sirve para ver desde donde las personas se registran en nuestra red social, marcando asi en el mapa su ubicación.
 */
function map_shortcode($atts) {
    // Generate output
    $output = '<div class="map-shortcode">';
    $output .= '<div id="europe-map" style="width: 600px; height: 400px;"></div>';
    $output .= '</div>';

    // Enqueue Leaflet library and custom JavaScript
    wp_enqueue_script('leaflet', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.js');
    wp_add_inline_script('leaflet', 'jQuery(document).ready(function($){ initMap(); });');
    wp_enqueue_style('leaflet', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');

    // Custom JavaScript to initialize the map
    $output .= '<script>
        function initMap() {
            var europeMap = L.map("europe-map").setView([51.5074, 0.1278], 4); // Centered at London

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                maxZoom: 19,
                attribution: "Map data © <a href=&quot;https://www.openstreetmap.org/copyright&quot;>OpenStreetMap</a> contributors"
            }).addTo(europeMap);

            var cities = [
                { name: "Tirana", lat: 41.3275, lon: 19.8187 },
                { name: "Berlín", lat: 52.5200, lon: 13.4050 },
                { name: "Andorra la Vieja", lat: 42.5063, lon: 1.5218 },
                { name: "Viena", lat: 48.2082, lon: 16.3738 },
                { name: "Bruselas", lat: 50.8503, lon: 4.3517 },
                { name: "Minsk", lat: 53.9045, lon: 27.5615 },
                { name: "Sarajevo", lat: 43.8563, lon: 18.4131 },
                { name: "Sofía", lat: 42.6977, lon: 23.3219 },
                { name: "Nicosia", lat: 35.1856, lon: 33.3823 },
                { name: "Zagreb", lat: 45.8150, lon: 15.9819 },
                { name: "Copenhague", lat: 55.6761, lon: 12.5683 },
                { name: "Bratislava", lat: 48.1486, lon: 17.1077 },
                { name: "Liubliana", lat: 46.0569, lon: 14.5058 },
                { name: "Madrid", lat: 40.4168, lon: -3.7038 },
                { name: "Tallin", lat: 59.4370, lon: 24.7536 },
                { name: "Helsinki", lat: 60.1695, lon: 24.9354 },
                { name: "París", lat: 48.8566, lon: 2.3522 },
                { name: "Atenas", lat: 37.9838, lon: 23.7275 },
                { name: "Budapest", lat: 47.4979, lon: 19.0402 },
                { name: "Dublín", lat: 53.3498, lon: -6.2603 },
                { name: "Reikiavik", lat: 64.1265, lon: -21.8174 },
                { name: "Roma", lat: 41.9028, lon: 12.4964 },
                { name: "Pristina", lat: 42.6667, lon: 21.1667 },
                { name: "Riga", lat: 56.9496, lon: 24.1052 },
                { name: "Vaduz", lat: 47.1410, lon: 9.5209 },
                { name: "Vilna", lat: 54.6872, lon: 25.2797 },
                { name: "Luxemburgo", lat: 49.6116, lon: 6.1319 },
                { name: "Skopie", lat: 42.0024, lon: 21.4361 },
                { name: "La Valeta", lat: 35.8989, lon: 14.5146 },
                { name: "Chisináu", lat: 47.0269, lon: 28.8416 },
                { name: "Mónaco", lat: 43.7384, lon: 7.4246 },
                { name: "Podgorica", lat: 42.4304, lon: 19.2594 },
                { name: "Oslo", lat: 59.9139, lon: 10.7522 },
                { name: "Ámsterdam", lat: 52.3667, lon: 4.8945 },
                { name: "Varsovia", lat: 52.2297, lon: 21.0122 },
                { name: "Lisboa", lat: 38.7223, lon: -9.1393 },
                { name: "Londres", lat: 51.5074, lon: -0.1278 },
                { name: "Praga", lat: 50.0755, lon: 14.4378 },
                { name: "Bucarest", lat: 44.4268, lon: 26.1025 },
                { name: "Moscú", lat: 55.7558, lon: 37.6173 },
                { name: "San Marino", lat: 43.9424, lon: 12.4578 },
                { name: "Belgrado", lat: 44.7866, lon: 20.4489 },
                { name: "Estocolmo", lat: 59.3293, lon: 18.0686 },
                { name: "Berna", lat: 46.9480, lon: 7.4474 },
                { name: "Kiev", lat: 50.4501, lon: 30.5234 },
                { name: "Vaticano", lat: 41.9029, lon: 12.4534 },
            ];
            var users = {
                "Madrid": 5,   
                "Atenas": 2, 
                "París": 1,
                "Berlín": 1,
                "Dublín": 1,
                "Amsterdan": 1,
                "Lisboa": 5,
                "Vaticano": 10,
                "Praga": 9,
                "Varsovia": 4,
                "Estocolmo": 8,
            };

            cities.forEach(function(city) {
                var marker = L.marker([city.lat, city.lon]).addTo(europeMap);
                var userCount = users[city.name] || 0;
                marker.bindPopup(city.name + " (" + userCount + ")");
            });
        }
    </script>';

    return $output;
}

// Register shortcode
add_shortcode('map', 'map_shortcode');