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
            <option value="unplannedOutage">Unplanned Outage - System Name</option>
            <option value="plannedOutage">Planning Outage - System Name, DATE</option>
            <option value="newProcedure">New Procedure</option>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="systemName" class="col-sm-2 control-label">System Name:</label>
        <div class="col-sm-10">
          <input type="text" id="systemName" name="systemName" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <label for="insertDate" class="col-sm-2 control-label">Insert Date:</label>
        <div class="col-sm-10">
          <input type="date" id="insertDate" name="insertDate" class="form-control">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <input type="submit" value="Generate Template" class="btn btn-primary">
        </div>
      </div>
    </form>
  </div>
</body>
</html>
