<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'manuale_mebel_db' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'I@|s` u9_S^~E2OR<DrSQG|;S5%$fCo3V<By%iQRZo&dqkT4g0?^5h1OJ#o8A94X' );
define( 'SECURE_AUTH_KEY',  ':TAdQr JF2;$kh^<Icv83,o<u#F_Qz1(9/7ytn:}YI%WL9Rh;lT&J#!,&}Q)LCTe' );
define( 'LOGGED_IN_KEY',    '}mtb&_xL>n3{KZpq.IL6d{-~c>L#[o`zOh,;Yd!htD5Nx,E%UQZP*IX2ZN0e&$b9' );
define( 'NONCE_KEY',        'dvL&[=3^Q3s6Q;wUQq>6jtoW7C.3{YDgFl3>t}@s;xHfgqI;5cmO~qB.<5e?pyRR' );
define( 'AUTH_SALT',        'O`PD%}TlYi# ns4iX;`u]-$]_4VsiUPZ;VYQiGyz4<F,ZQNttP4JW:yM@VD[}UVE' );
define( 'SECURE_AUTH_SALT', 'eO]pIN)WxnA8^Y;HH-N_K8NqZ8Y$`2.}t@=_K_Q3S/rJavmM*KO}| b)HLF!CQz4' );
define( 'LOGGED_IN_SALT',   'oIG5d3;;t6R6*b,b]0!0zF35q7CM#s#igz@X`[cd&8i$K:x{BJ@a?!=i??ef8[;:' );
define( 'NONCE_SALT',       'z[}N/j0^K5CH8-|x_Xqv?lj;o])pP-N+e*l<LHC(vy/:EkSw6+L]Xvuyr4Myt0tb' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'mm_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
