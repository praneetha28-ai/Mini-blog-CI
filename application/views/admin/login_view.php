<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">

</head>
<body>


  <div class="container vh-100" style="align-content:center;width:50%">
  <form action="<?= base_url()?>index.php/admin/login/login_post" method="POST"> 
  <?php 
    if($error != "NO_ERROR")
    {
        echo '<div class="alert alert-danger" role="alert">';
        echo $error;
        echo "</div>";
    }
  ?>
      <h3 style="text-align: center;">Sign in Here</h3>
      <hr>
      <div class="form-floating">
        <input type="text" name="email" class="form-control" id="floatingInput" placeholder="">
        <label for="floatingInput">Username</label>
      </div>
      <br>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <br>
      <button class="btn w-100 py-2" style="background-color: #34827a;color:white" type="submit">Sign in</button>
  </form>
  </div>

</body>
</html>