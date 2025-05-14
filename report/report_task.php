<?php
session_start();
require_once '../config/about.php';
require_once '../config/Database.php';

// Giriş kontrolü
if (!isset($_SESSION['user'])) {  header("Location: views/login.php"); exit; }

//! --- Status Durum
$status = isset($_SESSION['status']) ? $_SESSION['status']  : [];
//echo "<pre>"; print_r($status); die();

$status_type = isset($_SESSION['status']) ? $status['type'] : "type yok";
// echo "status_type: "; echo $status_type; die();

$status_msg = isset($_SESSION['status']) ? $status['msg'] : "msg yok";
//echo "status_msg: "; echo $status_msg; die();

unset($_SESSION['status']); //! Sesion Siliyor

//! echo "sayisi: "; echo count($status); echo "<br>";

//! --- Status Durum -- Son


// Url Veriden UserId
$user_id_get = $_GET['user_id'] ?? ''; 
//echo "user_id_get: "; echo $user_id_get; die();


$user = $_SESSION['user'];
//echo "<pre>"; print_r($user); die();

$userId = $user['id'];
$userRole = $user['role'];
//echo "role:"; echo $userRole; die();

// Url Veri Çekme
$status_where = $_GET['status'] ?? 'Devam Ediliyor'; 
//echo "status_where: "; echo $status_where; die();

//! Zaman
$start_date = $_GET['start_date'] ?? null;
$end_date = $_GET['end_date'] ?? null;
//echo "zaman:"; echo $end_date; die();


 $tasks = DB::table('tasks')
  ->join('users as user_id_user', 'tasks.user_id', '=', 'user_id_user.id')
  ->leftJoin('departman', 'departman.id', '=', 'user_id_user.departman')
  ->leftJoin('users as updated_User ', 'tasks.updated_byId', '=', 'updated_User.id')
  ->select('tasks.*', 'user_id_user.name as user_name', 'user_id_user.surname as user_surname', 'updated_User.name as updated_User_name','departman.name as departmanTitle');

  if ($status_where != 'tüm' && $status_where != 'Arşivlenen' ) { $tasks = $tasks->where('tasks.status', '=', $status_where); }
  if ($status_where == 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 1); }
  else if ($status_where != 'Arşivlenen') { $tasks = $tasks->where('tasks.deleted_status', '=', 0); }
  if ($user_id_get ) { $tasks = $tasks->where('tasks.user_id', '=', $user_id_get); }

  if ($start_date && $end_date) {
    $tasks = $tasks->where('tasks.created_at', '>=', $start_date . ' 00:00:00')->where('tasks.created_at', '<=', $end_date . ' 23:59:59');
  }

  $tasks = $tasks->orderBy('id', 'DESC')->get();
  //echo "<pre>"; print_r($tasks); die();


?>

<?php

// Türkçe gün ve ay adları
$gunler = ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'];
$aylar  = ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'];

// Örnek tarih: 14 Mayıs 2025
$start_date = new DateTime($start_date);
$end_date = new DateTime($end_date);

// Günü ve ayı al
$gun = $gunler[$start_date->format('w')]; // 0 = Pazar, 6 = Cumartesi
$ay  = $aylar[$start_date->format('n') - 1]; // 1 = Ocak, 12 = Aralık


// Günü ve ayı al
$end_date_gun = $gunler[$end_date->format('w')]; // 0 = Pazar, 6 = Cumartesi
$end_date_ay  = $aylar[$end_date->format('n') - 1]; // 1 = Ocak, 12 = Aralık

// Formatla ve yazdır
$start_date = $start_date->format('d') . ' ' . $ay . ' ' . $start_date->format('Y') . ' ' . $gun;
$end_date = $end_date->format('d') . ' ' . $end_date_ay . ' ' . $end_date->format('Y') . ' ' . $end_date_gun;

?>


<html>

