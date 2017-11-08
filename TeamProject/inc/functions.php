<?php
    // Func
     session_start();
     $movieCollect = array();
     $movieGenre = array();
     $movieYear = array();
    function test($interest) 
        {
                
                $curl = curl_init();
                $key=getenv('movie_key');
                
                curl_setopt_array($curl, array(
            
                
                  CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?api_key=8e56967b0a4b849899773bc9ad998665&query=$interest&page=1&include_adult=false",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => array(
            "cache-control: no-cache"
          ),
                ));
               $jsonData = curl_exec($curl);
        $data = json_decode($jsonData, true); //true makes it an array!
        $pic_path="https://image.tmdb.org/t/p/w500";
        
        $imageURLs = array();
        for ($i = 0; $i < 99; $i++) 
        {
                $imageURLs[]="https://image.tmdb.org/t/p/w500" . $data['results'][$i]['poster_path'];
                
                 //$config['images']['base_url']
                 //$imageURLs[]=$data['images'][$i]['base_url'];
                 //$imageURLs[]+=$data['images'][$i]['secure_base_url'];
                 //$imageURLs[]+=$data['images'][$i]['backdrop_sizes'];
                 
               
               // echo $imageURLs[$i];
        }
        $err = curl_error($curl);
        curl_close($curl);
        
        return $imageURLs;
    }
    
    function trending($something)
    {
         $curl = curl_init();
                $key=getenv('movie_key');
                
                curl_setopt_array($curl, array(
            
                
                  CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?api_key=8e56967b0a4b849899773bc9ad998665&query=$something&page=1&include_adult=false",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_POSTFIELDS => array(
            "cache-control: no-cache"
          ),
                ));
               $jsonData = curl_exec($curl);
        $data = json_decode($jsonData, true); //true makes it an array!
        $pic_path="https://image.tmdb.org/t/p/w500";
        
        $imageURLs = array();
        for ($i = 0; $i < 99; $i++) 
        {
                $imageURLs[]=$data['results'][$i]['title'];
                
                 //$config['images']['base_url']
                 //$imageURLs[]=$data['images'][$i]['base_url'];
                 //$imageURLs[]+=$data['images'][$i]['secure_base_url'];
                 //$imageURLs[]+=$data['images'][$i]['backdrop_sizes'];
                 
               
               // echo $imageURLs[$i];
        }
        $err = curl_error($curl);
        curl_close($curl);
        
        return $imageURLs;
        
    }
    function displayMovies() {
        global $conn;
        $sql = "SELECT * FROM `db_movie` WHERE 1 ";
        
        $namedParamaters = array();
        
        if (isset($_GET['submit'])) {
            
            if (!empty($_GET['movieSelect'])) {
                $namedParamaters[':movieName'] = $_GET['movieSelect'];
                $sql .= ' AND movieName = :movieName';
            }
            
            if (!empty($_GET['genre'])) {
                $namedParamaters[':genre'] = "%" . $_GET['genre'] . "%";
                $sql .= " AND movieGenre like :genre";
            }
        }
        
        if (isset($_GET['random'])){
            $namedParamaters[':random'] = rand(1,40);
            $sql .= " AND movieId = :random";
        }
        if (isset($_GET['length'])) {
            $sql .= " ORDER BY movieLength";
        }
        if (isset($_GET['newest'])) {
            $sql .= " ORDER BY movieYear DESC";
        }
        if (isset($_GET['oldest'])) {
            $sql .= " ORDER BY movieYear ASC";
        }
        if (isset($_GET['a-z'])) {
            $sql .= " ORDER BY movieName ASC";
        }
        if (isset($_GET['z-a'])) {
            $sql .= " ORDER BY movieName DESC";
        }
        
        $sql .= " LIMIT 20";
                
        $statement = $conn->prepare($sql);
        $statement->execute($namedParamaters);
        $movies = $statement->fetchAll(PDO::FETCH_ASSOC);
        //This will return an array of movie info
        foreach($movies as $movies){
            echo "<tr>";
            echo"<td>".''.$movies['movieName'].''."</td>"; 
            echo"<td>".''.$movies['movieGenre'].''."</td>"; 
            echo"<td>".''.$movies['movieYear'].''."</td>"; 
            echo"<td>".''.$movies['movieLength'].''."</td>"; 
            echo"<td>";
            $name = replaceAll($movies['movieName']); 
            $pic = movieInfo($name);
            $info = overView($name);
            echo "<div class='container2' >";
            echo "<button type='button' class='btn btn-info btn-sm' data-toggle='modal' data-target='#".''.$name.''."'>Preview</button>";
            echo " ";
          echo "<button type='button' class='btn btn-success btn-sm' value='AddToCart(".''.$movies['movieName'].''.")'>Add to Cart</button>";
            
              echo "<div class='modal fade' id='".''.$name.''."' role='dialog'>";
                echo "<div class='modal-dialog'>";
                  echo "<div class='modal-content'>";
                    echo "<div class='modal-header'>";
                      echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
                      echo "<h3>".''.$movies['movieName'].''."</h3>";
                    echo "</div>";
                    echo "<div class='modal-body'>";
                      echo "<p style= 'text-align:center' ><img src='".''.$pic[0].''."' width='200'></p>";
                      echo "<p>".''.$info[0].''."</p>";
                    echo "</div>";
                    echo "<div class='modal-footer'>";
                      echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
                    echo "</div>";
                  echo "</div>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
            echo"</td>"; 
            echo"</tr>";
        }
    }
    function displayMovies2() {
        global $conn;
        $sql = "SELECT * FROM `db_movie` WHERE 1 ";
        
        $namedParamaters = array();
        
        if (isset($_GET['submit'])) {
            
            if (!empty($_GET['movieSelect'])) {
                $namedParamaters[':movieName'] = $_GET['movieSelect'];
                $sql .= ' AND movieName = :movieName';
            }
            
            if (!empty($_GET['genre'])) {
                $namedParamaters[':genre'] = "%" . $_GET['genre'] . "%";
                $sql .= " AND movieGenre like :genre";
            }
        }
        
        if (isset($_GET['random'])){
            $namedParamaters[':random'] = rand(1,40);
            $sql .= " AND movieId = :random";
        }
        if (isset($_GET['length'])) {
            $sql .= " ORDER BY movieLength";
        }
        if (isset($_GET['newest'])) {
            $sql .= " ORDER BY movieYear DESC";
        }
        if (isset($_GET['oldest'])) {
            $sql .= " ORDER BY movieYear ASC";
        }
        if (isset($_GET['a-z'])) {
            $sql .= " ORDER BY movieName ASC";
        }
        if (isset($_GET['z-a'])) {
            $sql .= " ORDER BY movieName DESC";
        }
        
        $sql .= " LIMIT 20";
                
        $statement = $conn->prepare($sql);
        $statement->execute($namedParamaters);
        $movies = $statement->fetchAll(PDO::FETCH_ASSOC);
        $i=0;
        //This will return an array of movie info
        foreach($movies as $movies){
            echo "<tr>";
            echo"<td>".''.$movies['movieName'].''."</td>"; 
            echo"<td>".''.$movies['movieGenre'].''."</td>"; 
            echo"<td>".''.$movies['movieYear'].''."</td>"; 
            echo"<td>".''.$movies['movieLength'].''."</td>"; 
            echo"<td>";
            $name = replaceAll($movies['movieName']); 
            $pic = movieInfo($name);
            $info = overView($name);
            echo "<div class='container2' >";
            echo "<button type='button' class='btn btn-info btn-sm btn-block' data-toggle='modal' data-target='#".''.$name.''."'>Preview</button>";
          echo "<form action='checkout.php'><input type='hidden' name='movieId' value='".$i."'>
          <input type='submit'value='Add To Cart'
          <button type='button'id='AddToCartBtn'class='btn btn-success btn-sm btn-block'</button></input></form>";
            $movieCollect[$i]=$movies['movieName'];
            $movieGenre[$i]=$movies['movieGenre'];
            $movieYear[$i]=$movies['movieYear'];
              echo "<div class='modal fade' id='".''.$name.''."' role='dialog'>";
                echo "<div class='modal-dialog'>";
                  echo "<div class='modal-content'>";
                    echo "<div class='modal-header'>";
                      echo "<button type='button' class='close' data-dismiss='modal'>&times;</button>";
                      echo "<h3>".''.$movies['movieName'].''."</h3>";
                    echo "</div>";
                    echo "<div class='modal-body'>";
                      echo "<p style= 'text-align:center'><img src='".''.$pic[0].''."' width='200' ></p>";
                      echo "<p>".''.$info[0].''."</p>";
                    echo "</div>";
                    echo "<div class='modal-footer'>";
                      echo "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
                    echo "</div>";
                  echo "</div>";
                echo "</div>";
              echo "</div>";
            echo "</div>";
            echo"</td>"; 
            echo"</tr>";
            $i++;
        }
        $_SESSION['movieName']=$movieCollect;
        $_SESSION['movieGenre']=$movieGenre;
        $_SESSION['movieYear']=$movieYear;
    }
    function movieInfo($something) 
    {
            
            $curl = curl_init();
            $key=getenv('movie_key');
            
            curl_setopt_array($curl, array(
        
            
              CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?api_key=8e56967b0a4b849899773bc9ad998665&query=$something&page=1&include_adult=false",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => array(
        "cache-control: no-cache"
      ),
            ));
           $jsonData = curl_exec($curl);
    $data = json_decode($jsonData, true); //true makes it an array!
     $imageURLs = array();
        for ($i = 0; $i < 1; $i++) 
        {
                $imageURLs[]="https://image.tmdb.org/t/p/w500" . $data['results'][$i]['poster_path'];
        }
        $err = curl_error($curl);
        curl_close($curl);
        
        return $imageURLs;
}
function overView($something) 
    {
            
            $curl = curl_init();
            $key=getenv('movie_key');
            
            curl_setopt_array($curl, array(
        
            
              CURLOPT_URL => "https://api.themoviedb.org/3/search/movie?api_key=8e56967b0a4b849899773bc9ad998665&query=$something&page=1&include_adult=false",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_POSTFIELDS => array(
        "cache-control: no-cache"
      ),
            ));
           $jsonData = curl_exec($curl);
    $data = json_decode($jsonData, true); //true makes it an array!
     $imageURLs = array();
        for ($i = 0; $i < 1; $i++) 
        {
                $imageURLs[]=$data['results'][$i]['overview'];
                
                 //$config['images']['base_url']
                 //$imageURLs[]=$data['images'][$i]['base_url'];
                 //$imageURLs[]+=$data['images'][$i]['secure_base_url'];
                 //$imageURLs[]+=$data['images'][$i]['backdrop_sizes'];
                 
               
               // echo $imageURLs[$i];
        }
        $err = curl_error($curl);
        curl_close($curl);
        
        return $imageURLs;
}
function replaceAll($text) 
    { 
        $text = strtolower(htmlentities($text)); 
        $text = str_replace(get_html_translation_table(), "-", $text);
        $text = str_replace(" ", "-", $text);
        $text = preg_replace("/[-]+/i", "-", $text);
        return $text;
    }
    function topRated() {
        global $conn;
        $sql = "SELECT * FROM `db_movie` limit 10 ";
        
        if (isset($_GET['submit'])) {
            $namedParamaters = array();
            
            $namedParamaters[':movieName'] = $_GET['movieSelect'];
            $sql .= ' AND movieName = :movieName';
        }
                
        $statement = $conn->prepare($sql);
        $statement->execute($namedParamaters);
        $movies = $statement->fetchAll(PDO::FETCH_ASSOC);
        //This will return an array of movie info
        foreach($movies as $movies){
        

            $name = replaceAll($movies['movieName']); 
            $pic = movieInfo($name);
            $info = overView($name);
            $name1=trending($name);
           for($i=0;$i<1;$i++)
           {
                echo "<strong>" . $name1[$i] . "</strong>";
                echo "<br>";
                echo "<img src='$pic[$i]' width='200'>";
                echo "<br>";
                echo "<br>";
                echo "<br>";
               
          
          
          
        
           }
        }
    }
?>