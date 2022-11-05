<?php

declare(strict_types=1);

function TurkLirasiBicimlendir(float $tutar): string
{
    $eksi = $tutar < 0;

    return ($eksi ? '' : '') . number_format($tutar, 2, ',', '.'). ' ₺';
}

function tarihBicimlendir(string $tarih): string
{
    return date('d.m.Y', strtotime($tarih));
}