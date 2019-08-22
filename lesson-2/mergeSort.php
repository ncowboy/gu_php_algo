<?php
$array = [];
for ($i = 0; $i < 20; $i++) {
    $arr[] = mt_rand(0, 100);
}

function mergeSort($arr)
{
    $length = count($arr);
    $right = [];
    $left = [];
    if ($length > 1) {
        $middle = (int)count($arr) / 2;
        for ($j = 0; $j < $length; $j++) {
            if ($j <= $middle) {
                $left[] = $arr[$j];
            } else {
                $right[] = $arr[$j];
            }
        }
    }
    mergeSort($left);
    mergeSort($right);

    $k = 0;
    $l = 0;
    $m = 0;

    while ($k < count($left) && $l < count($right)) {
        if ($left[$k] < $right[$l]) {
            $arr[$m] = $left[$k];
            $k++;
        } else {
            $arr[$m] = $right[$l];
            $l++;
        }
        $m++;
    }

    while ($k < count($left)) {
        $arr[$m] = $left[$k];
        $k++;
        $m++;
    }

    while ($l < count($right)) {
        $arr[$m] = $right[$l];
        $l++;
        $m++;
    }
    return $arr;
}

print_r(mergeSort($array));
