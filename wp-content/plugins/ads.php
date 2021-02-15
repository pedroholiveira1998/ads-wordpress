<?php
/*
Plugin Name: Coopersystem ads challenger
Description: Puglin desenvolvido para cadastro e controle e anuncios para o desafio da Coopersystem.
Version: 1.0.0
Author: Pedro Henrique
*/
register_activation_hook( __FILE__, 'adsOperationsTable');
function AdsOperationsTable() {
  global $wpdb;
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = $wpdb->prefix . 'ads';
  $sql = "CREATE TABLE `$table_name` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(220) DEFAULT NULL,
  `description` varchar(220) DEFAULT NULL,
  `tag` varchar(220) DEFAULT NULL,
  `image_path` varchar(220) DEFAULT NULL,
  PRIMARY KEY(user_id)
  ) ENGINE=MyISAM DEFAULT CHARSET=latin1;
  ";
  if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
  }
}
add_action('admin_menu', 'addAdminPageContent');
function addAdminPageContent() {
  add_menu_page('ADS', 'ADS', 'manage_options' ,__FILE__, 'AdsAdminPage', 'dashicons-feedback');
}
