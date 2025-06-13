<?php
require __DIR__ . '/vendor/autoload.php';

//use Illuminate\Console\Scheduling\Schedule;
//use Aplikace\Planovac\LaravelPlanovac;
use Aplikace\Planovac\CrunzPlanovac;
use Aplikace\Zamek\SouborovyZamek;
use Aplikace\Uloha\TestovaciUloha;
use Aplikace\Uloha\TestovaciUloha2;

// Vlastní mutex
$zamek = new SouborovyZamek();

// Laravel
//$schedule = new Schedule();
//$planovac = new LaravelPlanovac($schedule, $zamek);

// Crunz
$planovac = new CrunzPlanovac($zamek);


$uloha = new TestovaciUloha();
$uloha2 = new TestovaciUloha2();
$planovac->naplanuj($uloha);
$planovac->naplanuj($uloha2);

$planovac->spustNaplanovane();
