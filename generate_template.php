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
  </div>
  <div class="container">
    <div class="info">
      <h2 class="heading">{INFORMMESSAGE}</h2>
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

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $informType = $_POST['informType'];
  $systemName = $_POST['systemName'];
  $insertDate = $_POST['insertDate'];
  $insertTodayDate = date("l, j M Y"); // Format: DDDD, dd MMM yyyy

  // Generate the INFORM message based on the user's selection
  switch ($informType) {
    case 'unplannedOutage':
      $informMessage = "INFORM: Unplanned Outage - $systemName";
      break;
    case 'plannedOutage':
      $informMessage = "INFORM: Planning Outage - $systemName, $insertDate";
      break;
    case 'newProcedure':
      $informMessage = "INFORM: New Procedure";
      break;
  }

  // Replace the placeholder with the generated INFORM message
  $htmlTemplate = str_replace('{INFORMMESSAGE}', $informMessage, $htmlTemplate);

  // Replace the INSERTDATE placeholder with the user-input date
  $htmlTemplate = str_replace('{INSERTDATE}', $insertDate, $htmlTemplate);

  // Output the generated HTML template
  echo $htmlTemplate;
}
?>
