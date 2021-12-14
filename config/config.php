<?php

//gen
$rep = __DIR__ . '/../';

//BDD

$user = 'client';
$password = 'client';
$base = 'mysql:host=localhost; dbname=projet_blog;charset=utf8';

//Vues

$vues['admin'] = 'views/admin/viewAdmin.php';
$vues['template'] = 'views/template.php';
$vues['templateEmpty'] = 'views/templateEmpty.php';
$vues['accueil'] = 'views/viewAccueil.php';
$vues['addArticle'] = 'views/viewAddArticle.php';
$vues['article'] = 'views/viewArticle.php';
$vues['erreur'] = 'views/viewErreur.php';
$vues['login'] = 'views/viewLogin.php';
$vues['modifArticle'] = 'views/viewModifArticle.php';
$vues['register'] = 'views/viewRegister.php';
$vues['suppArticle'] = 'views/viewSuppArticle.php';
$vues['suppComment'] = 'views/viewSuppComment.php';
$vues['user'] = 'views/viewUser.php';


//Style

$style['main'] = 'public/css/style.css';
$style['login'] = 'public/css/login.css';
$style['erreur'] = 'public/css/erreur.css';

