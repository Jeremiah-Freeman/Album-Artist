<?php

    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/CD.php";

    session_start();

    if(empty($_SESSION['list_of_CDs'])) {
      $_SESSION['list_of_CDs'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app['debug'] = true;

    $app->get("/" , function() use ($app) {
      return $app["twig"]->render("create_new_CD.html.twig" , array("create_CD"=> CD::getAll()));
    });

    $app->post("/create_CD" , function() use ($app) {
      $display_new_CD = new CD($_POST["title"] , null);
      $display_new_CD->save();
      return $app["twig"]->render("display_created_CDs.html.twig" , array("display_CD" => $display_new_CD));
    });




    return $app;

?>
