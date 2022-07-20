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
    if (isset($_POST["fromyear"]) and isset($_POST["toyear"]))
    {
        $fromyear=$_POST["fromyear"];
        $toyear=$_POST["toyear"];
        echo "<h4> Фильмы, которые были выпущены в промежутке с ".$fromyear." по ".$toyear."</h4>";
        try
        {
              $sql = "SELECT * from film where film.date >=:fromyear and film.date <=:toyear";
              $sth = $dbh->prepare($sql);
              $sth->execute(array(':fromyear' => $fromyear, ':toyear' => $toyear));

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