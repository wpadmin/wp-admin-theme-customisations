/**
 * WP-Admin Theme Customisations - jQuery скрипты
 *
 * @package WP_Admin_Theme_Customisations
 * @version 1.1.0
 * @author WPAdmin
 * @link https://github.com/wpadmin
 * @dependency jQuery
 */

(function ($) {
    'use strict';

    /**
     * Инициализация jQuery-функций после полной загрузки документа
     */
    $(document).ready(function () {
        // Инициализация основных функций
        initLightbox();
    });


    /**
     * Инициализация лайтбокса для изображений
     */
    function initLightbox() {
        // Пример простого лайтбокса
        $('.lightbox-image').on('click', function (e) {
            e.preventDefault();

            const imageUrl = $(this).attr('href');
            const lightboxHtml = `
                <div class="lightbox-overlay">
                    <div class="lightbox-container">
                        <img src="${imageUrl}" alt="Lightbox image">
                        <button class="lightbox-close">&times;</button>
                    </div>
                </div>
            `;

            $('body').append(lightboxHtml);

            $('.lightbox-overlay').on('click', function (e) {
                if ($(e.target).hasClass('lightbox-overlay') ||
                    $(e.target).hasClass('lightbox-close')) {
                    $(this).remove();
                }
            });
        });
    }

    /**
     * Утилитарная функция для плавной прокрутки к элементу
     * 
     * @param {jQuery} $element - jQuery элемент
     * @param {number} offset - Отступ сверху (px)
     * @param {number} duration - Длительность анимации (ms)
     */
    function smoothScrollTo($element, offset = 0, duration = 500) {
        if ($element.length) {
            $('html, body').animate({
                scrollTop: $element.offset().top - offset
            }, duration);
        }
    }

    // Дополнительные функции...

})(jQuery);