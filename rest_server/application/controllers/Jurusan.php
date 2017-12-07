<?php
require APPPATH . '/libraries/REST_Controller.php';

class jurusan extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }
	
	// show data jurusan
    function index_get() {
        $id_jurusan = $this->get('id_jurusan');
        if ($id_jurusan == '') {
            $jurusan = $this->db->get('jurusan')->result();
        } else {
            $this->db->where('id_jurusan', $id_jurusan);
            $jurusan = $this->db->get('jurusan')->result();
        }
        $this->response($jurusan, 200);
    }

}