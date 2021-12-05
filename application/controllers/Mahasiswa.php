<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_mahasiswa');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $data['title'] = "Data Mahasiswa";
        $this->load->view('templates/header');
        $this->load->view('Mahasiswa/index', $data);
        $this->load->view('templates/footer');
    }

    function ambilData()
    {
        $dataMahasiswa = $this->M_mahasiswa->ambilData('tb_mahasiswa')->result();
        echo json_encode($dataMahasiswa);
    }

    public function tambah()
    {

        $this->form_validation->set_rules('nim', 'NIM', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

        if ($this->form_validation->run() == true) {


            $this->M_mahasiswa->tambahdata();
            $response['status'] = 1;
            $response['message'] =
                '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Nahasiswa</strong> Berhasil ditambahkan
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            ';
        } else {
            $response['status'] = 0;
            $response['nim'] = strip_tags(form_error('nim'));
            $response['nama'] = strip_tags(form_error('nama'));
            $response['jurusan'] = strip_tags(form_error('jurusan'));
        }
        echo json_encode($response);
    }

    public function getId()
    {
        $dataMahasiswa = $this->M_mahasiswa->ambilId()->result();
        echo json_encode($dataMahasiswa);
    }

    public function ubah()
    {
        $this->form_validation->set_rules('nim', 'NIM', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required');

        if ($this->form_validation->run() == true) {


            $this->M_mahasiswa->ubahdata();
            $response['status'] = 1;
            $response['message'] =
                '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Nahasiswa</strong> Berhasil diubah
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
            ';
        } else {
            $response['status'] = 0;
            $response['nim'] = strip_tags(form_error('nim'));
            $response['nama'] = strip_tags(form_error('nama'));
            $response['jurusan'] = strip_tags(form_error('jurusan'));
        }

        echo json_encode($response);
    }

    public function hapus()
    {
        $this->M_mahasiswa->hapusdata();
        $pesan['message'] = '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data Nahasiswa</strong> Berhasil dihapus
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        ';
        echo json_encode($pesan);
    }
}
