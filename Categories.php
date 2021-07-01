<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {
public function __construct(){
		
	  parent::__construct();
	 // if($this->session->userdata['user'] == '')
        // {
          // $data["flag"]=2;
          
         // redirect('Login');
		// }   
		$this->load->model('Categories_model');
	  $this->load->library('form_validation');
	  $this->load->helper(array('form', 'url'));
		}
		// public function index()
	// {
		
		// $stateid=$this->uri->segment(3);
		// $data['stateid']=$stateid;
		//$data['stateid']=$this->uri->segment(4);
		// $this->load->model('Categories_model');
		// $data['all_data'] = $this->Categories_model->list($stateid);
		
		// $this->load->view('categories_list',$data);
	// }
		public function index()
	{
		
		$cat_id=$this->uri->segment(3);
		$data['cat_id']=$cat_id;
		//$data['stateid']=$this->uri->segment(4);
		$this->load->model('Categories_model');
		$data['all_data'] = $this->Categories_model->list($cat_id);
		
		$this->load->view('category/categories_list',$data);
	}
	public function add_category(){
				
		
		//$data['districtid'] = $districtid;
       // $stateid= $this->uri->segment(4);
		//$data['stateid'] = $stateid;
		$this->load->view('category/add_category');
		
         // $this->load->view('header/header');
		// $this->load->view('leftnavigation/nav1');
      
	}
	public function add_cat_name()
	{
		$this->load->library('upload');
	  $config=array(
	    'upload_path'=>FCPATH.'uploads/categories',
		'allowed_types'=>'gif|jpg|jpeg|jpg|png|gif',
		'max_size'=>'22600',
		
	  
	  );
	  $this->upload->initialize($config);
	  $this->upload->do_upload("fileToUpload");
	  $fileToUpload_data=$this->upload->data();
	  $img=$fileToUpload_data["file_name"];
	 
	 
	
	 //create array of image data to upload in database
	 $this->load->library('upload',$config);
			//$this->upload->initialize($config);
				

		
		    
        $randno=rand(10000, 1000000);
		$data = array(
		    'cat_id'=>"cat".md5($randno),
			
			'cat_name' => $this->input->post('name'),
			'cat_ordering' => $this->input->post('pref'),
			
			'status'=>1
			
		
		
		  );
		 //  $randno=rand(10000, 1000000);
		$data2 = array(
		    'img_id'=>"img".md5($randno),
		    'img_parent_id'=>"cat".md5($randno),
			
			'img_path' => $this->input->post('fileToUpload'),
			'img_type' => 'category'
			
			
			
		
		
		  );
		  $this->load->model('Categories_model');
			//$this->letter_model->update($id,$data);
		
		//if($id){
		//}else{
			$this->Categories_model->insert($data);
			$this->Categories_model->inserts($data2);
		
		
	redirect('Categories/');
		
		//redirect('Letter');
		}
		  public function viewsubcategory($id)
	{
		$cat_id=$this->uri->segment(3);
		$data['cat_id']=$cat_id;
		$this->load->model('Categories_model');
		$data['result'] = $this->Categories_model->viewsubcategory($id);
		$this->load->view('category/viewsubcategory',$data);
		
		//$id=$this->uri->segment(3);
				//$this->load->view('leftnavigation/nav');
		
	}
	public function add_subcategory_name()
	{
		$this->load->library('upload');
	  $config=array(
	    'upload_path'=>FCPATH.'uploads/',
		'allowed_types'=>'gif|jpg|jpeg|jpg|png|gif',
		'max_size'=>'22600',
		
	  
	  );
	  $this->upload->initialize($config);
	  $this->upload->do_upload("fileToUpload");
	  $fileToUpload_data=$this->upload->data();
	  $img=$fileToUpload_data["file_name"];
	 
	 
	
	 //create array of image data to upload in database
	 $this->load->library('upload',$config);
			//$this->upload->initialize($config);
				

		
		    
        $randno=rand(10000, 1000000);
		$data = array(
		    'id'=>"subcat".md5($randno),
		    'cat_id'=>$this->input->post('cat_id'),
			
			'name' => $this->input->post('name'),
			
			
			'status'=>1
			
		
		
		  );
		 //  $randno=rand(10000, 1000000);
		$data2 = array(
		    'img_id'=>"img".md5($randno),
		    'img_parent_id'=>"subcat".md5($randno),
			
			'img_path' => $this->input->post('fileToUpload'),
			'img_type' => 'subcategory'
			
			
			
		
		
		  );
		  $this->load->model('Categories_model');
			//$this->letter_model->update($id,$data);
		
		//if($id){
		//}else{
			// $this->Categories_model->insert($data);
			// $this->Categories_model->inserts($data2);
		
		$this->Categories_model->insertsubcat($data);
			$this->Categories_model->insertsubcoreimg($data2);
			
	redirect('Categories/');
		
		//redirect('Letter');
		}
	public function add_subcategory_name1()
	{
		$this->load->library('upload');
	  $config=array(
	    'upload_path'=>FCPATH.'uploads/',
		'allowed_types'=>'gif|jpg|jpeg|jpg|png|gif',
		'max_size'=>'22600',
		
	  
	  );
	  $this->upload->initialize($config);
	  $this->upload->do_upload("fileToUpload");
	  $fileToUpload_data=$this->upload->data();
	  $img=$fileToUpload_data["file_name"];
	 
	 
	
	 //create array of image data to upload in database
	 $this->load->library('upload',$config);
			//$this->upload->initialize($config);
				

		
		    
        $randno=rand(10000, 1000000);
		$data = array(
		    // 'cat_id'=>$this->input->post('cat_id'),
		    'id'=>"subcat".md5($randno),
			
			
			'name' => $this->input->post('name'),
			
			
			'status'=>1
			
		
		
		  );
		 
		 //  $randno=rand(10000, 1000000);
		$data2 = array(
		    'img_id'=>"img".md5($randno),
		    'img_parent_id'=>"cat".md5($randno),
			
			'img_path' => $this->input->post('fileToUpload'),
			'img_type' => 'category'
			
			
			
		
		
		  );
		$this->load->model('Categories_model');//if($id){
		//}else{
			$this->Categories_model->insertsubcat($data);
			$this->Categories_model->insertsubcoreimg($data2);
			
		
		
	redirect('Categories');
		
		//redirect('Letter');
}
  public function add_subcategory($id){
		$data['cat_id']=$id;
		
		$this->load->view('category/add_subcategory',$data);
		
         // $this->load->view('header/header');
		// $this->load->view('leftnavigation/nav1');
      
}

      public function editcategory($id)
	{
		
		$cate_id=$this->uri->segment(3);
		$data['cate_id']=$cate_id;
		$this->load->model('Categories_model');
		$data['all_data'] = $this->Categories_model->editcategory($cate_id);
		$this->load->view('category/category_edit',$data);
		
		//$id=$this->uri->segment(3);
		// $this->load->view('header/header');
	   
		// $this->load->view('leftnavigation/nav1');

	}
	
      public function editsubcategory($id)
	{
		
		
		$id=$this->uri->segment(3);
		$data['cat_id']=$id;
		
		$this->load->model('Categories_model');
		$data['all_data'] = $this->Categories_model->editsubcategory($id);
		$this->load->view('category/subcategory_edit',$data);
		
		//$id=$this->uri->segment(3);
		// $this->load->view('header/header');
	   
		// $this->load->view('leftnavigation/nav1');

	}
public function deletecategory($id){
			// $districtid=$this->uri->segment(3);
		// $data['districtid']=$districtid;
		$this->load->model('Categories_model');
		$data = array(
			'status' => 0
		);
		$result = $this->Categories_model->deletecategory($id,$data);
		redirect('Categories');
		 $this->load->model("Categories_model");
    // $this->Location_model->del($id,$data);
}
public function deletesubcategory($id){
			// $districtid=$this->uri->segment(3);
		// $data['districtid']=$districtid;
		$this->load->model('Categories_model');
		$data = array(
			'status' => 0
		);
		$result = $this->Categories_model->deletesubcategory($id,$data);
		redirect('Categories');
		 $this->load->model("Categories_model");
    // $this->Location_model->del($id,$data);
}
	public function updatecategory1()
	
		{
		$this->load->library('upload');
	  $config=array(
	    'upload_path'=>FCPATH.'uploads/',
		'allowed_types'=>'gif|jpg|jpeg|jpg|png|gif',
		'max_size'=>'22600',
		
	  
	  );
	  $this->upload->initialize($config);
	  $this->upload->do_upload("fileToUpload");
	  $fileToUpload_data=$this->upload->data();
	  $img=$fileToUpload_data["file_name"];
	 
	 
	
	 //create array of image data to upload in database
	 $this->load->library('upload',$config);
			//$this->upload->initialize($config);
				

		
		    
        $randno=rand(10000, 1000000);
		$data = array(
		    'cat_id'=>"cat".md5($randno),
			
			'cat_name' => $this->input->post('name'),
			'cat_ordering' => $this->input->post('pref'),
			
			'status'=>1
			
		
		
		  );
		 //  $randno=rand(10000, 1000000);
		
		  $this->load->model('Categories_model');
			
		
				
		$id=$this->input->post('cat_id');
		if($id){
			//$this->Letter_model->update($id,$data);
			$this->Categories_model->updatecat($data);
			$this->Categories_model->updatecoreimg($data2);
		
		}else{
		
		
	redirect('Categories/');
		
		//redirect('Letter');
$this->load->model('Categories_model');
		
		
		 //$this->load->view('season/list');
		
				
		$id=$this->input->post('cat_id');
		if($id){
			$this->Categories_model->updatecat($id,$data);
			
		}else{
		$this->Categories_model->insert($data);
		redirect('Packages');
		//print_r($_POST);
		 // $this->load->view('header/header');
		// $this->load->view('leftnavigation/nav1');

       }
  
		}
		}
		
		public function updatecategory()
{
		$this->load->library('upload');
	  $config=array(
	    'upload_path'=>FCPATH.'uploads/categories',
		'allowed_types'=>'gif|jpg|jpeg|jpg|png|gif',
		'max_size'=>'22600',
		
	  
	  );
	  $this->upload->initialize($config);
	  $this->upload->do_upload("fileToUpload");
	  $fileToUpload_data=$this->upload->data();
	  $img=$fileToUpload_data["file_name"];
	 
	 
	
	 //create array of image data to upload in database
	 $this->load->library('upload',$config);
			//$this->upload->initialize($config);
		$cat_id=$this->input->post('cat_id');
				

		
		    
        $randno=rand(10000, 1000000);
		$data = array(
		   
			
			'cat_name' => $this->input->post('name'),
			'cat_ordering' => $this->input->post('pref'),
			
			'status'=>1
			
		
		
		  );
		 //  $randno=rand(10000, 1000000);
		$data2 = array(
		    'img_id'=>"img".md5($randno),
		    'img_parent_id'=>$cat_id,
			
			'img_path' => $this->input->post('fileToUpload'),
			'img_type' => 'category'
			
			
			
		
		
		  );
		 $this->load->model('Categories_model');
		
		
		//$cat_id=$this->uri->segment(3);
		// $data['cat_id']=$cat_id;
		//$img_id=$this->uri->segment(4);
		// $data['img_id']=$img_id;
			
		//$cat_id=$this->input->post('cat_id');
		//$img_id=$this->input->post('img_id');
				
		if($cat_id){
			$this->Categories_model->update($cat_id,$data);
			$this->Categories_model->update_image($cat_id,$data2);
	
		redirect('Categories');
		}
			
}

		public function updatesubcategory()
{
		$this->load->library('upload');
	  $config=array(
	    'upload_path'=>FCPATH.'uploads/categories',
		'allowed_types'=>'gif|jpg|jpeg|jpg|png|gif',
		'max_size'=>'22600',
		
	  
	  );
	  $this->upload->initialize($config);
	  $this->upload->do_upload("fileToUpload");
	  $fileToUpload_data=$this->upload->data();
	  $img=$fileToUpload_data["file_name"];
	 
	 
	
	 //create array of image data to upload in database
	 $this->load->library('upload',$config);
			//$this->upload->initialize($config);
		$cat_id=$this->input->post('cat_id');
				

		    
        $randno=rand(10000, 1000000);
		$data = array(
		   
			
			
			'name' => $this->input->post('name'),
		     'status'=>1
		
		 );
		    
        
		 //  $randno=rand(10000, 1000000);
		$data2 = array(
		   
			
			 
		    
			
			'img_path' => $this->input->post('fileToUpload'),
			'img_type' => 'subcategory'
			
		
		
		  );
		 $this->load->model('Categories_model');
		
		
		//$cat_id=$this->uri->segment(3);
		// $data['cat_id']=$cat_id;
		//$img_id=$this->uri->segment(4);
		// $data['img_id']=$img_id;
			
		//$cat_id=$this->input->post('cat_id');
		//$img_id=$this->input->post('img_id');
				
		if($cat_id){
			$this->Categories_model->updatesubcategory($cat_id,$data);
			$this->Categories_model->update_subimage($cat_id,$data2);
	
		redirect('Categories');
		}
			
}

		public function updatesubcategory1()
{
		$this->load->library('upload');
	  $config=array(
	    'upload_path'=>FCPATH.'uploads/',
		'allowed_types'=>'gif|jpg|jpeg|jpg|png|gif',
		'max_size'=>'22600',
		
	  
	  );
	  $this->upload->initialize($config);
	  $this->upload->do_upload("fileToUpload");
	  $fileToUpload_data=$this->upload->data();
	  $img=$fileToUpload_data["file_name"];
	 
	 
	
	 //create array of image data to upload in database
	 $this->load->library('upload',$config);
			//$this->upload->initialize($config);
				

		
		    
        $randno=rand(10000, 1000000);
		$data = array(
		    'id'=>"cat".md5($randno),
			
			'name' => $this->input->post('name'),
			
			
			'status'=>1
			
		
		
		  );
		 //  $randno=rand(10000, 1000000);
		
		 $this->load->model('Categories_model');
		
		
		//$cat_id=$this->uri->segment(3);
		// $data['cat_id']=$cat_id;
		//$img_id=$this->uri->segment(4);
		// $data['img_id']=$img_id;
			
		//$cat_id=$this->input->post('cat_id');
		//$img_id=$this->input->post('img_id');
				
		$id=$this->input->post('id');
		if($id){
			$this->Categories_model->updatesubcategory($id,$data);
	
		redirect('Categories');
		}
			
}
	}