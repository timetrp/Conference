
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>6088019</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
<h1>StudentList</h1>

<?php

    $conn = new mysqli("localhost","root","","student");
    // $conn = new mysqli($servername, $username, $password, $dbname);
    if (!$conn){
    die("Could not connect: ".$conn->connect_error);
    }

    $sql = "SELECT * FROM student.personal_info";
    $result = $conn->query($sql);



    if ($result->num_rows > 0){
        // HTML table tag
        echo "<table border='1'><tr><th>Firstname</th>
        <th>Lastname</th> 
        <th>BirthDate</th>
        <th>Mobilephone</th>
        <th>Age</th>
        </tr>";
        $sum = 0;

        while($row = $result->fetch_assoc()){


// calculate age of each student
            $date1=new DateTime();
            $datex = $row['Birthdate'];
            $date2=new DateTime($datex);
            $diff = $date2->diff($date1);
            $test = $diff->y;

// accumulate age of all student
            $sum = $sum + (int)$test;
        
// show data from database 
            echo "<tr><td>" . $row['FirstName'] . "</td><td>" . $row['LastName'] ."</td><td>". $row['Birthdate'] ."</td><td>". $row['Phonenumber'] ."</td><td>".
            $diff->y ."</td>"."</tr>";

        
        };

    }else{
        
    }

    echo "</table>";
    $conn->close();
?>
<br>

<?php 


echo "The value of age of all student is $sum";
?>
    
</body>
</html>