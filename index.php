<?php
// Define the HTML template as a PHP string
$htmlTemplate = <<<EOT
<!DOCTYPE html>
<html>
<head>
<title>Goulburn-Murray Water</title>
<style>
body {
  font-family: sans-serif;
  max-width: 620px;
}
div {
width: 620px;
font-size: 15px;
}

.header {
  text-align: centre;

}

.container. {

}
.heading {
color: #004A85;
text-align: center;
}
.date {
text-align: right;
}
.info {

}

h1 {
  color: #004A85;
}

.systems {

  
}

.footer {
  text-align: left;
  
}

.logo {
  width: 620px;
}

</style>
</head>
<body>
<div class="header">
  <img class="logo" src="cid:image001" alt="Goulburn-Murray Water Logo">
</div>
<div class="date">
<p>{INSERTTODAYDATE}</p>
</div>
<div class="container">
  <div class="info">
    <h2 class="heading">INFORM: Patching commencing this week, {INSERTTODAYDATE}</h2>
    <p>Please note that patching will be commencing this week in Test. Production patching is scheduled for next {INSERTDATE}. Please ensure TDC systems are tested prior to next Wednesday.</p>
  </div>

  <div class="footer">
    <p>If you have any questions, please contact a member from the Infrastructure Team or <a href="mailto:BAF_ICTInfrastructure@gmwater.com.au">BAF_ICTInfrastructure@gmwater.com.au</a></p>
    <p><b>Infrastructure Team<br>
    Information Technology<br>
    Business and Finance</b></p>
  </div>
</div>
</body>
</html>
EOT;

// Create a simple form to input the variables
echo '<form action="" method="post">';
echo '<label for="insertDate">Insert Date:</label><br>';
echo '<input type="text" id="insertDate" name="insertDate"><br><br>';
echo '<label for="insertTodayDate">Insert Today Date:</label><br>';
echo '<input type="text" id="insertTodayDate" name="insertTodayDate"><br><br>';
echo '<input type="submit" value="Generate Template">';
echo '</form>';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $insertDate = $_POST['insertDate'];
  $insertTodayDate = $_POST['insertTodayDate'];

  // Replace the variables in the HTML template
  $htmlBody = str_replace(array('{INSERTDATE}', '{INSERTTODAYDATE}'), array($insertDate, $insertTodayDate), $htmlTemplate);

  // Display the generated HTML template as a preview
  echo '<h2>Generated HTML Template Preview:</h2>';
  echo '<div style="border: 1px solid #ccc; padding: 10px; width: 620px;">';
  echo $htmlBody;
  echo '</div>';
}
?>
