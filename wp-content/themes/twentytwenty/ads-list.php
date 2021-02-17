<?php
/* Template Name: Lista Anuncios */

get_header();

global $wpdb;
$filter;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $where = array();

  $name = getPost('n');
  $tag = getPost('t');

  if ($name) {
    $where[] = " `name` LIKE '%{$name}%'";
  }
  if ($tag) {
    $where[] = " `tag` LIKE '%{$tag}%'";
  }

  $sql = "SELECT * FROM wp_ads ";
  if (sizeof($where))
    $sql .= ' WHERE ' . implode(' AND ', $where);

  $filter = $sql; 
}

function filter($str)
{
  return addslashes($str);
}
function getPost($key)
{
  return isset($_POST[$key]) ? filter($_POST[$key]) : null;
}

echo '<form action="" method="post">
        Buscar por:
        <label>Nome: <input type="text" name="n" /></label>
        <label>Tag: <input type="text" name="t" /></label>

        <label><input type="submit" name="ok" value="Ok" /></label>
      </form>';

$results = $wpdb->get_results(!isset($filter) ? "SELECT * FROM wp_ads" : $filter);
echo "<div class='container'>
        <div class='content'>
    ";
foreach ($results as $ads) {
  echo "
          <div class='box' style='display: flex'>
                <div class='image'>
                  <img width='400px' src='$ads->image_path'><img>
                </div>
                <div class='info site-description'>
                  <div>
                      Nome: $ads->name
                  </div>
                  <div>
                      Descrição: $ads->description
                  </div>
                  <div>
                      Tag: $ads->tag
                  </div>
                </div>
          </div>
          ";
}
echo "  </div>
      </div>";