<head>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <style type="text/css">
        .lst-kix_7zzc1ab8ftxz-1>li:before {
            content: "-  "
        }

        .lst-kix_7zzc1ab8ftxz-0>li:before {
            content: "-  "
        }

        .lst-kix_7zzc1ab8ftxz-2>li:before {
            content: "-  "
        }

        .lst-kix_9ot84hx1u3ql-7>li:before {
            content: "\0025cf   "
        }

        .lst-kix_9ot84hx1u3ql-6>li:before {
            content: "\0025cf   "
        }

        .lst-kix_2adexkt9obv1-8>li:before {
            content: "\0025cf   "
        }

        .lst-kix_7zzc1ab8ftxz-5>li:before {
            content: "-  "
        }

        .lst-kix_7zzc1ab8ftxz-4>li:before {
            content: "-  "
        }

        .lst-kix_2adexkt9obv1-5>li:before {
            content: "\0025cf   "
        }

        .lst-kix_2adexkt9obv1-7>li:before {
            content: "\0025cf   "
        }

        .lst-kix_7zzc1ab8ftxz-3>li:before {
            content: "-  "
        }

        .lst-kix_9ot84hx1u3ql-8>li:before {
            content: "\0025cf   "
        }

        .lst-kix_2adexkt9obv1-6>li:before {
            content: "\0025cf   "
        }

        .lst-kix_9ot84hx1u3ql-1>li:before {
            content: "\0025cf   "
        }

        .lst-kix_9ot84hx1u3ql-3>li:before {
            content: "\0025cf   "
        }

        .lst-kix_9ot84hx1u3ql-2>li:before {
            content: "\0025cf   "
        }

        .lst-kix_9ot84hx1u3ql-5>li:before {
            content: "\0025cf   "
        }

        .lst-kix_9ot84hx1u3ql-4>li:before {
            content: "\0025cf   "
        }

        .lst-kix_9ot84hx1u3ql-0>li:before {
            content: "\0025cf   "
        }

        .lst-kix_2adexkt9obv1-3>li:before {
            content: "\0025cf   "
        }

        .lst-kix_2adexkt9obv1-1>li:before {
            content: "\0025cf   "
        }

        .lst-kix_2adexkt9obv1-0>li:before {
            content: "\0025cf   "
        }

        .lst-kix_2adexkt9obv1-4>li:before {
            content: "\0025cf   "
        }

        .lst-kix_2adexkt9obv1-2>li:before {
            content: "\0025cf   "
        }

        ul.lst-kix_7zzc1ab8ftxz-6 {
            list-style-type: none
        }

        ul.lst-kix_7zzc1ab8ftxz-5 {
            list-style-type: none
        }

        ul.lst-kix_7zzc1ab8ftxz-4 {
            list-style-type: none
        }

        ul.lst-kix_7zzc1ab8ftxz-3 {
            list-style-type: none
        }

        ul.lst-kix_7zzc1ab8ftxz-2 {
            list-style-type: none
        }

        ul.lst-kix_7zzc1ab8ftxz-1 {
            list-style-type: none
        }

        ul.lst-kix_7zzc1ab8ftxz-0 {
            list-style-type: none
        }

        ul.lst-kix_7zzc1ab8ftxz-8 {
            list-style-type: none
        }

        ul.lst-kix_7zzc1ab8ftxz-7 {
            list-style-type: none
        }

        ul.lst-kix_9ot84hx1u3ql-2 {
            list-style-type: none
        }

        ul.lst-kix_9ot84hx1u3ql-1 {
            list-style-type: none
        }

        ul.lst-kix_9ot84hx1u3ql-4 {
            list-style-type: none
        }

        ul.lst-kix_9ot84hx1u3ql-3 {
            list-style-type: none
        }

        ul.lst-kix_9ot84hx1u3ql-6 {
            list-style-type: none
        }

        ul.lst-kix_9ot84hx1u3ql-5 {
            list-style-type: none
        }

        ul.lst-kix_9ot84hx1u3ql-8 {
            list-style-type: none
        }

        ul.lst-kix_9ot84hx1u3ql-7 {
            list-style-type: none
        }

        ul.lst-kix_9ot84hx1u3ql-0 {
            list-style-type: none
        }

        li.li-bullet-0:before {
            margin-left: -18pt;
            white-space: nowrap;
            display: inline-block;
            min-width: 18pt
        }

        ul.lst-kix_2adexkt9obv1-7 {
            list-style-type: none
        }

        .lst-kix_7zzc1ab8ftxz-8>li:before {
            content: "-  "
        }

        ul.lst-kix_2adexkt9obv1-8 {
            list-style-type: none
        }

        ul.lst-kix_2adexkt9obv1-5 {
            list-style-type: none
        }

        ul.lst-kix_2adexkt9obv1-6 {
            list-style-type: none
        }

        ul.lst-kix_2adexkt9obv1-3 {
            list-style-type: none
        }

        ul.lst-kix_2adexkt9obv1-4 {
            list-style-type: none
        }

        ul.lst-kix_2adexkt9obv1-1 {
            list-style-type: none
        }

        ul.lst-kix_2adexkt9obv1-2 {
            list-style-type: none
        }

        .lst-kix_7zzc1ab8ftxz-6>li:before {
            content: "-  "
        }

        ul.lst-kix_2adexkt9obv1-0 {
            list-style-type: none
        }

        .lst-kix_7zzc1ab8ftxz-7>li:before {
            content: "-  "
        }

        ol {
            margin: 0;
            padding: 0
        }

        table td,
        table th {
            padding: 0
        }

        .c2 {
            border-right-style: solid;
            padding: 5pt 5pt 5pt 5pt;
            border-bottom-color: #ffffff;
            border-top-width: 1pt;
            border-right-width: 1pt;
            border-left-color: #ffffff;
            vertical-align: top;
            border-right-color: #ffffff;
            border-left-width: 1pt;
            border-top-style: solid;
            background-color: #d9d9d9;
            border-left-style: solid;
            border-bottom-width: 1pt;
            width: 451.4pt;
            border-top-color: #ffffff;
            border-bottom-style: solid
        }

        .c7 {
            border-right-style: solid;
            padding: 5pt 5pt 5pt 5pt;
            border-bottom-color: #000000;
            border-top-width: 1pt;
            border-right-width: 1pt;
            border-left-color: #000000;
            vertical-align: top;
            border-right-color: #000000;
            border-left-width: 1pt;
            border-top-style: solid;
            background-color: #cccccc;
            border-left-style: solid;
            border-bottom-width: 1pt;
            width: 451.4pt;
            border-top-color: #000000;
            border-bottom-style: solid
        }

        .c9 {
            border-right-style: solid;
            padding: 5pt 5pt 5pt 5pt;
            border-bottom-color: #000000;
            border-top-width: 1pt;
            border-right-width: 1pt;
            border-left-color: #000000;
            vertical-align: top;
            border-right-color: #000000;
            border-left-width: 1pt;
            border-top-style: solid;
            border-left-style: solid;
            border-bottom-width: 1pt;
            width: 451.4pt;
            border-top-color: #000000;
            border-bottom-style: solid
        }

        .c0 {
            padding-top: 0pt;
            padding-bottom: 0pt;
            line-height: 1.15;
            orphans: 2;
            widows: 2;
            text-align: left;
            height: 11pt
        }

        .c4 {
            color: #000000;
            font-weight: 400;
            text-decoration: none;
            vertical-align: baseline;
            font-size: 11pt;
            font-family: "Arial";
            font-style: normal
        }

        .c12 {
            margin-left: 36pt;
            padding-top: 0pt;
            padding-bottom: 0pt;
            line-height: 1.0;
            padding-left: 0pt;
            text-align: left
        }

        .c11 {
            padding-top: 0pt;
            padding-bottom: 0pt;
            line-height: 1.15;
            orphans: 2;
            widows: 2;
            text-align: right
        }

        .c5 {
            border-spacing: 0;
            border-collapse: collapse;
            margin-right: auto
        }

        .c3 {
            padding-top: 0pt;
            padding-bottom: 0pt;
            line-height: 1.0;
            text-align: center
        }

        .c6 {
            background-color: #ffffff;
            max-width: 451.4pt;
            padding: 7pt 35pt 35pt 35pt
        }

        .c10 {
            padding: 0;
            margin: 0
        }

        .c8 {
            height: 5.1pt
        }

        .c1 {
            height: 22.4pt
        }

        .title {
            padding-top: 0pt;
            color: #000000;
            font-size: 26pt;
            padding-bottom: 3pt;
            font-family: "Arial";
            line-height: 1.15;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        .subtitle {
            padding-top: 0pt;
            color: #666666;
            font-size: 15pt;
            padding-bottom: 16pt;
            font-family: "Arial";
            line-height: 1.15;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        li {
            color: #000000;
            font-size: 11pt;
            font-family: "Arial"
        }

        p {
            margin: 0;
            color: #000000;
            font-size: 11pt;
            font-family: "Arial"
        }

        h1 {
            padding-top: 20pt;
            color: #000000;
            font-size: 20pt;
            padding-bottom: 6pt;
            font-family: "Arial";
            line-height: 1.15;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        h2 {
            padding-top: 18pt;
            color: #000000;
            font-size: 16pt;
            padding-bottom: 6pt;
            font-family: "Arial";
            line-height: 1.15;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        h3 {
            padding-top: 16pt;
            color: #434343;
            font-size: 14pt;
            padding-bottom: 4pt;
            font-family: "Arial";
            line-height: 1.15;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        h4 {
            padding-top: 14pt;
            color: #666666;
            font-size: 12pt;
            padding-bottom: 4pt;
            font-family: "Arial";
            line-height: 1.15;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        h5 {
            padding-top: 12pt;
            color: #666666;
            font-size: 11pt;
            padding-bottom: 4pt;
            font-family: "Arial";
            line-height: 1.15;
            page-break-after: avoid;
            orphans: 2;
            widows: 2;
            text-align: left
        }

        h6 {
            padding-top: 12pt;
            color: #666666;
            font-size: 11pt;
            padding-bottom: 4pt;
            font-family: "Arial";
            line-height: 1.15;
            page-break-after: avoid;
            font-style: italic;
            orphans: 2;
            widows: 2;
            text-align: left
        }
    </style>
</head>

<body class="c6 doc-content">
    <p class="c0"><span class="c4"></span></p>
    <table class="c5">
        <tr class="c8">
            <td class="c2" colspan="1" rowspan="1">
                <p class="c3"><span class="c4">Faaliyet Raporu</span></p>
            </td>
        </tr>
    </table>
    <p class="c0"><span class="c4"></span></p>
    <table class="c5">
        <tr class="c8">
            <td class="c2" colspan="1" rowspan="1">
                <p class="c3"><span class="c4">13 Mart - 17 Mart 2023 Faaliyet Raporu</span></p>
            </td>
        </tr>
    </table>
    <p class="c0"><span class="c4"></span></p>
    <p class="c0"><span class="c4"></span></p>
    <table class="c5">
        <tr class="c1">
            <td class="c7" colspan="1" rowspan="1">
                <p class="c3"><span class="c4">Deparman</span></p>
            </td>
        </tr>
        <tr class="c1">
            <td class="c9" colspan="1" rowspan="1">
                <ul class="c10 lst-kix_9ot84hx1u3ql-0 start">
                    <li class="c12 li-bullet-0"><span class="c4">Laravel - x</span></li>
                </ul>
            </td>
        </tr>
    </table>
    <p class="c0"><span class="c4"></span></p>
    <p class="c0"><span class="c4"></span></p>
    <p class="c11"><span class="c4">Ebu Enes Y&#305;ld&#305;r&#305;m</span></p>
    <p class="c11"><span class="c4">Yaz&#305;l&#305;m M&uuml;hendisi</span></p>
    <p class="c0"><span class="c4"></span></p>
</body>

</html>
