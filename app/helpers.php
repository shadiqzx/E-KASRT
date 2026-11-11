<?php

if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        return number_format((float)$angka, 0, ',', '.');
    }
}

if (!function_exists('terbilang')) {
    function terbilang($angka)
    {
        $angka = abs((float)$angka);
        $baca = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 'Sepuluh', 'Sebelas'];
        $terbilang = '';

        if ($angka < 12) {
            $terbilang = ' ' . $baca[$angka];
        } else if ($angka < 20) {
            $terbilang = terbilang($angka - 10) . ' Belas';
        } else if ($angka < 100) {
            $terbilang = terbilang((int)($angka / 10)) . ' Puluh' . terbilang($angka % 10);
        } else if ($angka < 200) {
            $terbilang = ' Seratus' . terbilang($angka - 100);
        } else if ($angka < 1000) {
            $terbilang = terbilang((int)($angka / 100)) . ' Ratus' . terbilang($angka % 100);
        } else if ($angka < 2000) {
            $terbilang = ' Seribu' . terbilang($angka - 1000);
        } else if ($angka < 1000000) {
            $terbilang = terbilang((int)($angka / 1000)) . ' Ribu' . terbilang($angka % 1000);
        } else if ($angka < 1000000000) {
            $terbilang = terbilang((int)($angka / 1000000)) . ' Juta' . terbilang($angka % 1000000);
        } else if ($angka < 1000000000000) {
            $terbilang = terbilang((int)($angka / 1000000000)) . ' Milyar' . terbilang(fmod($angka, 1000000000));
        } else {
            $terbilang = terbilang((int)($angka / 1000000000000)) . ' Triliun' . terbilang(fmod($angka, 1000000000000));
        }

        return trim($terbilang);
    }
}

