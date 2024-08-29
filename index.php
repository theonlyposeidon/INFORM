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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<form>
  <div class="form-group row">
    <label for="informType" class="col-4 col-form-label">Inform Type</label> 
    <div class="col-8">
      <select id="informType" name="informType" class="custom-select" required="required">
        <option value="unplannedOutage">Unplanned Outage</option>
        <option value="plannedOutage">Planned Outage</option>
        <option value="multipleOutage">Multiple Systems Outage</option>
        <option value="resolvedUnplanned">Resolved Unplanned Outage</option>
        <option value="completePlanned">Planned Outage Completed</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">System(s)</label> 
    <div class="col-8">
      <div class="custom-control custom-radio custom-control-inline">
        <input name="systemName" id="systemName_0" type="radio" class="custom-control-input" value="agresso"> 
        <label for="systemName_0" class="custom-control-label">Agresso</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="systemName" id="systemName_1" type="radio" class="custom-control-input" value="aquarius"> 
        <label for="systemName_1" class="custom-control-label">Aquarius</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="systemName" id="systemName_2" type="radio" class="custom-control-input" value="citrix"> 
        <label for="systemName_2" class="custom-control-label">Citrix</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="systemName" id="systemName_3" type="radio" class="custom-control-input" value="few-hyfm"> 
        <label for="systemName_3" class="custom-control-label">FEWS/HyFM</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="systemName" id="systemName_4" type="radio" class="custom-control-input" value="fileservices"> 
        <label for="systemName_4" class="custom-control-label">File Servers/Mapped Drives</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="systemName" id="systemName_5" type="radio" class="custom-control-input" value="geocortex"> 
        <label for="systemName_5" class="custom-control-label">Geocortex</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="systemName" id="systemName_6" type="radio" class="custom-control-input" value="arcgis"> 
        <label for="systemName_6" class="custom-control-label">ArcGIS</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="systemName" id="systemName_7" type="radio" class="custom-control-input" value="heat"> 
        <label for="systemName_7" class="custom-control-label">Service@GMW</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="systemName" id="systemName_8" type="radio" class="custom-control-input" value="maximo"> 
        <label for="systemName_8" class="custom-control-label">Maximo</label>
      </div>
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
      <textarea id="signature Text" name="signature Text" cols="40" rows="2" class="form-control"></textarea>
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</body>
</html>