<?php
$data = json_decode(file_get_contents('values.json'), true);

$informTypes = $data['informTypes'];
$systemNames = $data['systemNames'];
$notificationTexts = $data['notificationText'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Goulburn-Murray Water</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <!-- Add a date picker library, such as Bootstrap Datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
  <div class="container">
    <form action="generate_template.php" method="post" class="form-horizontal">
      <div class="form-group">
        <label for="informType" class="col-sm-2 control-label">INFORM Type:</label>
        <div class="col-sm-10">
          <select id="informType" name="informType" class="form-control" onchange="updateNotificationText(this.value)">
            <?php foreach ($informTypes as $type) { ?>
              <option value="<?php echo $type['value']; ?>"><?php echo $type['label']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="systemName" class="col-sm-2 control-label">System Name:</label>
        <div class="col-sm-10">
          <select id="systemName" name="systemName" class="form-control">
            <?php foreach ($systemNames as $name) { ?>
              <option value="<?php echo $name['value']; ?>"><?php echo $name['label']; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="date" class="col-sm-2 control-label">Date:</label>
        <div class="col-sm-10">
          <input type="text" id="date" name="date" class="form-control datepicker">
        </div>
      </div>
      <div class="form-group">
        <label for="notificationText" class="col-sm-2 control-label">Notification Text:</label>
        <div class="col-sm-10">
          <input type="text" id="notificationText" name="notificationText" class="form-control">
        </div>
      </div>
      <!-- Rest of the form fields -->
    </form>
  </div>

  <script>
    function updateNotificationText(informTypeValue) {
      var notificationText = document.getElementById('notificationText');
      var notificationTexts = <?php echo json_encode($notificationTexts); ?>;
      for (var i = 0; i < notificationTexts.length; i++) {
        if (notificationTexts[i].value === informTypeValue) {
          notificationText.value = notificationTexts[i].label;
          break;
        }
      }
    }
  </script>
</body>
</html>