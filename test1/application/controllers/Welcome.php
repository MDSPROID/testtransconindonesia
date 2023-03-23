<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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

	function __construct(){
		parent::__construct();
		$this->load->model('home');
	}

	public function index()
	{	
		$data['get_list'] = $this->home->get_list();
		$this->load->view('welcome_message', $data); 
	}

	function addItem(){ // insert & update
		$data = $this->security->xss_clean($this->input->post());
		if($data['id'] == ""){ // insert
			$this->home->add($data); 
		}else{
			$this->home->update($data); 
		}
		$arr = array('code'=>200, 'description'=> 'Data Berhasil Disimpan');
		header('Content-Type: application/json');
		echo json_encode( $arr );
	}

	function getordeleteItem(){
		$data = $this->security->xss_clean($this->input->get());
		if($data['act'] == "edit" || $data['act'] == "view"){
			$get = $this->home->get($data);
			if($data['act'] == "edit"){
				$btnclone = '<a href="javascript:void(0);" class="bagde badge-success clone" style="padding:2px 10px;margin-right:5px;">
								<i style="font-size:10px" class="fa fa-plus"></i>
							</a>
							<a href="javascript:void(0);" class="bagde badge-danger delete"  style="padding:2px 10px">
								<i style="font-size:10px" class="fa fa-trash"></i>
							</a>';
			}else{
				$btnclone = '';
			}

			// get detail items
			$id = $get->id;
			$getItems = $this->home->getItems($id);
			$items = "";
			foreach($getItems as $t){
				$items .= ' <div class="toclone">
								'.$btnclone.'
								<div class="form-row" style="margin-top: 15px;">
									<div class="form-group col-md-6 col-xs-6">
										<input type="text" name="item_name[]" value="'.$t->item.'" class="form-control">
									</div>
									<div class="form-group col-md-6 col-xs-6">
										<input type="number" name="qty[]" value="'.$t->quantity.'" class="form-control">
									</div>
								</div>
							</div>';
			}
			$arr = array('code'=>200, 'data'=> $get, 'listItem'=>$items);
		}else{
			$this->home->delete($data);
			$arr = array('code'=>200, 'description'=> 'Data Berhasil Dihapus');
		}
		header('Content-Type: application/json');
    	echo json_encode( $arr );
	}
}
