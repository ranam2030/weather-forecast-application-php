<!DOCTYPE html>
<?php
    $longitude = $_POST["long"];
    $latitude = $_POST["lati"];
    $combine = $longitude.",".$latitude;
    $longitude_latitude=$combine;
    $api_url = 'https://api.darksky.net/forecast/a75481420020c93f3c4e57f252507839/'.$longitude_latitude;
    $forecast = json_decode(file_get_contents($api_url));
    $csvFileName = 'example.csv';
    $fp = fopen($csvFileName, 'w');
    $header = false;
    foreach ($forecast as $row){
        if (empty($header)){
            $header = array_keys($row);
            fputcsv($fp,$header);
            $header = array_flip($header);
        }
        fputcsv($fp,array_merge($header,$row));
    }
    fclose($fp);
    
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forecast With DerkSky By Skkyroo</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">DarkSky</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Skkyroo</a>
      </li>
    </ul>
  </div>
</nav>


    <section>
        <div>
        <form class="text-center mt-1" action="index.php" method="post">
            <input class="mt-1" type="text" name="long" placeholder='Longitude'><br>
            <input class="mt-1" type="text" name="lati" placeholder='Latitude'><br>
            <button class="mt-1 bg-primary" type="submit">Submit</button>
        </form>
            <main class="text-center">
                <h1 class="display-1">Forecast</h1>
                <div class="card p-4" style=" margin:0 auto; max-width: 720px;">
                    <h2>Current Forecast</h2>
                    <h4>
                        <?php
                            echo '<pre>';
                            print_r($forecast);
                            echo '</pre>';
                        ?>
                    </h4>
                
                </div>
            </main>
        </div>
    </section>
    
</body>
</html>