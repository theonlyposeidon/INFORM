<?php
$data = json_decode(file_get_contents('values.json'), true);

$informTypes = $data['informTypes'];
$systemNames = $data['systemNames'];
$notificationTexts = $data['notificationText'];
$signatureTexts = $data['signatureText'];
$signOffTypes = $data['signOffTypes'];
$informMessages = $data['informMessages'];
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
<div class="row">
  <div class="col-8">
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
        <label for="informMessage" class="col-4 col-form-label">INFORM: Message</label> 
        <div class="col-8">
          <textarea id="informMessage" name="informMessage" cols="40" rows="1" class="form-control"></textarea>
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
            <option value="">Select From:</option>
            <?php
              foreach ($signOffTypes as $type) {
            ?>
            <option value="<?php echo $type['value'] ?>"><?php echo $type['label']?></option>"
            <?php
              }
            ?>
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
  </div>
  <div class="col-4">
    <div id="preview-panel"><h3>Preview</h3></div>
  </div>
</div>          

<script>
  const informTypes = <?php echo json_encode($data['informTypes']); ?>;
  const notificationTexts = <?php echo json_encode($data['notificationText']); ?>;
  const notificationTextarea = document.getElementById('notificationText');
  const signOffSelect = document.getElementById('signOff');
  const signatureTextarea = document.getElementById('signatureText');
  const signatureTexts = <?php echo json_encode($signatureTexts); ?>;
  const signOffTypes = <?php echo json_encode($signOffTypes); ?>;
  const informMessages = <?php echo json_encode($data['informMessages']); ?>;
  const informMessageTextarea = document.getElementById('informMessage');

  document.addEventListener('DOMContentLoaded', function() {
  const informTypeSelect = document.querySelector('select[name="informType"]');
  informTypeSelect.addEventListener('change', function() {
    const selectedInformType = this.value;
    const selectedNotificationText = notificationTexts.find(text => text.value === selectedInformType);
    if (selectedNotificationText) {
      notificationTextarea.value = selectedNotificationText.label;
    } else {
      notificationTextarea.value = ''; // or some default value
    }
  });

  signOffSelect.addEventListener('change', function() {
    const selectedSignature = this.value;
    const selectedSignatureText = signatureTexts.find(text => text.value === selectedSignature);
    if (selectedSignatureText) {
      signatureTextarea.value = selectedSignatureText.label;
    } else {
      signatureTextarea.value = ''; // or some default value
    }
  });
  const informTypeSelect = document.querySelector('select[name="informType"]');
  const systemNameCheckboxes = document.querySelectorAll('input[name="systemName"]');

  informTypeSelect.addEventListener('change', function() {
    const selectedInformType = this.value;
    const selectedInformMessage = informMessages.find(message => message.value === selectedInformType);
    if (selectedInformMessage) {
      const checkedSystemNames = Array.from(systemNameCheckboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
      const label = selectedInformMessage.label.replace('{systemName}', checkedSystemNames.join(', '));
      informMessageTextarea.value = label;
    } else {
      informMessageTextarea.value = ''; // or some default value
    }
  });

  systemNameCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      const selectedInformType = informTypeSelect.value;
      const selectedInformMessage = informMessages.find(message => message.value === selectedInformType);
      if (selectedInformMessage) {
        const checkedSystemNames = Array.from(systemNameCheckboxes).filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
        const label = selectedInformMessage.label.replace('{systemName}', checkedSystemNames.join(', '));
        informMessageTextarea.value = label;
      } else {
        informMessageTextarea.value = ''; // or some default value
      }
    });
  });
});

</script>


</body>
</html>
