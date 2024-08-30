<?php
$data = json_decode(file_get_contents('values.json'), true);

$informTypes = $data['informTypes'];
$systemNames = $data['systemNames'];
$notificationTexts = $data['notificationText'];
foreach ($informTypes as $type) {
echo $type['label'];
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Goulburn-Murray Water</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="w-auto mx-auto" style="max-width: 800px;">
  <h1> Outage Notification Template Generator</h1>
<form>
  <div class="form-group row">
    <label for="informType" class="col-4 col-form-label">Inform Type</label> 
    <div class="col-8">
      <select id="informType" name="informType" class="custom-select" required="required">
        <option value="">Select an inform type</option>
        <?php
        foreach ($informTypes as $type) {
          ?>
            <option value="<?php echo $type['value'] ?>"><?php echo $type['label']?></option>"
          <?php
        }
        ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">System(s)</label> 
    <div class="col-8">
      <?php
      $systemNames = $data['systemNames'];
      foreach ($systemNames as $i => $systemName) {
          ?>
          <div class="custom-control custom-checkbox custom-control-inline">
            <input name="systemName" id="systemName_<?php echo $i ?>" type="checkbox" class="custom-control-input" value="<?php echo $systemName['value'] ?>"> 
            <label for="systemName_<?php echo $i ?>" class="custom-control-label"><?php echo $systemName['label'] ?></label>
          </div>
          <?php
      }
      ?>
    </div>
  </div>
  <div class="form-group row">
    <label for="notificationText" class="col-4 col-form-label">Main Message</label> 
    <div class="col-8">
      <textarea id="notificationText" name="notificationText" cols="40" rows="6" class="form-control"></textarea>
    </div>
  </div>



  <div class="form-group row">
    <label for="signOff" class="col-4 col-form-label">Signature</label> 
    <div class="col-8">
      <select id="signOff" name="signOff" class="custom-select">
        <option value="serviceDesk">Service Desk</option>
        <option value="infrastructure">Infrastructure</option>
        <option value="businessSystems">Business Systems</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4"></label> 
    <div class="col-8">
      <textarea id="signatureText" name="signatureText" cols="40" rows="2" class="form-control"></textarea>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</div>
</form>
<script>
const notificationSelect = document.getElementById('notification');
const notificationTextarea = document.getElementById('notificationText');
const notificationTextData = <?php echo json_encode($notificationText); ?>;

const signOffSelect = document.getElementById('signOff');
const signatureTextarea = document.getElementById('signatureText');
const signatureTextData = <?php echo json_encode($signatureText); ?>;

notificationSelect.addEventListener('change', function() {
  const selectedNotification = notificationSelect.value;
  const notificationText = notificationTextData.find(function(item) {
    return item.value === selectedNotification;
  });
  if (notificationText) {
    notificationTextarea.value = notificationText.label;
  } else {
    notificationTextarea.value = '';
  }
});

signOffSelect.addEventListener('change', function() {
  const selectedSignOff = signOffSelect.value;
  const signatureText = signatureTextData.find(function(item) {
    return item.value === selectedSignOff;
  });
  if (signatureText) {
    signatureTextarea.value = signatureText.label;
  } else {
    signatureTextarea.value = '';
  }
});
</script>
</body>
</html>
