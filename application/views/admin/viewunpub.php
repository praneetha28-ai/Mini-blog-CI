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
    <style>
        #description{
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* number of lines to show */
                    line-clamp: 2; 
            -webkit-box-orient: vertical;
        }
    </style>
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
                <li class="nav-item active">
                    <div style="display: flex;justify-content: center;margin: 15px;">
                        <a class="nav-link" href="<?= base_url()?>index.php/admin/dashboard" style="color:#34827a">Home</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div style="display: flex;justify-content: center;margin: 15px;">
                        <a class="nav-link" href="addABlog" style="color:#34827a">Add Blog</a>
                    </div>
                </li>
                <li class="nav-item">
                    <div style="display: flex;justify-content: center;margin: 15px;">
                        <a class="nav-link" href="dashboard/unPubBlogView" style="color:#34827a">Unpublished Blogs</a>
                    </div>
                </li>
            </ul>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <div style="display: flex;justify-content: center;margin: 15px;background-color:#34827a;border-radius: 8px;color: white" id="patientLoginButton">
                    <a class="nav-link" href="login/logout"  style="color: white;">Signout</a>
                    </div>
                </li>
            </ul>
        </div> 
        <div class="container-fluid" style="display: flex;justify-content:center">
            <div class="allblogs">
                <?php 
                    // $totalRows = 8;
                    // $totalItems = 3*$totalRows;
                    $result = $this->db->query("SELECT * FROM `blogs` where status=0 order by created_on DESC ");
                    $imagepath = base_url();
                    if($result->num_rows()>0)
                    {
                        echo '<div class="row" >';
                        
                        $blogsList = $result->result_array();
                        $totalBlogs =sizeof($blogsList);
                        
                        for($i = 0;$i<$totalBlogs;$i++)
                        {
                            if($i%3==0)
                            {
                                echo "</div><div class='row' style='display:flex;justify-content: space-evenly'>";
                            }
                            $myimagepath = is_null($blogsList[$i]["blog_image"])?$imagepath."/assets/blog.jpg":$blogsList[$i]["blog_image"];
                            if(is_null($blogsList[$i]["blog_image"]))
                            {
                                $myimagepath=$imagepath."/assets/blog.jpg";
                            }
                            else
                            {
                                $serverpath = explode("/",$blogsList[$i]["blog_image"]);
                                $baseLoc= end($serverpath);
                                $myimagepath = $imagepath."/assets/uploads/".$baseLoc;

                            }
                            echo "<div class='col-md-4'>";
                            echo' <div class="card" style="width: 450px;height:400px;margin:8px">';
                            echo' <img class="card-img-top" src="'.$myimagepath.'" alt="Card image cap" width="100px" height="200px">';
                            echo' <div class="card-body">';
                            echo'     <h5 class="card-title">'.$blogsList[$i]["blog_title"].'</h5>';
                            echo'     <p class="card-text" id="description">'.$blogsList[$i]["blog_desc"].'</p>';
                            echo "<div style='display: flex;justify-content: space-evenly'>";
                            echo'<a href="'.$imagepath.'index.php/admin/dashboard/viewFullBlog/'.$blogsList[$i]["blogid"].'" class="btn " style="background-color: #34827a;color:white">View Blog</a>';
                            echo'<a href="'.$imagepath.'index.php/admin/dashboard/editBlog/'.$blogsList[$i]["blogid"].'" class="btn " style="background-color: #1e128b;color:white">Edit Blog</a>';
                            echo '<button class="btn delete" style="background-color:red;color:white" onclick=deleteBlog('.$blogsList[$i]["blogid"].')>Delete blog</button>';
                            echo '<button class="btn delete" style="background-color:green;color:white" onclick=publishBlog('.$blogsList[$i]["blogid"].')>Publish</button>';
                            echo "</div>";
                            echo'</div>';
                            echo'<div style="display:flex;justify-content:space-evenly">';
                            echo'<p>Posted on ';
                            echo '<h5 style="color: #34827a">';
                            echo explode(" ",$blogsList[$i]["created_on"])[0];
                            echo '</h5>';
                            echo'</p>';
                            echo'<p>Updated on ';
                            echo '<h5 style="color: #34827a">';
                            echo explode(" ",$blogsList[$i]["updated_on"])[0];
                            echo '</h5>';
                            echo'</p>';
                            echo'</div>';
                            echo '</div>';
                            echo "</div>";
                        }
                        
                    }

                ?>
               
            </div>
        </div>
    </div>
    <script>
        function deleteBlog(id)
        {
            Swal.fire({
                title:"Do you want to delete the blog",
                text:"You can not get back the blog after deletion",
                icon:"error",
                showCancelButton:true,
                cancelButtonText:"Cancel",
                confirmButtonText:"Yes, Delete!",

            }).then((result)=>{
                if(result.isConfirmed)
                {
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST","<?= base_url()?>index.php/admin/dashboard/deleteBlog/"+id);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("id="+id);
                    xhttp.onreadystatechange=function(){
                        if(this.readyState==4 && this.status==200)
                        {
                            var data = this.responseText;
                            console.log(data);
                            if(data=="success")
                            {
                                Swal.fire("Deleted successfully","","success").then((result)=>{
                                    if(result.isConfirmed){
                                        location.reload();
                                    }
                                    else{
                                        location.reload();
                                    }
                                }
                                )
                            }
                            else 
                            {
                                Swal.fire("Could not delete blof","","info").then((result)=>{
                                    if(result.isConfirmed){
                                        location.reload();
                                    }
                                    else{
                                        location.reload();
                                    }
                                }
                                )
                            }
                        }
                    }
                }
                else{
                    console.log("Cant delete");
                }
            })
        }
        function publishBlog(id)
        {
            Swal.fire({
                title:"Do you want to publish the blog",
                text:"You can again unpublish the blog",
                icon:"info",
                showCancelButton:true,
                cancelButtonText:"Cancel",
                confirmButtonText:"Yes, Publish!",

            }).then((result)=>{
                if(result.isConfirmed)
                {
                    var xhttp = new XMLHttpRequest();
                    xhttp.open("POST","<?= base_url()?>index.php/admin/dashboard/pubBlog/"+id);
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send("id="+id);
                    xhttp.onreadystatechange=function(){
                        if(this.readyState==4 && this.status==200)
                        {
                            var data = this.responseText;
                            console.log(data);
                            if(data=="success")
                            {
                                Swal.fire("Published successfully","","success").then((result)=>{
                                    if(result.isConfirmed){
                                        location.reload();
                                    }
                                    else{
                                        location.reload();
                                    }
                                }
                                )
                            }
                            else 
                            {
                                Swal.fire("Could not unpublish blog","","info").then((result)=>{
                                    if(result.isConfirmed){
                                        location.reload();
                                    }
                                    else{
                                        location.reload();
                                    }
                                }
                                )
                            }
                        }
                    }
                }
                else{
                    console.log("Cant delete");
                }
            })
        }
    </script>
</body>
</html>


