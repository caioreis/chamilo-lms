<?php
/* For license terms, see /license.txt */
/**
 * Index of the Buy Courses plugin courses list
 * @package chamilo.plugin.buycourses
 */
/**
 *
 */
$plugin = BuyCoursesPlugin::create();
$guess_enable = $plugin->get('unregistered_users_enable');

if ($guess_enable == "true" || isset($_SESSION['_user'])) {
    // If the user is NOT an administrator, redirect it to course/session buy list
    if (!api_is_platform_admin()) {
        header('Location: src/course_catalog.php');
        exit;
    }

    $tpl = new Template();

    $content = $tpl->fetch('buycourses/view/index.tpl');

    $tpl->assign('header', $plugin->get_lang('plugin_title'));
    $tpl->assign('content', $content);

    $tpl->display_one_col_template();
}
