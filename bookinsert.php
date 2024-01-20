<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Book Ticket</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Gruppo%3A400"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C700"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inria+Serif%3A400%2C700"/>
  <style>
  body {
  background-color: #897B75;
}

    /* Add your styles here */
    html, body {
      min-height: 50%;
      background-color: #897B75; /* Add this line to set the background color */
    }
    body, div, form, input, select, textarea, label, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
    }

    h1 {
      position: absolute;
      margin: 0;
      font-size: 40px;
      color: #fff;
      z-index: 2;
      line-height: 83px;
    }

    .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
    }

    form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      background: #ECE6E3;
      box-shadow: 0 0 8px  #669999; 
    }

    .banner {
      position: relative;
      height: 500px;
      background-image: url("berlin-2-bg-D7X.png");
      background-size: cover;
      background-position: center;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.2); 
      position: absolute;
      width: 100%;
      height: 100%;
    }

    input, select, textarea {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      width: calc(100% - 10px);
      padding: 5px;
    }

    input[type="date"] {
      padding: 4px 5px;
    }

    .item {
      position: relative;
      margin: 10px 0;
    }

    .btn-block {
      margin-top: 10px;
      text-align: center;
    }

    button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background:  #669999;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
    }

    button:hover {
      background:  #a3c2c2;
    }

    /* Additional styles for radio buttons and checkboxes */
    .question {
      margin: 10px 0;
    }

    .question label {
      display: block;
      margin-bottom: 5px;
    }

    .question-answer {
      display: flex;
    }

    .question-answer div {
      margin-right: 10px;
    }

    .radio span, .checkbox span {
      position: relative;
      padding-left: 25px;
      cursor: pointer;
      display: inline-block;
      line-height: 20px;
    }

    .radio span::before, .checkbox span::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      width: 18px;
      height: 18px;
      border: 2px solid #666;
      border-radius: 50%;
      background-color: #fff;
      transition: background 0.3s;
    }

    .radio input[type="radio"]:checked + span::before,
    .checkbox input[type="checkbox"]:checked + span::before {
      background-color: #669999;
      border-color: #669999;
    }

  </style>
</head>
<body>
  <div class="book-ticket-o6h">
   <div class="auto-group-aajk-kiu">
      <img class="group-43-VAh" src="./group-43-7t5.png"/>
  
    </div>
    
    <div class="testbox">
      <form action="bookatic.php" method="post">
        <div class="banner">
          <h1>Book a Ticket</h1>
        </div>
        <div class="item">
        <!--  <label for="ticket_id">Ticket ID:</label>-->
        <!--  <input type="text" name="ticket_id" required><br>-->
        <!--</div>-->
         <?php
          // Database connection parameters
          $db_host = 'localhost';
          $db_user = 'id21500612_traintrac1';
          $db_password = '*******';
          $db_name = 'id21500612_traintrac';

          // Corrected database connection
          $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

           // Function to generate a random 4-digit Ticket ID
          function generateRandomTicketID() {
              return str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
          }

          // Fetch data from the database to check for existing Ticket IDs
          $existingTicketIDs = array();
          $sqlExisting = "SELECT ticket_id FROM passenger";
          $resultExisting = $conn->query($sqlExisting);

          while ($rowExisting = $resultExisting->fetch_assoc()) {
              $existingTicketIDs[] = $rowExisting['ticket_id'];
          }

          // Generate a random Ticket ID until a unique one is found
          do {
              $randomTicketID = generateRandomTicketID();
          } while (in_array($randomTicketID, $existingTicketIDs));

          // Display the Ticket ID input field
          echo '<div class="item">
                  <label for="ticket_id">Ticket ID:</label>
                  <input type="text" name="ticket_id" value="' . $randomTicketID . '" readonly required><br>
                </div>';
        ?>
        <div class="item">
          <label for="train_number">Train Name:</label>
          <select id="train_number" name="train_number" required>
            <option value="" selected>-- Select a Train Name --</option>
           <?php
        // Database connection parameters
    
        $db_host = 'localhost';
        $db_user = 'id21500612_traintrac1';
        $db_password = '******';
        $db_name = 'id21500612_traintrac';

// Corrected database connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the database
        $sql = "SELECT train_number, train_name FROM trainlist";
        $result = $conn->query($sql);

        // Generate dropdown options
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['train_number'] . "'>" . $row['train_name'] . "</option>";
        }

        // Close connection
        $conn->close();
        
      
        ?>
    </select>
</div>
   
        <div class="item">
          <label for="date">Departure Date<span>*</span></label>
          <input id="date" type="date" name="ticket_date" required>
        </div>
        <div class="item">
          <label for="name">Name<span>*</span></label>
          <input id="name" type="text" name="passenger_name" required/>
        </div>
        <div class="item">
          <label for="add">Address<span>*</span></label>
          <input id="add" type="text" name="address" required/>
        </div>
        <div class="item">
          <label for="age">Age<span>*</span></label>
          <input id="age" type="number" name="age" required />
        </div>
        <div class="question">
          <label>Sex</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="Male" id="radio_1" name="sex"/>
              <label for="radio_1" class="radio"><span>M</span></label>
            </div>
            <div>
              <input type="radio" value="Female" id="radio_2" name="sex"/>
              <label for="radio_2" class="radio"><span>F</span></label>
            </div>
          </div>
        </div>
        <div class="question">
          <label>Ticket Category</label>
          <div class="question-answer">
            <div>
              <input type="radio" value="AC" id="radio_4" name="ticket_category"/>
              <label for="radio_4" class="radio"><span>AC</span></label>
            </div>
            <div>
              <input type="radio" value="General" id="radio_5" name="ticket_category"/>
              <label for="radio_5" class="radio"><span>General</span></label>
            </div>
          </div>
        </div>
        <input type="checkbox" name="checkbox1">
        <div class="item">
  <label for="reservation_status">Reservation Status:</label>
  <input id="reservation_status" type="text" name="reservation_status" required/>
</div>

        <div class="btn-block">
          <button type="submit">Book Ticket</button>
        </div>
       <div class="btn-block">
          <a href="javascript:history.back()">  HOME   </a>
        </div>
      </form>
    </div>
  </body>
</html>
