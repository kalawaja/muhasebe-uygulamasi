<?php

declare(strict_types = 1);

function islemDosyalariniAl(string $dizinYolu): array
{
    $dosyalar = [];

    foreach (scandir($dizinYolu) as $dosya) {
        if (is_dir($dosya)) {
            continue;
        }

        $dosyalar[] = $dizinYolu . $dosya;
    }

    return $dosyalar;
}

function islemleriAl(string $dosyaAdi, ?callable $hesapHareketiYazici = null): array
{
    if (! file_exists($dosyaAdi)) {
        trigger_error('Dosya "' . $dosyaAdi . '" mevcut değil.', E_USER_ERROR);
    }

    $dosya = fopen($dosyaAdi, 'r');

    fgetcsv($dosya);

    $islemler = [];

    while (($islem = fgetcsv($dosya)) !== false) {
        if ($hesapHareketiYazici !== null) {
            $islem = $hesapHareketiYazici($islem);
        }

        $islemler[] = $islem;
    }

    return $islemler;
}

function islemAyikla(array $islemSatiri): array
{
    [$tarih, $kontrolNo, $aciklama, $tutar] = $islemSatiri;

    $tutar = (float) str_replace(['₺', ','], '', $tutar);

    return [
        'tarih'     => $tarih,
        'kontrolNo' => $kontrolNo,
        'aciklama'  => $aciklama,
        'tutar'     => $tutar,
    ];
}

function toplamHesapla(array $islemler): array
{
    $toplamlar = ['netToplam' => 0, 'toplamGelir' => 0, 'toplamGider' => 0];

    foreach ($islemler as $islem) {
        $toplamlar['netToplam'] += $islem['tutar'];

        if ($islem['tutar'] >= 0) {
            $toplamlar['toplamGelir'] += $islem['tutar'];
        } else {
            $toplamlar['toplamGider'] += $islem['tutar'];
        }
    }

    return $toplamlar;
}