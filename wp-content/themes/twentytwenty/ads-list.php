<?php
/* Template Name: Lista Anuncios */

get_header();
global $wpdb;

$results = $wpdb->get_results("SELECT * FROM wp_ads");
        foreach ($results as $ads) {
          echo "
        <div class='box' style='display: flex'>
              <div class='image'>
                <img width='400px' src='$ads->image_path'><img>
              </div>
              <div class='info'>
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
    
?>