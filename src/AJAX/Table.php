<?php
namespace Touriends\Backend\AJAX;

use Touriends\Backend\User;

global $jal_db_version;
$jal_db_version = '1.0';

class Table extends Base {
    public static function init() {
        register_activation_hook( __FILE__, 'jal_install' );
    }
    public static function jal_install() {
        global $wpdb;
        global $jal_db_version;

        $table_name = $wpdb->prefix . 'message';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
  mid mediumint(9) NOT NULL AUTO_INCREMENT,
  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  re_id bigint(20) NOT NULL,
  se_id bigint(20) NOT NULL,  
  note longtext NOT NULL,
  read_ck varchar(20),
  PRIMARY KEY (mid)
) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);

        add_option('jal_db_version', $jal_db_version);
    }
}
