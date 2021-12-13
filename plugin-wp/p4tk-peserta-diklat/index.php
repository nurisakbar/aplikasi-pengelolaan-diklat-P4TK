<?php
/*
Plugin Name: P4TK Peserta Diklat
Description: Menampilkan informasi Peserta Diklat Dari Aplikasi SIMDIKLAT
Author: Nuris Akbar
Version: 0.1
*/


add_shortcode('daftar_peserta_diklat', 'daftar_peserta_diklat_tags');
function daftar_peserta_diklat_tags($atts)
{

	$params = shortcode_atts( array(
		'id' => 'something'
	), $atts );
    
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	$data = curl("http://localhost:8000/api/diklat/".$params['id']);
	$diklat = json_decode($data);

	echo "<h4>".$diklat->nama_diklat.' - '.$diklat->tahun."</h4>
		<table class='table table-striped'>
		<tr><th>NOMOR</th><th>NAMA</th><th>ASAL SEKOLAH</th><th>STATUS KEHADIRAN</th>
		</tr>";
	$nomor = 1;
	foreach ($diklat->peserta as $row) 
	{
		//print_r($row->gtk->nama_gtk);
		echo "<tr>
		<td>$nomor</td>
		<td>".$row->gtk->nama_gtk."</td>
		<td>".$row->gtk->asal_sekolah."</td>
		<td>".$row->status_kehadiran."</td>
		</tr>";
		$nomor++;
	}
	echo "</table>";
}



function curl($url){
	        // create curl resource 
        $ch = curl_init(); 
        // set url 
        curl_setopt($ch, CURLOPT_URL, $url); 
        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        // $output contains the output string 
        $output = curl_exec($ch); 
        // close curl resource to free up system resources 
        curl_close($ch); 
        return $output; 
}
?>