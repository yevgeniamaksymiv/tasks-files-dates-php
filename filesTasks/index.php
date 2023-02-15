<?php
session_start();

// tasks with files
// 1

$testFile = fopen("test.txt", "w") or die("Unable to open file!");
$txt = "Hello Palmo";
fwrite($testFile, $txt);
fclose($testFile);

$readFile = fopen("test.txt", "r") or die("Unable to open file!");
echo fread($readFile, filesize("test.txt")) . "</br>";
fclose($readFile);

echo 'file.txt size:' . filesize('test.txt') . " bytes </br>";
echo 'file.txt size: ' . filesize('test.txt') * .000001 . " MB </br>";
echo 'file.txt size: ' . filesize('test.txt') * .000000001 . " GB </br>";

// 2

fopen("test2.txt", "w") or die("Unable to open file!");
unlink('test2.txt');

// 3

mkdir('TestDir');

$names = ['test1', 'test2', 'test3'];
$text = "Hello World";
$files = [];

foreach ($names as $name) {
    mkdir('TestDir/' . $name);
    $fileHello = fopen('TestDir/' . $name . '/Hello.txt', 'w');
    $files[] = $fileHello;
}
foreach ($files as $file) {
    fwrite($file, $text);
    fclose($file);
}

// 4

function checkIsFile($name)
{
    if (strpos($name, ".")) {
        echo 'It is a file';
    } else {
        echo 'It is a directory';
    }
}

checkIsFile('Text');
checkIsFile('index.html');
