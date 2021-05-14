<?php
//Controller for the midterm survey site

//Turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require necessary files
require_once ('vendor/autoload.php');

//Instantiate Fat-Free
$f3 = Base::instance();

//Define routes
$f3->route('GET /', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /survey', function($f3){

    $_SESSION = array();

    $userName = "";
    $userChoices = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {

    }

    //Set the survey choices in the hive
    $f3->set('choices', array("This midterm is easy", "I like midterms", "Today is Monday"));

    //Store the user input in the hive
    $f3->set('userName', $userName);
    $f3->set('userChoices', $userChoices);



    //Display the home page
    $view = new Template();
    echo $view->render('views/survey.html');
});

//Run Fat-Free
$f3->run();
