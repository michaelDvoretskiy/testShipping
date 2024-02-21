<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
      <div class="row">
        <a href=".">Home page</a>
      </div>
      <div class="row">
        <h1>Upload price</h1>
        <form action="index.php?action=uploadCsv" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="postcode">Select csv file</label>
            <input type="file" name="csv" accept="csv/csv" />
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
</body>
</html>