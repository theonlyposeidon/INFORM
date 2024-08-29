<?php
$data = json_decode(file_get_contents('values.json'), true);

$informTypes = $data['informTypes'];
$systemNames = $data['systemNames'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Goulburn-Murray Water</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <form action="generate_template.php" method="post" class="form-horizontal">
      <div class="form-group">
        <label for="informType" class="col-sm-2 control-label">INFORM Type:</label>
        <div class="col-sm-10">
          <select id="informType" name="informType" class="form-control">
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
      <!-- Rest of the form fields -->
    </form>
  </div>
</body>
</html>