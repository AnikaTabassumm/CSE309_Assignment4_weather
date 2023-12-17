<?php
if(isset($_POST['submit'])) {
    
     // Get the user input from the form
     $searchText = isset($_POST["searchBar"]) ? $_POST["searchBar"] : '';  

     // Check if the search text is provided
     if (empty($searchText)) {
         echo "Please enter a city.";
        
     }
        $city = $_POST['searchBar'];
        $url="https://api.openweathermap.org/data/2.5/forecast?q=". $city. "&appid=e917a0210e77878940a5af62955ff611&units=metric";

        $content = file_get_contents($url);
        $clima = json_decode($content);
    
    if (empty($clima)) {
        echo "No location found.";
    }
 
}
?>

<!DOCTYPE html>  
<html lang="en">  
<head>  
<meta charset="UTF-8">  
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<link rel="stylesheet" href="css/bootstrap.min.css">  
<link rel="stylesheet" href="css/styles.css">  
<title>Weather Forecast</title>  
</head>  
<body class="d-flex flex-column min-vh-100">  
    <div class="wrapper">  
        <div class="d-flex justify-content-center">  
            <form class="mt-5 d-flex " method="post" action="index.php">  
                <input name="searchBar" class="form-control" type="search" placeholder=" Enter city">  
                <input type="submit" class="btn btn-lg btn-success mx-2" name="submit" value= "Search" >
            </form>  
        </div>
        <?php
            if(isset($clima)){  
                echo '<div class=" container text-center">  
                        <h2 class="text-white my-4 fst-italic">Current Location: ' . $city .'</h2>  
                    </div>  
                 <div class="container gap-5 mb-5 d-flex flex-wrap justify-content-center"> '; 
    
            
                    for($i = 0; $i <8; $i++) {
                    $newDate = date('d F', strtotime($clima->list[$i]->dt_txt));
                    $newTime = date('h:i A', strtotime($clima->list[$i]->dt_txt));

                    echo '<div class="card" style="width: 14rem;">  
                    <div class="card-body">  
                    <div class="card-text text-center">  
                    <h5 class="card-title text-bold">' . $newDate . '</h5>  
                    <h5 class="card-title text-bold">' . $newTime . '</h5>  
                    <h6 class="card-text text-bold">' . $clima->list[$i]->weather[0]->main . '</h6>  
                    <h6 class="card-text">Temperature: ' . $clima->list[$i]->main->temp . '°C</h6>  
                    <h6 class="card-text">Feels like: ' .$clima->list[$i]->main->feels_like . '</h6>   
                    <h6 class="card-text">Humidity: ' . $clima->list[$i]->main->humidity . '</h6>  
                    <h6 class="card-text">Min Temp: ' . $clima->list[$i]->main-> temp_min . '°C</h6> 
                    <h6 class="card-text">Max Temp: ' . $clima->list[$i]->main-> temp_max . '°C</h6>  
                    </div></div></div> '; 
                }
            }
        ?>
        
        <footer class="text-center pt-4">  
            <h5><b>© Anika Tabassum 2023. All rights reserved.</b></h5>  
            <div class="container d-flex gap-2 justify-content-center" style="width: 20%;">  
                <a href="https://www.linkedin.com/in/anikatabassumm" target="_blank"></a>  
                <a href="https://github.com/AnikaTabassumm" target="_blank"></a>  
            </div>  
        </footer>  
    </div>  
</body>  
</html>  


