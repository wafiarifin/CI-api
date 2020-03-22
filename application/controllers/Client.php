<?php
Class Client extends CI_Controller{
    
    private $_client;
    function __construct() {
        parent::__construct();
    }
    
    // menampilkan data mahasiswa
    function index(){
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        // Send a request to https://foo.com/api/test
        $response = $client->request('GET', 'http://localhost/Rest-Api/api');
        $data['data'] = json_decode($response->getBody()->getContents());
        $this->load->view('crud/list',$data);
    }
    public function add()
    {
        $this->load->view('crud/add');
    }
    // insert data mahasiswa
    function create(){
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        // Send a request to https://foo.com/api/test
        $response = $client->request('POST', 'http://localhost/Rest-Api/api',[
            'form_params' => [
                'kdmk'=>$this->input->post('kdmk'),
                'nnmk'=>$this->input->post('nnmk'),
                'sks'=>$this->input->post('sks'),
                'prodi'=>$this->input->post('prodi')
            ]
        ]);
        // echo $response->getBody()->getContents();
        return redirect(base_url('client'),'refresh');
    }
    
    // edit data mahasiswa
    function edit($id){
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        // Send a request to https://foo.com/api/test
        $response = $client->request('GET', 'http://localhost/Rest-Api/api',[
            'query' => [
                'kdmk'=>$id
            ]
        ]);
        $data['data'] = json_decode($response->getBody()->getContents())[0];

        $this->load->view('crud/edit',$data);
    }
    
    public function update()
    {
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        // Send a request to https://foo.com/api/test
        $response = $client->request('PUT', 'http://localhost/Rest-Api/api',[
            'json' => [
                'kdmk'=>$this->input->post('kdmk'),
                'nnmk'=>$this->input->post('nnmk'),
                'sks'=>$this->input->post('sks'),
                'prodi'=>$this->input->post('prodi'),
            ]
        ]);
        // echo $response->getBody()->getContents();
        return redirect(base_url('client'),'refresh');
    }
    
    // delete data mahasiswa
    function delete($id){
        // Create a client with a base URI
        $client = new GuzzleHttp\Client();
        // Send a request to https://foo.com/api/test
        $response = $client->request('DELETE', 'http://localhost/Rest-Api/api',[
            'form_params' => [
                'kdmk'=>$id,
            ]
        ]);
        // echo $response->getBody()->getContents();
        return redirect(base_url('client'),'refresh');
    }
}