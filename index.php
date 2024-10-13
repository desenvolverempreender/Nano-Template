<?php
require __DIR__ . '/src/Nano/Template/Engine.php';
require __DIR__ . '/src/Nano/Template/Context.php';


$template = new Nano\Template\Engine(__DIR__.'/views');

// Or
//$template->assign([
//    'title' => 'Home page',
//    // ...
//]);
//echo $template->render('home.php');

echo $template->render('home.php', ['title' => 'Home page']);
