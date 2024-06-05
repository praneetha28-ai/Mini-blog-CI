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
                <h3 style="color: #34827a;">Edit your Blog here</h3>
            </ul>
            <ul class="nav justify-content-end">
               
                <li class="nav-item">
                    <div style="display: flex;justify-content: center;margin: 15px;background-color:#34827a;border-radius: 8px;color: white" id="patientLoginButton">
                    <a class="nav-link" href="<?= base_url()?>admin/index.php/login/logout"  style="color: white;">Signout</a>
                    </div>
                </li>
            </ul>
        </div> 
        <?php 
           
           if ($this->session->flashdata('edit_success')) {
               echo "<div class='alert alert-success'>";
               echo $this->session->flashdata('edit_success');
               echo "</div>";
           }
           
           if ($this->session->flashdata('edit_fail')) {
               echo "<div class='alert alert-danger'>";
               echo $this->session->flashdata('edit_fail');
               echo "</div>";
           }
           
        ?>
        <div class="container" style="display: flex;flex-direction:column;justify-content:space-evenly">
            <form action="<?= base_url('index.php/admin/dashboard/editBlog/' . $blogdetails[0]["blogid"]); ?>" method="POST" enctype="multipart/form-data">
                <div class="row" style="margin:10px">
                    <label  style="background-color: #34827a;color:white;text-align:center;" class="col-md-4" for="title">Title</label>
                    <input required name="blogtitle" value="<?php echo $blogdetails[0]["blog_title"] ;?>" class="col-md-8" type="text">
                </div>
                <div class="row" style="margin:10px">
                    <label style="background-color: #34827a;color:white;text-align:center;height:150px;align-content:center" class="col-md-4" for="title">Description</label>
                    <textarea style="height: 150px;align-content:start" class="col-md-8" max name="blogdesc" type="text"><?php echo $blogdetails[0]["blog_desc"] ;?></textarea>
                </div>
                <div class="row" style="margin:10px">
                    <label style="background-color: #34827a;color:white;text-align:center" class="col-md-4" for="title">Image</label>
                    <input class="col-md-8" type="file" name="imagefile">
                </div>
                <div class="row" style="margin:10px">
                    <input type="submit" class="btn" name="editnewblog" style="background-color: #34827a;color:white" id="" value="Update Now">
                </div>
            </form>
        </div>
    </div>
</body>
</html>