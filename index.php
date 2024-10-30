<?php
/**
 * @package callmaker
 * @version 1.2
 */
/*
Plugin Name: callmaker
Description: Callmaker helps you boost website conversion by establishing phone calls with your visitors via VOIP.
Author: callmaker
Version: 1.2
Author URI: http://callmaker.ru
*/

$sServiceUrl = 'callmaker.net'; // todo для продакшена другой адрес сайта ;)
$sScriptUrl = '//callmaker.net/witget/witget.min.js'; // todo для продакшена другой адрес виджета ;)

require_once('include/functions.php');

add_action('admin_menu', 'digitaldali_callmaker_admin_add_menus');

function digitaldali_callmaker_admin_add_menus()
{
    add_menu_page('Callmaker', 'Callmaker', 1, dirname(__FILE__) . '/' . basename(__FILE__), 'digitaldali_callmaker_admin_panel');
    add_submenu_page(dirname(__FILE__) . '/' . basename(__FILE__), 'Callmaker Settings', 'Settings', 1, dirname(__FILE__) . '/' . basename(__FILE__), 'digitaldali_callmaker_admin_panel');

    $callmaker_login = get_option('callmaker_login');
    if (empty($callmaker_login)) {
        add_submenu_page(dirname(__FILE__) . '/' . basename(__FILE__), 'Callmaker Registration', 'Registration', 1, dirname(__FILE__) . '/register.php', 'digitaldali_callmaker_admin_register');
    }
}

function digitaldali_callmaker_admin_panel()
{
    require_once(dirname(__FILE__) . '/include/settings.php');
}

function digitaldali_callmaker_admin_register()
{
    require_once(dirname(__FILE__) . '/include/register.php');
}



function digitaldali_callmaker_embed()
{
    ?>
    <script type="text/javascript" id="clb-script-config">clbId="<?= get_option('callmaker_login'); ?>";</script>
    <script type="text/javascript" id="clb-script-src" src="//callmaker.net/witget/witget.min.js" charset="UTF-8"></script>
<?php
}


if (!function_exists('embedCallmaker')) {
    function embedCallmaker()
    {
        // if (!is_admin()) {
            global $sScriptUrl;
            // $embedPlugin = (get_option('show_callmaker_widget') == true);
            // echo '$embedPlugin '.$embedPlugin;
            // if ($embedPlugin) {
                add_action('wp_head', 'digitaldali_callmaker_embed',1);
            // }
        // }
    }
}

add_action('init', 'embedCallmaker');



