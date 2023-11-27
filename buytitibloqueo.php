<?php
/**
 * Plugin Name:       Buytiti - Bloqueo de Pago para Morelos
 * Plugin URI:        https://buytiti.com
 * Description:       Este plugin bloquea a los usuarios que seleccionan Morelos durante el proceso de pago.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Jesus Jimenez
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       buytitibloqueo
 * Update URI:        https://buytiti.com
 *
 * @package           buytiti
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Hook para ejecutar la función al cargar la página de pago
 */
function bloquear_morelos_pago() {
    ?>
    <script>
        // Script para bloquear la selección de Morelos en el formulario de pago
        jQuery(document).ready(function ($) {
            $('#billing_state, #shipping_state').change(function () {
                if ($(this).val() == 'MO') { // Código del estado de Morelos en ISO 3166-2:MX
                    alert('Lo siento, no aceptamos direcciones de Morelos para el pago.');
                    // Desactivar el botón de realizar el pedido
                    $('#place_order').prop('disabled', true);
                } else {
                    // Habilitar el botón de realizar el pedido si no es Morelos
                    $('#place_order').prop('disabled', false);
                }
            });
        });
    </script>
    <?php
}

add_action('woocommerce_before_checkout_form', 'bloquear_morelos_pago');
