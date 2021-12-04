<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_mahasiswa extends CI_Model
{
    function ambilData($table)
    {
        return $this->db->get($table);
    }

    function tambahdata()
    {
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $jurusan = $this->input->post('jurusan');

        $data = [
            'nim' => $nim,
            'nama' => $nama,
            'jurusan' => $jurusan
        ];
        $this->db->insert('tb_mahasiswa', $data);
    }

    function ambilId()
    {
        $id = $this->input->post('id');
        $data = [
            'id' => $id
        ];
        return $this->db->get_where('tb_mahasiswa', $data);
    }

    function ubahdata()
    {
        $id = $this->input->post('id');
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $jurusan = $this->input->post('jurusan');

        $data = [
            'nim' => $nim,
            'nama' => $nama,
            'jurusan' => $jurusan
        ];
        $this->db->where('id', $id);
        $this->db->update('tb_mahasiswa', $data);
    }

    function hapusdata()
    {
        $id = $this->input->post('id');
        $data = [
            'id' => $id
        ];
        $this->db->where($data);
        $this->db->delete('tb_mahasiswa');
    }
}
