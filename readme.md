# WP-Admin Theme Customisations
## О плагине

WP-Admin Theme Customisations — удобный плагин для WordPress, который позволяет добавлять пользовательские стили, скрипты и шаблоны к вашей теме без необходимости модификации файлов самой темы. Это обеспечивает сохранность изменений при обновлении темы.

Автор: WPAdmin

Сайт автора: https://github.com/wpadmin

Версия: 1.1.0

Требуемая версия WordPress: 4.0.0 или выше

Тестировано до: WordPress 6.4.3

## Возможности

Добавление пользовательских CSS стилей
Подключение обычных JavaScript и jQuery-зависимых скриптов
Переопределение шаблонов WordPress и WooCommerce
Добавление кастомных функций через отдельный файл

## Структура плагина

```text
wp-admin-theme-customisations/
├── wp-admin-theme-customisations.php         # Основной файл плагина
├── readme.md                                 # Файл с описанием плагина
├── languages/                                # Файлы переводов
│   └── wp-admin-theme-customisations.pot     # Шаблон перевода
├── assets/                                   # Ресурсы плагина
│   ├── css/                                  # CSS стили
│   │   └── style.css                         # Основной файл стилей
│   └── js/                                   # JavaScript скрипты
│       ├── custom.js                         # Обычный JavaScript
│       └── jquery-custom.js                  # jQuery-зависимый JavaScript
└── custom/                                   # Директория для кастомизаций
    ├── functions.php                         # Пользовательские функции
    └── templates/                            # Шаблоны
        ├── page.php                          # Пример шаблона страницы
        ├── single.php                        # Пример шаблона записи
        └── woocommerce/                      # Шаблоны WooCommerce
            ├── cart/                         # Шаблоны корзины
            │   └── cart.php                  # Пример шаблона корзины
            └── checkout/                     # Шаблоны оформления заказа
                └── form-checkout.php         # Пример шаблона оформления
```
