<!DOCTYPE html>
<html>
<title>Galaxy Sample Report</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
<body>

<h1>Chip Shortage Portfolio Report</h1>

<div class="w3-container">
  <hr>
  <div class="w3-center">
    <h2>Summary of Price Changes</h2>
    <p w3-class="w3-large">Changes relative to the previous trading day.</p>
  </div>


<?php
   $details = include('config1.php');
   $con=mysqli_connect("d4ai.com",$details['username'],$details['password'],"d4db01");
   // Check connection
   if(mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }
   
   $strsql = "SELECT prev_price, today_price, chg_pct, quantity, chg_amt, ticker, ";
   $strsql .= "security_name, category, rpt_period FROM galaxyrpt1 ";
   $strsql .= "WHERE category = 'Chip_Shortage' AND current_pd = 1 ";
   $strsql .= "ORDER BY chg_amt DESC";     // now $strsql contains the full sql statment

   $result = mysqli_query($con, $strsql);
   
   

   echo "<table class='w3-table w3-striped w3-bordered'>
		<thead>
		<tr class='w3-theme'>
		  <th>Prev Price</th>
		  <th>Today Price</th>
		  <th>Chg Pct</th>
		  <th>Quantity</th>
		  <th>Chg Amt</th>
		  <th>Ticker</th>
		  <th>Security Name</th>
		  <th>Category</th>
		  <th>Report Period</th>
		</tr>
		</thead>
		<tbody>";

   while($row = mysqli_fetch_array($result)) {
      echo "<tr class='w3-white'>";
      echo "<td>" . $row['prev_price'] . "</td>";
      echo "<td>" . $row['today_price'] . "</td>";
      echo "<td>" . $row['chg_pct'] . "</td>";
      echo "<td>" . $row['quantity'] . "</td>";
      echo "<td>" . $row['chg_amt'] . "</td>";
      echo "<td>" . $row['ticker'] . "</td>";
      echo "<td>" . $row['security_name'] . "</td>";
      echo "<td>" . $row['category'] . "</td>";
	  echo "<td>" . $row['rpt_period'] . "</td>";
      echo "</tr>";
   }
   echo "</table>";

   mysqli_close($con);
?>

<!-- Script for Sidebar, Tabs, Accordions, Progress bars and slideshows -->
<script>
// Side navigation
function w3_open() {
  var x = document.getElementById("mySidebar");
  x.style.width = "100%";
  x.style.fontSize = "40px";
  x.style.paddingTop = "10%";
  x.style.display = "block";
}
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}

// Tabs
function openCity(evt, cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  var activebtn = document.getElementsByClassName("testbtn");
  for (i = 0; i < x.length; i++) {
    activebtn[i].className = activebtn[i].className.replace(" w3-dark-grey", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-dark-grey";
}

var mybtn = document.getElementsByClassName("testbtn")[0];
mybtn.click();

// Accordions
function myAccFunc(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}

// Slideshows
var slideIndex = 1;

function plusDivs(n) {
  slideIndex = slideIndex + n;
  showDivs(slideIndex);
}

function showDivs(n) {
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length} ;
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}

showDivs(1);

// Progress Bars
function move() {
  var elem = document.getElementById("myBar");   
  var width = 5;
  var id = setInterval(frame, 10);
  function frame() {
    if (width == 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
      elem.innerHTML = width * 1  + '%';
    }
  }
}
</script>

</body>
</html> 