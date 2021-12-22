<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        /* Font Definitions */
        @font-face {
            font-family: "Cambria Math";
            panose-1: 2 4 5 3 5 4 6 3 2 4;
        }

        @font-face {
            font-family: Calibri;
            panose-1: 2 15 5 2 2 2 4 3 2 4;
        }

        /* Style Definitions */
        p.MsoNormal,
        li.MsoNormal,
        div.MsoNormal {
            margin: 0cm;
            font-size: 12.0pt;
            font-family: "Calibri", sans-serif;
        }

        .MsoChpDefault {
            font-family: "Calibri", sans-serif;
        }

        @page WordSection1 {
            size: 595.0pt 842.0pt;
            margin: 72.0pt 72.0pt 72.0pt 72.0pt;
        }

        div.WordSection1 {
            page: WordSection1;
        }
    </style>
</head>

<body style='word-wrap:break-word'>
    <div class=WordSection1>

        <p class=MsoNormal>&nbsp;</p>

        <table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0 style='border-collapse:collapse;border:none'>
            <tr>
                <td width=601 valign=top style='width:450.5pt;border:solid black 1.5pt;
border-bottom:solid black 4.5pt;padding:0cm 5.4pt 0cm 5.4pt'>
                    <p class=MsoNormal align=center style='text-align:center'><img width=110 height=120 src="<?= base_url() ?>/dist/img/Puskesmas-lg-Cimaung940051.png" align=left hspace=12></p>
                    <p class=MsoNormal align=center style='margin-left:70.9pt;text-align:center'>&nbsp;</p>
                    <p class=MsoNormal align=center style='text-align:center'><b>PEMERINTAH
                            KABUPATEN BANDUNG</b></p>
                    <p class=MsoNormal align=center style='margin-left:-5.7pt;text-align:center'><b>DINAS
                            KESEHATAN KABUPATEN BANDUNG</b></p>
                    <p class=MsoNormal align=center style='margin-left:-5.7pt;text-align:center'><b>PUSKESMAS
                            CIMAUNG</b></p>
                    <p class=MsoNormal align=center style='margin-left:-5.7pt;text-align:center'><span style='font-size:11.0pt'>JI. Raya Pangalengan Km 25, Tlp :022-85939166 Kode
                            Pos 40374</span></p>
                    <p class=MsoNormal align=center style='margin-left:-5.7pt;text-align:center'><span style='font-size:11.0pt'>Email :pkmcampakamulya_bandungkab@yahoo.com</span></p>
                    <p class=MsoNormal align=center style='margin-left:70.9pt;text-align:center'>&nbsp;</p>
                </td>
            </tr>
            <tr>
                <td width=601 valign=top style='width:450.5pt;border:solid black 1.5pt;
border-top:none;padding:0cm 5.4pt 0cm 5.4pt'>
                    <p class=MsoNormal align=center style='text-align:center'><b>&nbsp;</b></p>
                    <p class=MsoNormal align=center style='text-align:center'><b><span style='font-size:16.0pt'>SALINAN RESEP</span></b></p>
                    <p class=MsoNormal><b>&nbsp;</b></p>
                    <p class=MsoNormal><b>*<?= $byPasien['status_pasien'] ?></b></p>
                    <p class=MsoNormal><b>&nbsp;</b></p>
                    <p class=MsoNormal style='margin-left:72.45pt;text-indent:-72.45pt'>No : <?= $getResep['kode_resep'] ?></p>
                    <p class=MsoNormal>Tanggal : <?= $getResep['tanggal'] ?></p>
                    <p class=MsoNormal>&nbsp;</p>
                    <p class=MsoNormal>&nbsp;</p>
                    <p class=MsoNormal><b><i><span style='font-family:"Times New Roman",serif'>R/</span></i></b></p>
                    <p class=MsoNormal><b><i><span style='font-family:"Times New Roman",serif'>&nbsp;</span></i></b></p>
                    <p class=MsoNormal>&nbsp; <?= $getResep['nama_obat'] ?></p>
                    <p class=MsoNormal>&nbsp; <?= $getResep['jenis_obat'] ?></p>
                    <p class=MsoNormal>&nbsp; <?= $getResep['dosis_aturan_obat'] ?></p>
                    <p class=MsoNormal>&nbsp;</p>
                    <p class=MsoNormal>&nbsp; Jumlah : <?= $getResep['jumlah_obat'] ?></p>
                    <p class=MsoNormal><b><i><span style='font-family:"Times New Roman",serif'>&nbsp;</span></i></b></p>
                    <p class=MsoNormal><b><i><span style='font-family:"Times New Roman",serif'>&nbsp;</span></i></b></p>
                    <p class=MsoNormal><b><i><span style='font-family:"Times New Roman",serif'>&nbsp;</span></i></b></p>
                    <p class=MsoNormal><span style='font-family:"Times New Roman",serif'>&nbsp;</span></p>
                    <p class=MsoNormal><b><i><span style='font-family:"Times New Roman",serif'>&nbsp;</span></i></b></p>
                    <p class=MsoNormal><b><i><span style='font-family:"Times New Roman",serif'>&nbsp;</span></i></b></p>
                    <p class=MsoNormal><b><i><span style='font-family:"Times New Roman",serif'>&nbsp;</span></i></b></p>
                    <p class=MsoNormal>Nama Pasien   : <?= $byPasien['nama_pasien'] ?></p>
                    <p class=MsoNormal>Umur                : <?= $year ?></p>
                    <p class=MsoNormal>Alamat             : <?= $byPasien['alamat'] ?></p>
                    <p class=MsoNormal><b><span style='font-family:"Times New Roman",serif'>&nbsp;</span></b></p>
                    <p class=MsoNormal><b><span style='font-family:"Times New Roman",serif'>&nbsp;</span></b></p>
                </td>
            </tr>
        </table>

        <p class=MsoNormal align=center style='text-align:center'>&nbsp;</p>

    </div>
    <script>
        window.print();
    </script>
</body>

</html>