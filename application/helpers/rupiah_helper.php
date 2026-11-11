<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('rupiah')) {
    function rupiah($angka){
        $hasil_rupiah = number_format((float)$angka, 0, ',', '.');
        return $hasil_rupiah;
    }
}

if (!function_exists('terbilang')) {
    function terbilang($angka) {
        $angka = abs((float)$angka);
        $baca = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas');
        $terbilang = '';
        if ($angka < 12) {
            $terbilang = ' ' . $baca[(int)$angka];
        } else if ($angka < 20) {
            $terbilang = terbilang($angka - 10) . ' Belas';
        } else if ($angka < 100) {
            $terbilang = terbilang(floor($angka / 10)) . ' Puluh' . terbilang($angka % 10);
        } else if ($angka < 200) {
            $terbilang = ' Seratus' . terbilang($angka - 100);
        } else if ($angka < 1000) {
            $terbilang = terbilang(floor($angka / 100)) . ' Ratus' . terbilang($angka % 100);
        } else if ($angka < 2000) {
            $terbilang = ' Seribu' . terbilang($angka - 1000);
        } else if ($angka < 1000000) {
            $terbilang = terbilang(floor($angka / 1000)) . ' Ribu' . terbilang($angka % 1000);
        } else if ($angka < 1000000000) {
            $terbilang = terbilang(floor($angka / 1000000)) . ' Juta' . terbilang($angka % 1000000);
        } else if ($angka < 1000000000000) {
            $terbilang = terbilang(floor($angka / 1000000000)) . ' Miliar' . terbilang(fmod($angka, 1000000000));
        } else if ($angka < 1000000000000000) {
            $terbilang = terbilang(floor($angka / 1000000000000)) . ' Triliun' . terbilang(fmod($angka, 1000000000000));
        }
        return trim($terbilang);
    }
}

