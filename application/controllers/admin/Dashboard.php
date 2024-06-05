<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		
		if(isset($_SESSION["user_id"]))
		{
			$this->load->view('admin/dashboard_view');
		}
		else 
		{
			redirect('admin/login');
		}
	}
	public function addABlog()
	{
		$data=[];
		if(isset($_SESSION["success"]))
		{
			$data["success"]=$_SESSION["success"];
		}
		else
		{
			$data["success"] = "Could not add the new blog";
		}
		$this->load->view('admin/addblog',$data);

	}
	
	public function addBlogToDb()
	{
		print_r($_FILES);
		$data = $this->do_upload();
		$path = $this->upload->data('full_path');
		
		$blogTitle = $_POST["blogtitle"];
		$blogDesc = $_POST["blogdesc"];
		$result = $this->db->query("INSERT INTO `blogs`( `blog_title`, `blog_desc`,`blog_image`) VALUES ('$blogTitle','$blogDesc','$path')");
		if($result)
		{
			$this->session->set_flashdata("success","Blog posted successfully");
		}
		
		redirect("admin/dashboard/addABlog");
	}
	private function do_upload()
    {
        $config['upload_path']          ="./assets/uploads/";
        $config['allowed_types']        = 'jpg|png|jpeg';
        
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('imagefile'))
        {
            $error = array('error' => $this->upload->display_errors());

            return json_encode($error); 
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            return $data;
        }
    }

	public function editBlog($blog_id)
	{
		
		$result = $this->db->query("SELECT * FROM `blogs` where blogid=$blog_id");
		if($result->num_rows()>0)
		{
			$data["blogdetails"] = $result->result_array();

		}
		// print_r( $data);

		$this->load->view("admin/edit_view",$data);

		if(isset($_POST["editnewblog"]))
		{
			
			if (!empty($_FILES['imagefile']['name']))
			{
				$data = $this->do_upload();
				$path = $this->upload->data('full_path');
				$result = $this->db->query("UPDATE `blogs` SET `blog_title`='{$_POST["blogtitle"]}',`blog_desc`='{$_POST["blogdesc"]}',`blog_image`='{$path}' WHERE blogid=$blog_id");
			}
			else 
			{
				$result = $this->db->query("UPDATE `blogs` SET `blog_title`='{$_POST["blogtitle"]}',`blog_desc`='{$_POST["blogdesc"]}' WHERE blogid=$blog_id");
			}
			
			if($result)
			{
				$this->session->set_flashdata("edit_success","Blog edited successfully");
				$data["edit_success"] = $_SESSION["edit_success"];
			}
			else
			{
				$this->session->set_flashdata("edit_fail","Failed to edit blog");
				$data["edit_fail"] = $_SESSION["edit_fail"];
			}
			redirect("admin/dashboard/editBlog/".$blog_id,$data);
		}
		
	}
	function viewFullBlog($blogid)
	{
		$result = $this->db->query("SELECT * FROM blogs where blogid=$blogid");
		if($result)
		{
			$row = $result->result_array();
			$data["blogdetails"] = $row;
			$this->load->view("admin/viewBlog",$data);
		}
		
	}
	function deleteBlog($blogid)
	{
		$sql = "DELETE FROM `blogs` WHERE blogid=$blogid";
		$result = $this->db->query($sql);
		if($result)
		{
			echo "success";
		}
		else{
			echo "fail";
		}
	}
	function unpubBlog($blogid)
	{
		$sql = "UPDATE blogs set status=0 where blogid=$blogid";
		$result = $this->db->query($sql);
		if($result)
		{
			echo "success";
		}
		else{
			echo "fail";
		}
	}
	function pubBlog($blogid)
	{
		$sql = "UPDATE blogs set status=1 where blogid=$blogid";
		$result = $this->db->query($sql);
		if($result)
		{
			echo "success";
		}
		else{
			echo "fail";
		}
	}
	function unPubBlogView()
	{
		$this->load->view("admin/viewunpub");
	}
}
