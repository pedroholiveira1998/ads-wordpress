<?php
/* Template Name: Lista Anuncios */

get_header();

global $wpdb;
$filter;

if (isset($_POST['n']) || isset($_POST['t'])) {
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

if (isset($_POST['order'])) {
  $filter = "SELECT * FROM wp_ads ORDER BY create_date DESC";
}

if (isset($_POST['remove'])) {
  $filter = "SELECT * FROM wp_ads";
}

echo "
      <form class='input-search' action='' method='post'>
        <label>Nome: <input class='input-form' type='text' name='n' /></label>
        <label>Tag: <input class='input-form' type='text' name='t' /></label>
        <label><input type='submit' name='ok' value='Pesquisar' /></label>
      </form>
      <form class='input-search' action='' method='post'>
        <label><input type='submit' name='remove' value='Remover filtros'/></label>
      </form>
      <form class='input-search' action='' method='post'>
        <label><input type='submit' name='order' value='Ordenar por data'/></label>
      </form>
      ";

$results = $wpdb->get_results(!isset($filter) ? "SELECT * FROM wp_ads" : $filter);

echo "
      <div class='container'>
    ";

foreach ($results as $ads) {
  echo "<head>
            <link rel='stylesheet' type='text/css' href='wp-content/themes/twentytwenty/style.css'>
        </head>
        <div class='content'>
          <div class='box'>
                  <div class='name site-title'>
                      $ads->name
                  </div>
                <div class='image'>
                  <img src='$ads->image_path'><img>
                </div>
                <div class='info'>
                  <div class='description entry-content'>
                      $ads->description
                  </div>
                  <div class='tag'>
                      $ads->tag
                  </div>
                </div>
          </div>
          <hr class='post-separator styled-separator is-style-wide section-inner' aria-hidden='true' />
        </div>
        ";
}
echo " 
      </div>
    ";

get_footer();
