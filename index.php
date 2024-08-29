<?php
$data = json_decode(file_get_contents('data.json'), true);

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
  <div class="container px-5 my-5">
    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
      <div class="mb-3">
        <label class="form-label" for="informType">Inform Type</label>
        <select class="form-select" id="informType" aria-label="Inform Type" onchange="updateNotificationText(this.value)">
          <?php foreach ($informTypes as $type) { ?>
            <option value="<?php echo $type['value']; ?>"><?php echo $type['label']; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label d-block">System(s)</label>
        <?php foreach ($systemNames as $name) { ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" id="<?php echo $name['value']; ?>" type="checkbox" name="systemS" data-sb-validations="required" />
            <label class="form-check-label" for="<?php echo $name['value']; ?>"><?php echo $name['label']; ?></label>
          </div>
        <?php } ?>
        <div class="invalid-feedback" data-sb-feedback="systemS:required">One option is required.</div>
      </div>
      <div class="mb-3">
        <label class="form-label" for="notificationText">Notification Text</label>
        <textarea class="form-control" id="notificationText" type="text" placeholder="Notification Text" style="height: 10rem;" data-sb-validations="required"></textarea>
        <div class="invalid-feedback" data-sb-feedback="notificationText:required">Notification Text is required.</div>
      </div>
      <!-- Rest of the form fields -->
      <div class="mb-3">
        <label class="form-label" for="from">From</label>
        <select class="form-select" id="from" aria-label="From">
          <option value="Service Desk">Service Desk</option>
          <option value="Infrastrucutre Team">Infrastrucutre Team</option>
          <option value="Business Systems">Business Systems</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label" for="moreInfoBlurb">More Info Blurb</label>
        <textarea class="form-control" id="moreInfoBlurb" type="text" placeholder="More Info Blurb" style="height: 10rem;" data-sb-validations="required"></textarea>
        <div class="invalid-feedback" data-sb-feedback="moreInfoBlurb:required">More Info Blurb is required.</div>
      </div>
      <div class="d-none" id="submitSuccessMessage">
        <div class="text-center mb-3">
          <div class="fw-bolder">Form submission successful!</div>
          <p>To activate this form, sign up at</p>
          <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
        </div>
      </div>
      <div class="d-none" id="submitErrorMessage">
        <div class="text-center text-danger mb-3">Error sending message!</div>
      </div>
      <div class="d-grid">
        <button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit">Submit</button>
      </div>
    </form>
  </div>

  <script>
    function updateNotificationText(informTypeValue) {
      var notificationText = document.getElementById('notificationText');
      var notificationTexts = <?php echo json_encode($notificationTexts); ?>;
      for (var i = 0; i < notificationTexts.length; i++) {
        if (

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