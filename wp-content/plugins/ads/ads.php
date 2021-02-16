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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(220) DEFAULT NULL,
  `description` varchar(220) DEFAULT NULL,
  `tag` varchar(220) DEFAULT NULL,
  `image_path` varchar(220) DEFAULT NULL,
  PRIMARY KEY(id)
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

  if (isset($_POST['updatesubmit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $tag = $_POST['tag'];
    $image_path = $_POST['imagepath'];

    $wpdb->query("UPDATE $table_name SET name='$name',description='$description', tag='$tag', image_path='$image_path'  WHERE id='$id'");
  }

  if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $wpdb->query("DELETE FROM $table_name WHERE id='$delete_id'");
  }
  
  wp_enqueue_script('jquery');
  
  wp_enqueue_media();
?>

  <div class="wrap">
    <script src="../wp-content/plugins/ads/script.js"></script>

    <h2>Gerenciar Anuncios</h2>
    <table class="wp-list-table widefat striped">
      <thead>
        <tr>
        <th width="25%">Imagem</th>
          <th width="25%">Nome</th>
          <th width="25%">Descrição</th>
          <th width="25%">Tag</th>
        </tr>
      </thead>
      <tbody>
        <form action="" method="post">
          <tr>
            <td>
                <input type="text" id="new-image" name="imagepath">
                <input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
            </td>
            <td><input type="text" id="new-name" name="name"></td>
            <td><input type="text" id="new-email" name="description"></td>
            <td><input type="text" id="new-tag" name="tag"></td>
            <td><button id="newsubmit" name="newsubmit" type="submit">Inserir</button></td>
          </tr>
        </form>
        <?php
        $results = $wpdb->get_results("SELECT * FROM $table_name");
        foreach ($results as $ads) {
          echo "
              <tr>
                <td width='20%'><img width='80px' src='$ads->image_path'><img></td>
                <td width='20%'>$ads->name</td>
                <td width='20%'>$ads->description</td>
                <td width='20%'>$ads->tag</td>
                <td width='20%'><a href='admin.php?page=ads%2Fads.php&update=$ads->id'><button type='button'>Editar</button></a><a href='admin.php?page=ads%2Fads.php&delete=$ads->id'><button type='button'>Excluir</button></a></td>
              </tr>
            ";
        }
        ?>
      </tbody>
    </table>
    <?php
    if (isset($_GET['update'])) {
      $upt_id = $_GET['update'];
      $result = $wpdb->get_results("SELECT * FROM $table_name WHERE id='$upt_id'");
      foreach ($result as $ads) {
        $name = $ads->name;
        $description = $ads->description;
        $tag = $ads->tag;
        $image_path = $ads->image_path;
      }
      
      echo 
        "
        <table class='wp-list-table widefat striped'>
          <thead>
            <tr>
              <th width='20%'>Nome</th>
              <th width='20%'>Descrição</th>
              <th width='20%'>Tag</th>
              <th width='20%'>Imagem</th>
            </tr>
          </thead>
          <tbody>
            <form action='' method='post'>
              <tr>
                <td style='display:none'><input type='text' id='update-id' name='id' value='$ads->id'></td>
                <td width='20%'>
                <input type='text' id='new-image' name='imagepath' value='$ads->image_path'>
                <input type='button' name='upload-btn' id='upload-btn' class='button-secondary' value='Upload Image'>
                </td>
                <td width='20%'><input type='text' id='update-name' name='name' value='$ads->name'></td>
                <td width='20%'><input type='text' id='update-description' name='description' value='$ads->description'></td>
                <td width='20%'><input type='text' id='update-tag' name='tag' value='$ads->tag'></td>
                <td width='20%'><button id='updatetsubmit' name='updatesubmit' type='submit'>UPDATE</button> <a href='admin.php?page=ads%2Fads.php'><button type='button'>CANCEL</button></a></td>
              </tr>
            </form>
          </tbody>
        </table>";
    }
    ?>
  </div>
<?php
}
