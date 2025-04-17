/**
 * WP-Admin Theme Customisations - JavaScript
 *
 * @package WP_Admin_Theme_Customisations
 * @version 1.1.0
 * @author WPAdmin
 * @link https://github.com/wpadmin
 */

/**
 * Модуль для управления функциональностью сайта
 */
(function () {
    'use strict';

    /**
     * Инициализация скрипта после загрузки DOM
     */
    document.addEventListener('DOMContentLoaded', function () {
        // Инициализация основных функций
        initCustomFeatures();
    });

    /**
     * Инициализация пользовательских функций
     */
    function initCustomFeatures() {
        // Пример кода - переключение элементов по клику
        const toggleElements = document.querySelectorAll('.toggle-element');

        toggleElements.forEach(element => {
            element.addEventListener('click', function (e) {
                e.preventDefault();
                this.classList.toggle('active');
            });
        });
    }

    /**
     * Утилитарная функция для работы с DOM
     * 
     * @param {string} selector - CSS селектор
     * @return {NodeList} Список найденных элементов
     */
    function findElements(selector) {
        return document.querySelectorAll(selector);
    }

    /**
     * Утилитарная функция для добавления класса к элементу
     * 
     * @param {Element} element - DOM элемент
     * @param {string} className - Название класса
     */
    function addClass(element, className) {
        if (element) {
            element.classList.add(className);
        }
    }

    // Дополнительные функции...

})();