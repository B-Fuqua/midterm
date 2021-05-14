<?php
//Controller for the midterm survey site

//Turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require necessary files
require_once ('vendor/autoload.php');
require_once ('model/validation.php');

//Instantiate Fat-Free
$f3 = Base::instance();

//Define routes
$f3->route('GET /', function(){
    //Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET|POST /survey', function($f3){

    //Reset the session array
    $_SESSION = array();

    //Set values to empty
    $userName = "";
    $userChoices = array();

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $userName = $_POST['name'];

        //If name is valid
        if (validName($_POST['name']))
        {
            $_SESSION['userName'] = $_POST['name'];
        }
        else
        {
            $f3->set('errors["name"]', 'Please enter your name');
        }

        //If choices are valid
        if (validChoices($_POST['choices']))
        {
            $userChoices = $_POST['choices'];
            $_SESSION['userChoices'] = implode(", ", $_POST['choices']);
        }
        else
        {
            $f3->set('errors["choices"]', 'Please choose at least one');
        }

        //If there are no errors redirect to summary route
        if (empty($f3->get('errors')))
        {
            header('location: summary');
        }
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

$f3->route('GET /summary', function(){
    //Display the summary page
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run Fat-Free
$f3->run();
