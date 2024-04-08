<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/controllers/AlunniController.php';

$app = AppFactory::create();

$app->get    ('/alunni', "AlunniController:index");
$app->get    ('/alunni/{id}', "AlunniController:prenderePerId");
$app->post   ('/alunni', "AlunniController:aggiungiAlunno");
$app->put    ('/alunni/{id}', "AlunniController:index");
$app->delete ('/alunni/{id}', "AlunniController:eliminareAlunno");

$app->run();
