<?php
$data = json_decode(file_get_contents('values.json'), true);

$informTypes = $data['informTypes'];
$systemNames = $data['systemNames'];
$notificationTexts = $data['notificationText'];
$signatureTexts = $data['signatureText'];
$signOffTypes = $data['signOffTypes'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Goulburn-Murray Water</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<script>
  const informTypes = <?php echo json_encode($data['informTypes']); ?>;
  const notificationTexts = <?php echo json_encode($data['notificationText']); ?>;
  const notificationTextarea = document.getElementById('notificationText');
  const signOffSelect = document.getElementById('signOff');
  const signatureTextarea = document.getElementById('signatureText');
  const signatureTexts = <?php echo json_encode($signatureTexts); ?>;
  const signOffTypes = <?php echo json_encode($signOffTypes); ?>;

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
});

function updatePreviewPanel() {
  // Get the values of the form fields
  var informType = document.querySelector('select[name="informType"]').value;
  var systemName = document.querySelector('input[name="systemName"]').value;
  var insertDate = document.querySelector('input[name="insertDate"]').value;
  var notificationText = document.querySelector('textarea[name="notificationText"]').value;
  var signatureText = document.querySelector('textarea[name="signatureText"]').value;
  var signOff = document.querySelector('select[name="signOff"]').value;

  // Generate the INFORM message based on the user's selection
  var informMessage;
  switch (informType) {
    case 'unplannedOutage':
      informMessage = "INFORM: Unplanned Outage - " + systemName;
      break;
    case 'plannedOutage':
      informMessage = "INFORM: Planning Outage - " + systemName + ", " + insertDate;
      break;
    case 'newProcedure':
      informMessage = "INFORM: New Procedure";
      break;
  }

  // Create a new HTML template with the updated values
  var htmlTemplate = `
    <div class="header">
      <img class="logo" src="images/image001.png" alt="Goulburn-Murray Water Logo">
    </div>
    <div class="date">
      ${new Date().toLocaleDateString('en-AU', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })}
    </div>
    <div class="container">
      <div class="info">
        <h2 class="heading">${informMessage}</h2>
        <p>${notificationText}</p>
      </div>

      <div class="footer">
        <p>${signatureText}</p>
        <p><b>${signOff}<br>
        Information Technology<br>
        Business and Finance</b></p>
      </div>
    </div>
  `;

  // Update the preview panel with the new HTML template
  document.getElementById('preview-panel').innerHTML = htmlTemplate;
};

document.querySelector('select[name="informType"]').addEventListener('change', updatePreviewPanel);
document.querySelector('input[name="systemName"]').addEventListener('input', updatePreviewPanel);
document.querySelector('input[name="insertDate"]').addEventListener('input', updatePreviewPanel);
document.querySelector('textarea[name="notificationText"]').addEventListener('input', updatePreviewPanel);
document.querySelector('textarea[name="signatureText"]').addEventListener('input', updatePreviewPanel);
document.querySelector('select[name="signOff"]').addEventListener('change', updatePreviewPanel);

// Get the informMessage textarea
const informMessageTextarea = document.getElementById('informMessage');

// Add event listener to informType select
document.querySelector('select[name="informType"]').addEventListener('change', updateInformMessage);

// Add event listener to systemName checkboxes
document.querySelectorAll('input[name="systemName"]').forEach(checkbox => {
  checkbox.addEventListener('change', updateInformMessage);
});

// Function to update informMessage
function updateInformMessage() {
  // Get the selected informType
  const selectedInformType = document.querySelector('select[name="informType"]').value;

  // Get the selected systemNames
  const selectedSystemNames = [];
  document.querySelectorAll('input[name="systemName"]:checked').forEach(checkbox => {
    selectedSystemNames.push(checkbox.value);
  });

  // Generate the informMessage based on the selected informType and systemNames
  let informMessage;
  switch (selectedInformType) {
    case 'unplannedOutage':
      informMessage = "INFORM: Unplanned Outage - " + selectedSystemNames.join(', ');
      break;
    case 'plannedOutage':
      informMessage = "INFORM: Planned Outage - " + selectedSystemNames.join(', ') + ", " + document.querySelector('input[name="insertDate"]').value;
      break;
    case 'newProcedure':
      informMessage = "INFORM: New Procedure";
      break;
    default:
      informMessage = '';
  }

  // Update the informMessage textarea
  informMessageTextarea.value = informMessage;
}

</script>

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
          <textarea id="informMessage" name="informMessage" cols="40" rows="6" class="form-control"></textarea>
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
    <div id="preview-panel"></div>
  </div>
</div>          

</body>
</html>
