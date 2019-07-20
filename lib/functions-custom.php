<?php

// Custom functions (like special queries, etc)

function get_weekly_type($id) {
  $weekly_types = get_the_terms($id, 'weeklytype');
  if ($weekly_types) {
    return $weekly_types[0]->name;
  }
  return false;
}

function get_name_list($id, $term) {
  $the_terms = get_the_terms($id, $term);
  if ($the_terms) {
    $name_list = '';
    foreach($the_terms as $key => $value) {
      $name_list .= $value->name;
      if ($key !== count($the_terms) - 1) {
        $name_list .= ', ';
      }
    }
    return $name_list;
  }
  return false;
}
