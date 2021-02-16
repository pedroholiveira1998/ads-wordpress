<?php
/*
Plugin Name: Coopersystem ads challenger
Description: Plugin desenvolvido para cadastro e controle de anuncios para o desafio da Coopersystem.
Version: 1.0.0
Author: Pedro Henrique
*/

register_activation_hook(__FILE__, 'adsOperationsTable');

function AdsOperationsTable()
{
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
function addAdminPageContent()
{
  add_menu_page('ADS', 'ADS', 'manage_options', __FILE__, 'AdsAdminPage', 'dashicons-feedback');
}
function adsAdminPage()
{
  global $wpdb;
  $table_name = $wpdb->prefix . 'ads';
  if (isset($_POST['newsubmit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $tag = $_POST['tag'];
    $image_path = $_POST['imagepath'];

    $wpdb->query("INSERT INTO $table_name (`name`, `description`, `tag`, `image_path`) VALUES ('$name', '$description', '$tag', '$image_path')");
  }

  if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];
  $wpdb->query("DELETE FROM $table_name WHERE user_id='$delete_id'");
    
  }

?>

  <div class="wrap">
    <h2>Gerenciar Anuncios</h2>
    <table class="wp-list-table widefat striped">
      <thead>
        <tr>
          <th width="25%">Nome</th>
          <th width="25%">Descrição</th>
          <th width="25%">Tag</th>
          <th width="25%">Imagem</th>
        </tr>
      </thead>
      <tbody>
        <form action="" method="post">
          <tr>
            <td><input type="text" id="new-name" name="name"></td>
            <td><input type="text" id="new-email" name="description"></td>
            <td><input type="text" id="new-tag" name="tag"></td>
            <td><input type="text" id="new-image" name="imagepath"></td>
            <td><button id="newsubmit" name="newsubmit" type="submit">Inserir</button></td>
          </tr>
        </form>
        <?php
        $results = $wpdb->get_results("SELECT * FROM $table_name");
        foreach ($results as $ads) {
          echo "
              <tr>
                <td width='20%'>$ads->name</td>
                <td width='20%'>$ads->description</td>
                <td width='20%'>$ads->tag</td>
                <td width='20%'>$ads->image_path</td>
                <td width='20%'><button type='button'>Editar</button><a href='admin.php?page=ads.php&delete=$ads->user_id'><button type='button'>Excluir</button></a></td>
              </tr>
            ";
        }
        ?>
      </tbody>
    </table>
  </div>
<?php
}
