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
    if (isset($_POST["film_actors"]))
    {
        try
        {
              $actorsArray = $_POST["film_actors"];
              $actors=" ".$actorsArray[0]."";
            $sql = "SELECT * FROM film JOIN film_actor on film.ID_FILM=film_actor.FID_Film JOIN actor on film_actor.FID_Actor = actor.ID_Actor where actor.name= ?";
            for ($i = 1; $i < count($actorsArray); $i++) {
                $actors .=" ".$actorsArray[$i]."";
                $sql .= " OR actor.name = ?";
            }

            $sql .= " GROUP by film.name HAVING COUNT(actor.name)>= ?";
            echo "<h4>Фильмы с жанром".$actors."</h4>";
            $sth = $dbh->prepare($sql);

            $sth->bindParam(1, $actorsArray[0], PDO::PARAM_STR);

            for ($i = 1; $i < count($actorsArray); $i++) {
                $sth->bindParam($i+1, $actorsArray[$i], PDO::PARAM_STR);
            }

            $countOfActors = count($actorsArray);
            $sth->bindParam($countOfActors+1, $countOfActors, PDO::PARAM_INT);
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