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
      $display_new_CD = new CD($_POST["title"] , $_POST["artist"]);
      $display_new_CD->save();
      return $app["twig"]->render("display_created_CDs.html.twig" , array("display_CD" => $display_new_CD));
    });

    $app->post("/artist_search" , function() use ($app) {
      $name_of_artist = $_POST["artist-search"];
      $artist_explode = explode(" ",$name_of_artist);


      $matchedArray = array();

      foreach ($_SESSION['list_of_CDs'] as $display_new_CD) {
        for ($i = 0; $i < sizeof($artist_explode); $i++) {
          if (strpos(strtoupper($display_new_CD->getArtist()), strtoupper($artist_explode[$i])) === false) {
            # code...
          } else {
            if (strlen($artist_explode[$i]) === 1) {
              # code.
            } else {
              array_push($matchedArray, $display_new_CD);
              break;
              # code...
            }

          }



        }




      }
      return $app["twig"]->render("artist-search.html.twig" , array("artist" => $matchedArray));
    });





    return $app;

?>
