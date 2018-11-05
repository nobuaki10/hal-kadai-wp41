<?php

//配列→変数展開
list($id,$name,$age) = $a;
echo $id,$name,$age;


sort($a);
printArray($a);

rsort($a);
printArray($a);

//連想配列ソート
$a = ["x" => 10,"y" => 5,"z" => 20];
asory($a);
printArray($a);

arsort($a);
printArray($a);

//連想配列ソード(キー)
ksort($a);
printArray($a);

krsort($a);
printArray($a);
//反転
$a = array_reverse($a);
printArray($a);
echo array_pop($a);
printArray($a);

//配列を使ったキューとスタック
array_push( $a,"a","b");
printArray($a);

echo array_pop($a);
printArray($a);

//配列の先頭出し入れ
array_unshift($a,"10");
array_unshift($a,"20");
array_unshift($a,"30");

printArray($a);

echo array_shift($a);
printArray($a);

array_unshift($a,"c","d");
printArray($a);
echo array_shift($a);
printArray($a);

//配列のマージ
$a = ["id" =>1,"name" => "x"];
$b = ["id" =>9,"age" => 22];
$c = array_merge($a,$b);
printArray($c);

//配列のぶった切り(substring的な)
$a = array_slice($c,0,2);
printArray($a);
printArray(array_slice($c,1,2));
printArray(array_slice($c,-1,1));


//ソート
function printArray($a){
  echo "<pre>";
    print_r($a);
    echo "</pre>";
}
