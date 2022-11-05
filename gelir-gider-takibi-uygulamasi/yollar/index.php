<?php

declare(strict_types = 1);

$dosyaDizini = dirname(__DIR__) . DIRECTORY_SEPARATOR;

define('UYGULAMA_YOLU', $dosyaDizini . 'uygulama' . DIRECTORY_SEPARATOR);
define('DOSYA_YOLU', $dosyaDizini . 'islem_dosyalari' . DIRECTORY_SEPARATOR);
define('GORUNUM_YOLU', $dosyaDizini . 'gorunumler' . DIRECTORY_SEPARATOR);

require UYGULAMA_YOLU . "Uygulama.php";
require UYGULAMA_YOLU . 'yardimcilar.php';

$dosyalar = islemDosyalariniAl(DOSYA_YOLU);

$islemler = [];
foreach($dosyalar as $dosya) {
    $islemler = array_merge($islemler, islemleriAl($dosya, 'islemAyikla'));
}

$toplamlar = toplamHesapla($islemler);

require GORUNUM_YOLU . 'islemler.php';