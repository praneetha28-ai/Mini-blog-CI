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
    <div class="container-fluid">
        <div class="navbar  justify-content-space">
            <ul class="nav justify-content-end">
                <li class="nav-item" style="align-self: center;">
                    <div style="display: flex;justify-content: center;margin: 15px;color:#34827a">
                        <h3>Blogs</h3>
                    </div>
                </li>
            </ul>
            <ul class="nav justify-content-center">
                <h3>Full Blog</h3>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <div style="display: flex;justify-content: center;margin: 15px;background-color:#34827a;border-radius: 8px;color: white" id="patientLoginButton">
                    <a class="nav-link" href="login/logout"  style="color: white;">Signout</a>
                    </div>
                </li>
            </ul>
        </div>
        <hr>
        <div class="container-fluid">
        <div class="row" style="display: flex;justify-content:center">
            <div class="col-md-6 " style="display: flex;justify-content:center">
            <?php
                if(is_null($blogdetails[0]["blog_image"]))
                {
                    $path = base_url()."assets/blog.jpg";
                } 
                else
                {
                    $serverpath = explode("/",$blogdetails[0]["blog_image"]);
                    $baseLoc= end($serverpath);
                    $path = base_url()."/assets/uploads/".$baseLoc;

                }
            ?>
                <img src="<?php echo $path?>" alt="" width="650px" height="650px">
            </div>
            <div class="col-md-6" >
                <div class="row"  style="background-color:rgb(233,233,233);width:700px;border-radius:8px">
                    <h4><?php echo $blogdetails[0]["blog_title"];?></h4>
                </div>
                <br>
                <div style="height: 693px;overflow:scroll;width:700px;">
                    <p><?php echo $blogdetails[0]["blog_desc"];?></h5>
                </div>
            </div>
        </div>
        </div>
    </div>
</body>
</html>