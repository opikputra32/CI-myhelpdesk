<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_model
{
    public function countJmlUser()
    {
        $sess_id = $this->session->userdata('id');
        $query = $this->db->query(
            "SELECT COUNT(id_komplain) as user
                               FROM tb_komplain
                               WHERE sess_id = '$sess_id'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->user;
        } else {
            return 0;
        }
    }

    public function countBelum()
    {
        $sess_id = $this->session->userdata('id');
        $query = $this->db->query(
            "SELECT COUNT(status_komplain) as belum
                               FROM tb_komplain
                               WHERE status_komplain = 1 AND sess_id = '$sess_id'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->belum;
        } else {
            return 0;
        }
    }

    public function countProses()
    {
        $sess_id = $this->session->userdata('id');
        $query = $this->db->query(
            "SELECT COUNT(status_komplain) as proses
                               FROM tb_komplain
                               WHERE status_komplain = 2 AND sess_id = '$sess_id'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->proses;
        } else {
            return 0;
        }
    }

    public function countClear()
    {
        $sess_id = $this->session->userdata('id');
        $query = $this->db->query(
            "SELECT COUNT(status_komplain) as selesai
                               FROM tb_komplain
                               WHERE status_komplain = 0 AND sess_id = '$sess_id'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->selesai;
        } else {
            return 0;
        }
    }

    public function getKomplainAll()
    {
        $query = "SELECT *
                  FROM tb_komplain
                  JOIN mst_user
                  ON tb_komplain.sess_id = mst_user.id  
                  WHERE tb_komplain.status_komplain = 1 OR tb_komplain.status_selesai = 1 OR tb_komplain.status_komplain = 2     
                ";
        return $this->db->query($query)->result_array();
    }

    public function getMember()
    {
        $query = "SELECT *
                  FROM mst_member
                  LEFT JOIN mst_user
                  ON mst_member.sess_id = mst_user.id              
                ";
        return $this->db->query($query)->result_array();
    }

    public function getKomplain()
    {
        $query = "SELECT *
                  FROM tb_komplain
                  LEFT JOIN mst_member
                  ON tb_komplain.sess_id = mst_member.sess_id   
                  LEFT JOIN mst_user
                  ON mst_user.id = tb_komplain.sess_id         
                ";
        return $this->db->query($query)->result_array();
    }

    public function getEditKomplain($id_komplain)
    {
        $query = $this->db->get_where('tb_komplain', ['id_komplain' => $id_komplain])->row_array();
        return $query;
    }

    public function getDetailKomplain($id_komplain)
    {
        $query = $this->db->query("SELECT *
                                        FROM tb_komplain LEFT JOIN mst_user 
                                        ON tb_komplain.sess_id = mst_user.id
                                        LEFT JOIN mst_client
                                        ON mst_client.nama_client = tb_komplain.client
                                        WHERE tb_komplain.id_komplain = '$id_komplain'
                                        ORDER BY tb_komplain.id_komplain DESC
                                       ");
        return $query->row_array();
    }

    public function getCetakBulan($bulan, $tahun, $client)
    {
        $sess_id = $this->session->userdata('id');
        $query = $this->db->query("SELECT *
                                        FROM tb_komplain JOIN mst_user 
                                        ON tb_komplain.sess_id = mst_user.id
                                        WHERE month(date_komplain)='$bulan' AND year(date_komplain)='$tahun' AND tb_komplain.sess_id = '$sess_id' AND tb_komplain.client = '$client'
                                        ORDER BY tb_komplain.id_komplain DESC
                                       ");
        return $query->result_array();
    }

    public function getCetakTanggal($tanggal)
    {
        $sess_id = $this->session->userdata('id');
        $query = $this->db->query("SELECT *
                                        FROM tb_komplain JOIN mst_user 
                                        ON tb_komplain.sess_id = mst_user.id
                                        WHERE tb_komplain.date_komplain = '$tanggal' AND tb_komplain.sess_id = '$sess_id'
                                        ORDER BY tb_komplain.id_komplain DESC
                                       ");
        return $query->result_array();
    }

    public function getCetakClient($client)
    {
        $sess_id = $this->session->userdata('id');
        $query = $this->db->query("SELECT *
                                        FROM tb_komplain JOIN mst_user 
                                        ON tb_komplain.sess_id = mst_user.id
                                        WHERE tb_komplain.client = '$client' AND tb_komplain.sess_id = '$sess_id'
                                        ORDER BY tb_komplain.id_komplain DESC
                                       ");
        return $query->result_array();
    }
}
