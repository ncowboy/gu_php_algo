<?php
$array = [];
for ($i = 0; $i < 10000000; $i++) {
    $array[] = $i;
}
$start = microtime(true);
foreach ($array as $value) {
    $value++;
}
echo microtime(true) - $start . PHP_EOL;
$start2 = microtime(true);
$iterator = new ArrayIterator($array);
foreach ($iterator as $value) {
    $value++;
}
echo microtime(true) - $start2 . PHP_EOL;

//По данному примеру получилось, что итератор работает медленнее, а php 5.6 быстрее 7.2
//Стало понятно, что ничего не понятно)

