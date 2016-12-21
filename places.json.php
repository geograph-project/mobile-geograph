<?php 

// https-to-http proxy!

//todo, COULD add caching here...



        if (!empty($_GET['callback'])) {
                header("Content-Type:text/javascript");
                $callback = preg_replace('/[^\w\.\$]+/','',$_GET['callback']);
                echo "/**/{$callback}(";
        } else {
                header("Content-Type:application/json");
        }

        readfile("http://www.geograph.org.uk/finder/places.json.php?q=".urlencode($_GET['q']));

        if (!empty($_GET['callback'])) {
                echo ");";
        }

