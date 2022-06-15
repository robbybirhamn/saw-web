<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rekomendasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		isLogin();
	}

    public function index()
    {
		$set['output'] = array('pages/rekomendasi');
        $this->load->view('layout_website',$set);
    }

    public function round($original_value)
    {
        $value = (round($original_value, 2));
        return $value;
    }

    public function hasil()
    {
        $get = $this->input->get();
        
        $dekorasi = $get['dekorasi'];
        $rias = $get['rias'];
        $catering = $get['catering'];
        $jumlah_tamu = $get['jumlah_tamu'];
        $harga = $get['harga'];
        

        $weights = array(
            'weight_dekorasi'    => $this->round($dekorasi/($dekorasi+$rias+$catering+$jumlah_tamu+$harga)),
            'weight_rias'        => $this->round($rias/($dekorasi+$rias+$catering+$jumlah_tamu+$harga)),
            'weight_catering'    => $this->round($catering/($dekorasi+$rias+$catering+$jumlah_tamu+$harga)),
            'weight_jumlah_tamu' => $this->round($jumlah_tamu/($dekorasi+$rias+$catering+$jumlah_tamu+$harga)),
            'weight_harga'       => $this->round($harga/($dekorasi+$rias+$catering+$jumlah_tamu+$harga)),
        );

        $results = $this->db->query("
            SELECT 
                *,
                tb_vendor.*,
                name_packet,
                dekorasi,
                (SELECT max(dekorasi) FROM `tb_packet`) as max_dekorasi,
                dekorasi/(SELECT max(dekorasi) FROM `tb_packet`) as dekorasi_hasil, 
                    ROUND(dekorasi/(SELECT max(dekorasi) FROM `tb_packet`)* $weights[weight_dekorasi],2) as dekorasi_sort,

                rias/(SELECT max(rias) FROM `tb_packet`) as rias_hasil , 
                    ROUND(rias/(SELECT max(rias) FROM `tb_packet`) * $weights[weight_rias],2) as rias_sort, 

                catering/(SELECT max(catering) FROM `tb_packet`) as catering_hasil,
                    ROUND(catering/(SELECT max(catering) FROM `tb_packet`) * $weights[weight_catering],2) as catering_sort, 

                jumlah_tamu/(SELECT max(jumlah_tamu) FROM `tb_packet`) as jumlah_tamu_hasil,
                    ROUND(jumlah_tamu/(SELECT max(jumlah_tamu) FROM `tb_packet`) * $weights[weight_jumlah_tamu],2) as jumlah_tamu_sort, 

                (SELECT min(harga) FROM `tb_packet`)/harga as harga_hasil,
                    ROUND((SELECT min(harga) FROM `tb_packet`)/harga * $weights[weight_harga],2) as harga_sort
                ,
                (ROUND(dekorasi/(SELECT max(dekorasi) FROM `tb_packet`)* $weights[weight_dekorasi],4) +
                ROUND(rias/(SELECT max(rias) FROM `tb_packet`) * $weights[weight_rias],4) +
                ROUND(catering/(SELECT max(catering) FROM `tb_packet`) * $weights[weight_catering],4) +
                ROUND(jumlah_tamu/(SELECT max(jumlah_tamu) FROM `tb_packet`) * $weights[weight_jumlah_tamu],4) +
                ROUND((SELECT min(harga) FROM `tb_packet`)/harga * $weights[weight_harga],4)) as total
            FROM `tb_packet` JOIN tb_vendor ON id_vendor=vendor_packet ORDER BY total DESC ;
            ")->result_array();
        $set['results'] = $results;
		$set['output'] = array('pages/rekomendasi');
        $this->load->view('layout_website',$set);
    }
}
