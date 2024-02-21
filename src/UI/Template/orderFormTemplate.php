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
        <a href="?action=price">Shipping prices</a>
        <a href="?action=upload">Upload shipping prices from CSV</a>
      </div>
      <div class="row">
        <?php
        if ($errors) {
          foreach ($errors as $error) {
            echo "<p>$error</p>";
          }
        }
        ?>
        <h1>Order form</h1>
        <form action="index.php" method="post">
          <div class="form-group">
            <label for="postcode">Postal code</label>
            <input required min="10000" max="99999" name="postcode" type="number"
                   class="form-control" placeholder="Enter postal code"
                   value="<?= ($_POST['postcode'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label for="amount">Order amount</label>
            <input required min="0" name="amount" type="number" class="form-control" placeholder="Enter order amount"
                   value="<?= ($_POST['amount'] ?? '') ?>">
          </div>
          <div class="form-group">
            <input class="form-check-input" type="checkbox" name="long" <?=(isset($_POST['long']) ? 'checked' : '')?> >
            <label class="form-check-label" for="flexCheckDefault">
              Long order
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="row">
        <?php if ($shipping != 0) : ?>
          <h3>Shipping: <?=($shipping)?></h3>
        <?php endif ?>
      </div>
    </div>
</body>
</html>