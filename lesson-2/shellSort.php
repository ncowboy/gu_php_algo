<?php
$prices = [
    [
        'price' => 21999,
        'shop_name' => 'Shop 1',
        'shop_link' => 'http://'
    ],
    [
        'price' => 21550,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://'
    ],
    [
        'price' => 21950,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://'
    ],
    [
        'price' => 21350,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://'
    ],
    [
        'price' => 21050,
        'shop_name' => 'Shop 2',
        'shop_link' => 'http://'
    ],

];

function ShellSort($elements)
{
    $steps = 0;
    $k = 0; //1
    $steps++;
    $length = count($elements); //О(1)
    $steps++;
    $gap[0] = (int)($length / 2); //О(1)
    $steps++;

    while ($gap[$k] > 1) {  //О(log(n))
        $k++;
        $gap[$k] = (int)($gap[$k - 1] / 2);
        $steps++;
    }

    for ($i = 0; $i <= $k; $i++) { //О(log(n))
        $step = $gap[$i];
        $steps++;

        for ($j = $step; $j < $length; $j++) { //О(n)
            $temp = $elements[$j];
            $p = $j - $step;
            $steps++;

            while ($p >= 0 && $temp['price'] < $elements[$p]['price']) { //О(log(n))
                $elements[$p + $step] = $elements[$p];
                $p = $p - $step;
                $steps++;
            }

            $elements[$p + $step] = $temp;
            $steps++;
        }
    }
    var_dump($steps);

}

ShellSort($prices);

// Итого:
//  О(n) * О(log(n) * О(log(n) + О(log(n) + О(1) + О(1)
// O(n * log(n))