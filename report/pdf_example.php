<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>PDF Örnek Önizleme</title>
  <style>
    body { font-family: DejaVu Sans, sans-serif; }
    h1 { color: darkblue; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #333; padding: 5px; }
  </style>

  <style>
      .no-print { display: block; }

      @media print {
          .no-print { display: none !important; }
      }
  </style>

</head>
<body>
  <h1>Kullanıcı Raporu</h1>
  <p>Bu sayfa PDF olarak oluşturulmuştur.</p>
  <table>
    <tr><th>Ad</th><th>Soyad</th></tr>
    <tr><td>Ali</td><td>Veli</td></tr>
  </table>
</body>
</html>
