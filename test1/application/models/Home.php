<?php
class Home extends CI_Model{ 
 
	function get_list(){ 
        $this->db->select('*');
		$this->db->from('transactions');
		$this->db->order_by('id desc');
		$q = $this->db->get();
		return $q->result(); 
	}

    function add($data){

		$data_item = array(
			'no_transaction' 	=> $data['t_no'],
			'transaction_date'  => $data['t_date'],
		);
		$this->db->insert('transactions', $data_item);

		$last_insert_id = $this->db->insert_id();

		$count = count($_POST['item_name']);
    	for($i=0; $i<$count; $i++) {
            $data_opt = array(
                'transaction_id'    => $last_insert_id,
                'item'				=> $data['item_name'][$i],
                'quantity' 	    	=> $data['qty'][$i],
            );
            $this->db->insert('transaction_details', $data_opt);
    	}
	}	

    function get($data){
        $this->db->select('*');
		$this->db->from('transactions');
		$this->db->where('id',$data['id']);
		$q = $this->db->get();
		return $q->row();
    }

	function getItems($id){
		$this->db->select('*');
		$this->db->from('transaction_details');
		$this->db->where('transaction_id',$id);
		$q = $this->db->get();
		return $q->result();
	}

	function update($data){
		$data_item = array(
			'no_transaction' 	=> $data['t_no'],
			'transaction_date'  => $data['t_date'],
		);
		$this->db->where('id', $data['id']);
		$off = $this->db->update('transactions', $data_item);

		// delete all item where id
		$this->db->delete('transaction_details', array('transaction_id' => $data['id']));
		// insert ulang
		$count = count($_POST['item_name']);
    	for($i=0; $i<$count; $i++) {
            $data_opt = array(
                'transaction_id'    => $data['id'],
                'item'				=> $data['item_name'][$i],
                'quantity' 	    	=> $data['qty'][$i],
            );
            $this->db->insert('transaction_details', $data_opt);
    	}
	}

    function delete($data){
        $this->db->delete('transactions', array('id' => $data['id']));
        $this->db->delete('transaction_details', array('transaction_id' => $data['id']));
    }
}
?>