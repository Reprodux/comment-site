<?php

//Get Heroku ClearDB connection information
$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;
// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

$query = "SELECT * FROM to_do";
  mysqli_query($conn, $query) or die('Error querying database');

$result = mysqli_query($conn,$query);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0.75">
    <title>Comment Site</title>
    <link rel="stylesheet" href="stylesV4.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  </head>
  <body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src='time.js'></script>
      

    <div class="header">
      <div class="time" id ='clock'></div>
    </div>

    <div class="weather-container">

      <div class="weather-grid">
        <div class="current">
          <script type="text/javascript" src="weatherv2.js"></script>
          <div class="current-header">
            <h1 class= 'city' id = "city"></h1>
          </div>
          <div class="current-info">
            <img class='sign'src="" alt="icon" id="icon" width='75'/>
            <div class="degrees">
              <h1 class ="num" id='temp'>16</h1>
              <span class = 'circle'>&#176;</span>
            </div>
            <h3 class = 'desc' id='desc'></h3>
          </div>
        </div>

        <div class="weekcast">

            <h1 class="future">5 day</h1>

          <div class="weekcast-info">
            <ul>
              <li><span class = 'day1' id='day1'> </span> - <img src="" alt="icon" id= 'day1-icon' width='30'/> : <span id='day1-degree'></span>&#176; - <span id='day1-desc'></span></li>
              <li><span class = 'day2' id='day2'> </span> - <img src="" alt="icon" id= 'day2-icon' width='30'/> : <span id='day2-degree'></span>&#176; - <span id='day2-desc'></span></li>
              <li><span class = 'day3' id='day3'> </span> - <img src="" alt="icon" id= 'day3-icon' width='30'/> : <span id='day3-degree'></span>&#176; - <span id='day3-desc'></span></li>
              <li><span class = 'day4' id='day4'> </span> - <img src="" alt="icon" id= 'day4-icon' width='30'/> : <span id='day4-degree'></span>&#176; - <span id='day4-desc'></span></li>
              <li><span class = 'day5' id='day5'> </span> - <img src="" alt="icon" id= 'day5-icon' width='30'/> : <span id='day5-degree'></span>&#176; - <span id='day5-desc'></span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <script>
      setInterval(function() { $("#item-list").load("load-items.php"})}, 4000);
    </script>
    <div class="reminder-container" id="item-list">
      <table>
      <thead>
          <tr>
              <th style="justify-content: center">To-Do List: </th>
          </tr>
      </thead>
      <tbody>

          <!--Use a while loop to make a table row for every DB row-->
          <?php while ($row = mysqli_fetch_array($result)) : ?>
          <tr>
                <!--Each table column is echoed in to a td cell-->
                <td><?php echo $row['item']; ?></td>
          </tr>
          <tr>
            <td><a id="button" class= 'button' href="delete.php?id=<?php echo $row['id']; ?>" >Delete Entry</a></td>
          </tr>
          <?php endwhile ?>
          <?
          mysqli_close($conn)
          ?>
      </tbody>
  </table>

    </div>
    <div class="form">
      <form action="connect-todo.php" method="POST">
        <label for="item">Item:</label><br>
        <input type="text" id="item" name="item" size="28"><br>
        <input type="submit" id="submit" name="submit">
    </form>
    </div>

    
  </body>
</html>