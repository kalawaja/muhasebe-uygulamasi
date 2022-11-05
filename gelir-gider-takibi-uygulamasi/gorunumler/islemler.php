<!doctype html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gelir & Gider Takibi Uygulaması</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
        <table>
            <thead>
                <tr>
                    <th>Tarih</th>
                    <th>Kontrol #</th>
                    <th>Açıklama</th>
                    <th>Tutar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (! empty($islemler)): ?>
                    <?php foreach($islemler as $islem): ?>
                        <tr>
                            <td><?= tarihBicimlendir($islem['tarih']) ?></td>
                            <td><?= $islem['kontrolNo'] ?></td>
                            <td><?= $islem['aciklama'] ?></td>
                            <td>
                                <?php if ($islem['tutar'] < 0): ?>
                                    <span style="color: red;">
                                        <?= TurkLirasiBicimlendir($islem['tutar']) ?>
                                    </span>
                                <?php elseif ($islem['tutar'] > 0): ?>
                                    <span style="color: green;">
                                        <?= TurkLirasiBicimlendir($islem['tutar']) ?>
                                    </span>
                                <?php else: ?>
                                    <?= TurkLirasiBicimlendir($islem['tutar']) ?>
                                <?php endif ?>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Toplam Gelir:</th>
                    <td><?= TurkLirasiBicimlendir($toplamlar['toplamGelir'] ?? 0) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Toplam Gider:</th>
                    <td><?= TurkLirasiBicimlendir($toplamlar['toplamGider'] ?? 0) ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Toplam:</th>
                    <td><?= TurkLirasiBicimlendir($toplamlar['netToplam'] ?? 0) ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>