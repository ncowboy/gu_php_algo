<?php
$connect = mysqli_connect("localhost", "root", "", "php_algo");
$queryParents = "SELECT * FROM links WHERE level = 1";

$resultParents = mysqli_query($connect, $queryParents);
$parents = [];
$tree = [];
function buildCategoryTree($id, $connect)
{
  $cats = [];
  $queryCats = "
        SELECT categories.id, categories.name, links.parent_id, links.child_id, links.level
        FROM `categories`
        INNER JOIN `links` ON `categories`.`id` = `links`.`child_id`
        WHERE links.parent_id={$id}
        ";
  $resultCategory = mysqli_query($connect, $queryCats);
  while ($category = mysqli_fetch_assoc($resultCategory)) {
    $cats[$category['id']] = $category;
  }
   echo '<pre>';
   print_r ($cats);
   echo '</pre>';

   foreach ($cats as $cat) {

   }
   
  

}

echo buildCategoryTree(2, $connect);

