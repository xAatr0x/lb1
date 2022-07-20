<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Lab1</title>
  <link href="style_result_page.css" rel="stylesheet">
</head>

<body>
    <table>
    <tr>
        <th>FilmName</th>
        <th>Date</th>
        <th>Country</th>
        <th>Quality</th>
        <th>Resolution</th>
        <th>Codec</th>
        <th>Producer</th>
        <th>Director</th>
        <th>Carrier</th>
</tr>
</body>
</html>

<?php
    include('connect.php');
    if (isset($_POST["film_genres"]))
    {   
        try
        {
            $genresArray = $_POST["film_genres"];
            $genres=" ".$genresArray[0]."";
            $sql = "SELECT * FROM film JOIN film_genre on film.ID_FILM=film_genre.FID_Film JOIN genre on film_genre.FID_Genre = genre.ID_Genre where genre.title= ?";
            for ($i = 1; $i < count($genresArray); $i++) {
                $genres .=" ".$genresArray[$i]."";
                $sql .= " OR genre.title = ?";
            }

            $sql .= " GROUP by film.name HAVING COUNT(genre.title)>= ?";
            echo "<h4>Фильмы с жанром".$genres."</h4>";
            $sth = $dbh->prepare($sql);

            $sth->bindParam(1, $genresArray[0], PDO::PARAM_STR);

            for ($i = 1; $i < count($genresArray); $i++) {
                $sth->bindParam($i+1, $genresArray[$i], PDO::PARAM_STR);
            }

            $countOfGenres = count($genresArray);
            $sth->bindParam($countOfGenres+1, $countOfGenres, PDO::PARAM_INT);
            $sth->execute();
              $table = $sth->fetchAll(PDO::FETCH_NUM);

              foreach ($table as $row)
              {
                  $FilmName = $row[1];
                  $Date = $row[2];
                  $Country = $row[3];
                  $Quality = $row[4];
                  $Resolution = $row[5];
                  $Codec = $row[6];
                  $Producer = $row[7];
                  $Director = $row[8];
                  $Carrier = $row[9];
                  print "<tr> <td>$FilmName</td> <td>$Date</td> <td>$Country</td> <td>$Quality</td> <td>$Resolution</td> <td>$Codec</td> <td>$Producer</td> <td>$Director</td> <td>$Carrier</td> </tr>";
              }
        }
        catch (PDOException $ex)
        {
            print "Error!: " . $ex->getMessage() . "<br/>";
            exit();
        }
    }
?>