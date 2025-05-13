<?php
require_once '../libs/dompdf/autoload.inc.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Ayarlar
$options = new Options();
$options->set('defaultFont', 'DejaVu Sans'); // Türkçe karakter desteği
$dompdf = new Dompdf($options);

// HTML içeriği yakala
ob_start();
include("../report/report_task.php"); //! Export Alanıcak Sayfa
$html = ob_get_clean();

// HTML'yi yükle
$dompdf->loadHtml($html);

// Kağıt boyutu ve yönü
$dompdf->setPaper('A4', 'portrait');

// PDF oluştur
$dompdf->render();

// PDF indir
$dompdf->stream("rapor.pdf", ["Attachment" => false]); // true olursa indirir, false olursa tarayıcıda gösterir
