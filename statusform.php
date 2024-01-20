<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Check Status</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Grechen+Fuemen%3A400"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inria+Serif%3A400%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans%3A400"/>
  <link rel="stylesheet" href="./check-status.css"/>
<style>
  html, body {
    min-height: 100%;
  }

  .group-50-bvy {
       display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px 20px; /* Adjust padding as needed */

    margin: 0 auto;
    font-size: 100px; /* Adjust the font size as needed */
  
  }
  
  
html {
	font-size:62.5%;
}
* {
	margin: 0;
	padding: 0;
}
ul, li {
	list-style: none;
}
input {
	border: none;
}
body {
  width: 192rem;
}.check-status-7dB {
  box-sizing: border-box;
  padding-top: 5.1779rem;
  width: 100%;
  overflow: hidden;
  position: relative;
  align-items: center;
  display: flex;
  flex-direction: column;
  background-color: #cac4c1;
}

.check-status-7dB .auto-group-ggsm-imP .group-229-GH7 .item-1435517380619-2-mjf {
  width: 100%;
  height: 31.3rem;
  background-color: rgba(0, 0, 0, 0.3100000024);
  background-size: 100% 643.861%;
  background-position: -0rem -155.9392rem;
  background-image: url('../assets/bg.png');
  border-radius: 1rem;
}
.check-status-7dB .auto-group-ggsm-imP .group-229-GH7 .item-1435517380619-2-mjf .item-1435517380619-2-mjf-bg {
  width: 167.6rem;
  height: 31.3rem;
  position: relative;
  background-image: url('REPLACE_IMAGE:295d56a00b0e1b8b5806243cbc337fb345509b63');
}
.bg {
  width: 167.6rem;
  height: 103.5rem;
  position: absolute;
  left: 12.2rem;
  top: 0;
  background-color: rgba(0, 0, 0, 0.3100000024);
  background-size: 100% 108.243%;
  background-position: -0rem -0.5882rem;
  background-image: url('/bg-Pnq.png');
  border-radius: 1rem;
}
.check-status-7dB .auto-group-ggsm-imP .item-1435517380619-1-byb .item-1435517380619-1-byb-bg {
  width: 167.6rem;
  height: 103.5rem;
  position: relative;
  background-image: url('REPLACE_IMAGE:295d56a00b0e1b8b5806243cbc337fb345509b63');
}



</style>
</head>
<body>
<div class="check-status-yww">
  <div class="nav-WS5">
    <div class="auto-group-vevo-EN5">
      <img class="group-43-PEy" src="./group-43-7a9.png"/>
      <p class="traind-7wf">Train Trac</p>
    </div>
  </div>
  <div class="auto-group-f4wm-nnu">
    <div class="group-229-Y1P">
      <div class="item-1435517380619-2-S6m">
        <div class="item-1435517380619-2-S6m-bg">
        </div>
      </div>
    </div>
    <div class="item-1435517380619-1-F4D">
      <div class="item-1435517380619-1-F4D-bg">
      </div>
    </div>
    <div class="group-230-Gk1">
      
      <div class="check-status-aEu">Check Status</div>
      
      <div class="group-237-5hT">
        <div class="group-226-3PP">
 
    <?php
    // Set the database credentials
    $db_host = 'localhost';
    $db_user = 'id21500612_traintrac1';
    $db_password = '******';
    $db_name = 'id21500612_traintrac';

    // Connect to the database
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    // Check if the connection was successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['ticket_id'])) {
        // Retrieve the ticket ID from the form
        $ticket_id = $_POST['ticket_id'];

        // Prepare a SQL statement with a parameter
        $sql = "SELECT * FROM passenger
                INNER JOIN trainlist ON passenger.train_number = trainlist.train_number
                WHERE ticket_id = ?";

        // Create a prepared statement
        $stmt = mysqli_prepare($conn, $sql);

        // Bind the parameter
        mysqli_stmt_bind_param($stmt, "i", $ticket_id);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                // Output the data for each row
                echo '<div class="ticket-details">';
                while ($row = mysqli_fetch_assoc($result)) {
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Train Name:</strong> " . $row['train_name'] . "</p>";
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Source:</strong> " . $row['source'] . "</p>";
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Destination:</strong> " . $row['destination'] . "</p>";
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Ticket ID:</strong> " . $row['ticket_id'] . "</p>";
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Train Number:</strong> " . $row['train_number'] . "</p>";
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Departure Date:</strong> " . $row['ticket_date'] . "</p>";
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Name:</strong> " . $row['passenger_name'] . "</p>";
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Sex:</strong> " . $row['sex'] . "</p>";
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Address:</strong> " . $row['address'] . "</p>";
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Ticket Status:</strong> " . $row['reservation_status'] . "</p>";
echo "<p style='font-size: 25px; color: white; text-align: middle;'><strong>Ticket Category:</strong> " . $row['ticket_category'] . "</p>";

                }
                echo '</div>';
            } else {
                
                echo "<p style='font-size: 25px; color: white; text-align: middle;'>No ticket found with this ID</p>";
            }
        } else {
            // Print an error message if the query was not successful
            echo "<p>Error: " . mysqli_error($conn) . "</p>";
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }
    ?>
    
    
                   <form action="index2.php" method="post">
                   <button type="submit" class="group-50-bvy">Back</button>
                </form>
    </div>
    </div>
</body>
</html>
