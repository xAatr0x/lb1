<?php
    include('connect.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lab1</title>
    <meta charset="utf-8"/>
    <link href="style_start_page.css" rel="stylesheet">
</head>

<body>
    <form id = "form1" action="lab1_1.php" method="POST">
        <h4>Получить список фильмов с выбранным жанром:</h4> 
        <select id = "lb1_1_and_2_select" name="film_genres[]" multiple = "multiple", size = "4">
           <?php
            try
            {
                $sql = 'SELECT title from genre';
                foreach ($dbh->query($sql) as $row)
                {
                  $name = $row[0];
                  print "<option value='$name'>$name</option>";
                }
            }
            catch (PDOException $ex)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                exit();
            }
        ?>
        </select>
        <br>
        <input class="submit_form" type="submit" name="submit" value="Enter">
    </form>

    <br>

    <form id = "form2" action="lab1_2.php" method="POST">
    <h4>Получить список фильмов с выбранным актером:</h4> 
        <select id = "lb1_1_and_2_select" name="film_actors[]" multiple = "multiple", size = "4">
           <?php
            try
            {
                $sql = 'SELECT name from actor';
                foreach ($dbh->query($sql) as $row)
                {
                  $name = $row[0];
                  print "<option value='$name'>$name</option>";
                }
            }
            catch (PDOException $ex)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                exit();
            }
        ?>
        </select>
        <br>
        <input class="submit_form" type="submit" name="submit" value="Enter">
    </form>

    <br>

    <form id = "form3" action="lab1_3.php" method="POST">
    <h4>Получить список фильмов c
        <select name="fromyear">
          <?php
            try
            {
                $sql = 'SELECT date from film';
                foreach ($dbh->query($sql) as $row)
                {
                  $name = $row[0];
                  print "<option value='$name'>$name</option>";
                }
            }
            catch (PDOException $ex)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                exit();
            }
        ?>
        </select>
        по <select name="toyear">
          <?php
            try
            {
                $sql = 'SELECT date from film';
                foreach ($dbh->query($sql) as $row)
                {
                  $name = $row[0];
                  print "<option value='$name'>$name</option>";
                }
            }
            catch (PDOException $ex)
            {
                print "Error!: " . $e->getMessage() . "<br/>";
                exit();
            }
        ?>
        </select>
        <br>
        <input class="submit_form" type="submit" name="submit" value="Enter">
        </h4>
    </form>

</body>
</html>