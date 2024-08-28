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
