
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

// Check if the form has been submitted
if (isset($_POST['source']) && isset($_POST['destination'])) {
    // Retrieve the source and destination from the POST request
    $source = mysqli_real_escape_string($conn, $_POST['source']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
}

    // Fetch available trains based on source and destination
    $sql = "SELECT * FROM trainlist WHERE source = '$source' AND destination = '$destination'";
    $result = mysqli_query($conn, $sql);

        // Display the available trains
    echo "<html><head><title>Available Trains</title></head><body>";
    echo "<h2>Available Trains from $source to $destination</h2>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <title>Train List</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inria+Serif%3A400" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Grechen+Fuemen%3A400" />
    <link rel="stylesheet" href="./train-list.css" />
    <style>
      
html,body {
    min-height: 50px;
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
}.train-list-iSm {
  width: 100%;
  height: 127.2rem;
  position: relative;
  overflow: hidden;
  background-color: #71655f;
}
.train-list-iSm .rectangle-153-xru {
  width: 102.4rem;
  height: 178rem;
  position: absolute;
  left: 0;
  top: 0;
  box-shadow: -0.5rem -0.2rem 1.5rem rgba(0, 0, 0, 0.1199999973);
  background-color: #897a74;
}
.train-list-iSm .nav-up5 {
  width: 170.3463rem;
  height: 5.0274rem;
  position: absolute;
  left: 10.8537rem;
  top: 6.5779rem;
}
.train-list-iSm .nav-up5 .auto-group-kjmw-2do {
  width: 27.3463rem;
  height: 100%;
  position: relative;
}
.train-list-iSm .nav-up5 .auto-group-kjmw-2do .group-43-vUH {
  width: 5.7521rem;
  height: 5.0274rem;
  position: absolute;
  left: 0;
  top: 0;
  object-fit: contain;
  vertical-align: top;
}
.train-list-iSm .nav-up5 .auto-group-kjmw-2do .traind-G2M {
  width: 23.8rem;
  height: 2.2rem;
  position: absolute;
  left: 3.5463rem;
  top: 1.4221rem;
  text-align: center;
  font-size: 5rem;
  font-weight: 400;
  line-height: 0.44;
  letter-spacing: -0.0408rem;
  color: #ffffff;
  font-family: Grechen Fuemen, 'Source Sans Pro';
  white-space: nowrap;
}
.train-list-iSm .footer-KWR {
  box-sizing: border-box;
  padding: 38.4rem 0rem 0rem 0.1rem;
  width: 192.1rem;
  height: 44.1rem;
  position: absolute;
  left: 0;
  top: 83.3rem;
}
.train-list-iSm .footer-KWR .group-261-EdP {
  width: 100%;
  height: 100%;
  background-color: #4c4033;
}
.train-list-iSm .component-31-Amw {
  width: 130.7rem;
  height: 59.5rem;
  position: absolute;
  left: 34.1rem;
  top: 36.3rem;
}
.train-list-iSm .component-31-Amw .frame-23-5tu {
  width: 169.2rem;
  height: 90.4rem;
  position: absolute;
  left: -20.8rem;
  top: -15.5rem;
  overflow: hidden;
}
.train-list-iSm .component-31-Amw .frame-23-5tu .rectangle-156-QwB {
  width: 169.2rem;
  height: 116.8448rem;
  position: absolute;
  left: 0;
  top: 0;
  background-color: rgba(242, 242, 242, 0.8600000143);
  border-radius: 1rem 1rem 0 0;
}
.train-list-iSm .component-31-Amw .frame-23-5tu .group-153-hfP {
  width: 13.3rem;
  height: 4.4rem;
  position: absolute;
  left: 146.3rem;
  top: 75.8rem;
  text-align: center;
  font-size: 2.2rem;
  font-weight: 400;
  line-height: 1;
  letter-spacing: -0.0408rem;
  color: #ffffff;
  font-family: Inria Serif, 'Source Sans Pro';
  white-space: nowrap;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #4c4033;
  border-radius: 1.8rem;
}
.train-list-iSm .component-31-Amw .frame-23-5tu .available-trains-XuK {
  width: 28.7rem;
  height: 2.2rem;
  position: absolute;
  left: 11.35rem;
  top: 8.2rem;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 4rem;
  font-weight: 400;
  line-height: 0.55;
  letter-spacing: -0.0408rem;
  color: #000000;
  font-family: Inria Serif, 'Source Sans Pro';
  white-space: nowrap;
}
.train-list-iSm .component-31-Amw .rectangle-157-asb {
  width: 164.1rem;
  height: 8.1rem;
  position: absolute;
  left: -18.6rem;
  top: 0.7rem;
  box-shadow: 0 0.4rem 0.4rem rgba(0, 0, 0, 0.25);
  background-color: rgba(202, 196, 193, 0.9100000262);
  border-radius: 1rem;
}
.train-list-iSm .component-31-Amw .source-5pM {
  width: 7.7rem;
  height: 2.2rem;
  position: absolute;
  left: 31.1824rem;
  top: 2.9rem;
  text-align: center;
  font-size: 2.5rem;
  font-weight: 400;
  line-height: 0.88;
  letter-spacing: -0.0408rem;
  color: #231813;
  font-family: Inria Serif, 'Source Sans Pro';
  white-space: nowrap;
}
.train-list-iSm .component-31-Amw .destination-C8H {
  width: 13rem;
  height: 2.2rem;
  position: absolute;
  left: 44.7rem;
  top: 3rem;
  text-align: center;
  font-size: 2.5rem;
  font-weight: 400;
  line-height: 0.88;
  letter-spacing: -0.0408rem;
  color: #231813;
  font-family: Inria Serif, 'Source Sans Pro';
  white-space: nowrap;
}
.train-list-iSm .component-31-Amw .ac-fare-h53 {
  width: 7.9rem;
  height: 2.2rem;
  position: absolute;
  left: 63.25rem;
  top: 2.7rem;
  text-align: center;
  font-size: 2.5rem;
  font-weight: 400;
  line-height: 0.88;
  letter-spacing: -0.0408rem;
  color: #231813;
  font-family: Inria Serif, 'Source Sans Pro';
  white-space: nowrap;
}
.train-list-iSm .component-31-Amw .general-fare-o85 {
  width: 14.1rem;
  height: 2.2rem;
  position: absolute;
  left: 77.35rem;
  top: 2.7rem;
  text-align: center;
  font-size: 2.5rem;
  font-weight: 400;
  line-height: 0.88;
  letter-spacing: -0.0408rem;
  color: #231813;
  font-family: Inria Serif, 'Source Sans Pro';
  white-space: nowrap;
}
.train-list-iSm .component-31-Amw .general-fare-Vmb {
  width: 14.1rem;
  height: 2.2rem;
  position: absolute;
  left: 77.35rem;
  top: 2.7rem;
  text-align: center;
  font-size: 2.5rem;
  font-weight: 400;
  line-height: 0.88;
  letter-spacing: -0.0408rem;
  color: #231813;
  font-family: Inria Serif, 'Source Sans Pro';
  white-space: nowrap;
}
.train-list-iSm .component-31-Amw .weekdays-zyF {
  width: 11.2rem;
  height: 2.2rem;
  position: absolute;
  left: 98.8rem;
  top: 2.9rem;
  text-align: center;
  font-size: 2.5rem;
  font-weight: 400;
  line-height: 0.88;
  letter-spacing: -0.0408rem;
  color: #231813;
  font-family: Inria Serif, 'Source Sans Pro';
  white-space: nowrap;
}
.train-list-iSm .component-31-Amw .train-number-7Y5 {
  width: 15.6rem;
  height: 2.2rem;
  position: absolute;
  left: -15.5975rem;
  top: 3.3rem;
  text-align: center;
  font-size: 2.5rem;
  font-weight: 400;
  line-height: 0.88;
  letter-spacing: -0.0408rem;
  color: #231813;
  font-family: Inria Serif, 'Source Sans Pro';
  white-space: nowrap;
}
.train-list-iSm .component-31-Amw .train-name-phP {
  width: 13rem;
  height: 2.2rem;
  position: absolute;
  left: 7.2815rem;
  top: 3.3rem;
  text-align: center;
  font-size: 2.5rem;
  font-weight: 400;
  line-height: 0.88;
  letter-spacing: -0.0408rem;
  color: #231813;
  font-family: Inria Serif, 'Source Sans Pro';
  white-space: nowrap;
}
.train-list-iSm .component-31-Amw .image-9-8CH {
  width: 149.5rem;
  height: 29.2rem;
  position: absolute;
  left: -15rem;
  top: 13.7rem;
  object-fit: cover;
  vertical-align: top;
  
  
} .beige-bg {
            background-color: #F2F2F2; /* Beige background color */
        }
          .train-list-table {
            width: 100%; /* Adjust this width as needed */
            
        }
        .train-list-table th, .train-list-table td {
            
            padding: 8px; /* Adjust padding as needed */
            text-align: left;
        }
        
    .train-list-table{
        margin: 150px 20px 20px 20px;
        /*background-color: red;*/
       max-height: 400px; /* Set the maximum height */
    overflow: auto; /* Add a scrollbar when content exceeds the maximum height */
}

    </style>
</head>
<body>



    

     <div class="train-list-iSm">
        <div class="rectangle-153-xru"></div>
        <div class="nav-up5">
            <div class="auto-group-kjmw-2do">
                <img class="group-43-vUH" src="./group-43.png" />
                <p class="traind-G2M">Train Trac</p>
            </div>
        </div>
        <div class="footer-KWR">
            <div class="group-261-EdP"></div>
        </div>
        <div class="component-31-Amw">
            <div class="frame-23-5tu">
                <div class="rectangle-156-QwB">
<?php
// Fetch available trains based on source and destination
    $sql = "SELECT * FROM trainlist WHERE source = '$source' AND destination = '$destination'";
    $result = mysqli_query($conn, $sql); 
    // Display the available trains
    echo "<html><head><title>Available Trains</title></head><body>";
    echo "<h2>Available Trains from $source to $destination</h2>";

         ?>      
                      <?php if (mysqli_num_rows($result) > 0): ?>
                 <table class="train-list-iSm train-list-table">
                        <thead>
                    <tr>
                        <th>Train number</th>
                        <th>Train Name</th>
                        <th>Source</th>
                        <th>Destination</th>
                        <th>AC Fare</th>
                        <th>General Fare</th>
                        <th>Weekdays</th>
                    </tr>
                    </thead>
                            <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                             <tr class="beige-bg">
                            <td class="beige-bg"><?= $row['train_number'] ?></td>
                            <td><?= $row['train_name'] ?></td>
                            <td><?= $row['source'] ?></td>
                            <td><?= $row['destination'] ?></td>
                            <td><?= $row['ac_fare'] ?></td>
                            <td><?= $row['general_fare'] ?></td>
                            <td><?= $row['weekdays'] ?></td>
                        </tr>
                        
                    <?php endwhile; ?>
                      </tbody>
                </table>
            <?php else: ?>
                <p style='font-size: 50px; color: black; text-align: center;'>No trains Available.</p>
            <?php endif; ?>
        </div>
        
               <form action="enquiryinsert2.php" method="post">
                    <button type="submit" class="group-153-hfP">Back</button>
                </form>
               
            </div>
        
                </div>// white
             
                
         
        <div class="footer"></div>
    </div>
</body>
</html>
