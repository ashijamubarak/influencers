<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller {
public function __construct(){
		
	  parent::__construct();
	 // if($this->session->userdata['user'] == '')
        // {
          // $data["flag"]=2;
          
         // redirect('Login');
        // }
      $this->load->model('Location_model');
	  $this->load->library('form_validation');
	  $this->load->helper(array('form', 'url'));
	  $this->load->library("pagination");
	  
       //$this->load->view('header/header');
       //$this->load->view('leftnavigation/nav1');
	  
			}
	
	
	
	public function index()
	{
		
	//	$stateid=$this->uri->segment(3);
	//	$data['stateid']=$stateid;
		//$data['stateid']=$this->uri->segment(4);
		$this->load->model('Location_model');
		$data['all_data'] = $this->Location_model->list();
		
		$this->load->view('Location/state_list',$data);
	}
  public function add_state(){
				
		
		//$data['districtid'] = $districtid;
       // $stateid= $this->uri->segment(4);
		//$data['stateid'] = $stateid;
		$this->load->view('add_state');
		
         // $this->load->view('header/header');
		// $this->load->view('leftnavigation/nav1');
      
}

public function add_district($id){
		$data['stateid']=$id;
		
		$this->load->view('Location/add_district',$data);
		
         // $this->load->view('header/header');
		// $this->load->view('leftnavigation/nav1');
      
}

public function add_city(){
		$districtid=$this->uri->segment(3);
		
		
		
		$data['districtid'] = $districtid;
		$data['stateid'] = $this->uri->segment(4);
		$this->load->view('Location/add_city',$data);
		
         // $this->load->view('header/header');
		// $this->load->view('leftnavigation/nav1');
      
}

	public function add_state_name()
	{
		    
        $randno=rand(10000, 1000000);
		$data = array(
		    'id'=>"itm_loc".md5($randno),
			
			'name' => $this->input->post('name'),
			'lat' => $this->input->post('lat'),
			'lng' => $this->input->post('lng'),
			'level'=>1,
			'status'=>1
			
			
			


		);
		$this->load->model('Location_model');
		
		
		 //$this->load->view('season/list');
		

		$this->Location_model->insert($data);
		redirect('Location');
		//print_r($_POST);
		 // $this->load->view('header/header');
		// $this->load->view('leftnavigation/nav1');

       }
	    
	public function add_district_name()
	{
$randno=rand(10000, 1000000);
		$data = array(
		    'id'=>"itm_loc".md5($randno),
			'sub_id_1'=>$this->input->post('stateid'),
			'name' => $this->input->post('name'),
			'lat' => $this->input->post('lat'),
			'lng' => $this->input->post('lng'),
			'level'=>2,
			'status'=>1
			
			
			


		);
		$this->load->model('Location_model');
		
		
		 //$this->load->view('season/list');
		

		$this->Location_model->insert($data);
		redirect('Location');
		//print_r($_POST);
		 // $this->load->view('header/header');
		// $this->load->view('leftnavigation/nav1');

	}
	    
	public function add_city_name()
	{
  $randno=rand(10000, 1000000);
		$data = array(
		 'id'=>"itm_loc".md5($randno),
		    'sub_id_1'=>$this->input->post('stateid'),
		    'sub_id_2'=>$this->input->post('districtid'),
			'name' => $this->input->post('name'),
			'lat' => $this->input->post('lat'),
			'lng' => $this->input->post('lng'),
			'level' => 3,

			'status'=>1

		);
		$this->load->model('Location_model');
			
			
			

		
		
		 //$this->load->view('season/list');
		

		$this->Location_model->insert($data);
		redirect('Location');
		//print_r($_POST);
		 // $this->load->view('header/header');
		// $this->load->view('leftnavigation/nav1');

	}
	   public function viewdistrict($id)
	{
		$stateid=$this->uri->segment(3);
		$data['stateid']=$stateid;
		$this->load->model('Location_model');
		$data['result'] = $this->Location_model->viewdistrict($id);
		$this->load->view('Location/viewdistrict',$data);
		
		//$id=$this->uri->segment(3);
				//$this->load->view('leftnavigation/nav');
		
	}
	 public function viewcity1()
	{
		$districtid=$this->uri->segment(3);
		$data['districtid']=$districtid;
		$data['stateid']=$this->uri->segment(4);
		$this->load->model('Location_model');
		$data['result'] = $this->Location_model->viewcity($districtid);
		$this->load->view('Location/viewcity',$data);
		
		//$id=$this->uri->segment(3);
				//$this->load->view('leftnavigation/nav');
		
	}
	public function viewcity(){
        	//$this->load->view('leftnavigation/nav');
			
		$districtid=$this->uri->segment(3);
		$data['districtid']=$districtid;
		$stateid = $this->uri->segment(4);
		$data['stateid']=$this->uri->segment(4);
		$this->load->model('Location_model');
		$data['result'] = $this->Location_model->viewcity($districtid);
        $config = array();
        $config["base_url"] = base_url() . "index.php/Location/viewcity/$districtid";
        $config["total_rows"] = $this->Location_model->get_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
       //$data["user_count"] = $this->Location_model->counts();
        $this->pagination->initialize($config);

		
		$page = ($this->uri->segment(4))? $this->uri->segment(4) : 0;
		
        $data["links"] = $this->pagination->create_links();

        $data['result'] = $this->Location_model->get_city($config["per_page"], $page,$districtid);
		
		$this->load->view('Location/viewcity',$data);
		

      
		//$this->load->view('leftnavigation/nav');
		
		
    }
  
	public function delete($id){
			// $districtid=$this->uri->segment(3);
		// $data['districtid']=$districtid;
		$this->load->model('Location_model');
		$data = array(
			'status' => 0
		);
		$result = $this->Location_model->del($id,$data);
		redirect('Location/viewcity');
		 $this->load->model("Location_model");
    // $this->Location_model->del($id,$data);
	}
	
}