<?php
$connect = mysqli_connect("localhost", "root", "Lopig1983", "php_algo");

$query = "SELECT categories.id, categories.name, links.parent_id, links.child_id, links.level
FROM `categories`
         INNER JOIN `links` ON `categories`.`id` = `links`.`child_id`";

$result = mysqli_query($connect, $query);
$cats = [];

while ($cat = mysqli_fetch_assoc($result)) {
    $cats[$cat["parent_id"]] [$cat["id"]] = $cat;
}

function buildTree($cats, $parent_id)
{
    if (is_array($cats) && isset($cats[$parent_id])) {
        $tree = "<ul>";
        foreach ($cats[$parent_id] as $cat) {
            $tree .= "<li>" . $cat["name"];
            $tree .= buildTree($cats, $cat["id"]);
            $tree .= "</li>";

        }
        $tree .= "</ul>";
        return $tree;

    }

}

buildTree($cats, 0);


echo "<pre>";
print_r($cats);
echo "</pre>";

