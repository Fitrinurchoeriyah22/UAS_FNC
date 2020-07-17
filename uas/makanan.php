<?php
include "fungsi/koneksi.php";

$perpage = 3;
$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
$start = ($page > 1) ? ($page * $perpage) - $perpage : 0;

$results = mysqli_query($koneksi, "SELECT * FROM makanan LIMIT $start, $perpage");

$hasil = mysqli_query($koneksi, "SELECT * FROM makanan");
$total = mysqli_num_rows($hasil);

$pages = ceil($total / $perpage);

//searching 

$keyword = "";
if (isset($_POST['cari'])) {
    $keyword = $_POST['keyword'];
    $results = mysqli_query($koneksi, "SELECT * FROM makanan
                                        WHERE nama LIKE '%$keyword%' ");
}
?>



<!DOCTYPE html>
<html>
<head>
  <title>Daftar Makanan</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="newstyle.css">
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"></link>

</head>

<body>
  <header>
  <center>

    RUMAH MAKAN KARTINI
    
  </center>
  </header>

<div class="side">
  <a href="contoh.html">Home</a>
  <a href="makanan.html">Menu</a>
  <a href="#Daftar">Daftar</a>
  <a href="#Kontak">Kontak</a>
  <a href="#Bantuan">Bantuan</a>
</div>

<div class="row">
  <div class="column">
    
                        <form action="" method="post">
                <input type="text" name="keyword" id="keyword" class="myInput" size="40" autocomplete="off" placeholder="masukan keyword nama">
                <button type="submit" name="cari" class="cari">Cari ! </button>
            </form>

            <table id="myTable">
                <tr class="header">
                    <th style="width:5%;">No</th>
                    <th>Nama</th>
                    <th>Harga</th>
                </tr>
                <tr>
                    <?php $i = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($results)) : ?>
                        <td><?= $i; ?></td>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["harga"]; ?></td>

                </tr>
                <?php $i++; ?>
            <?php endwhile; ?>


            </table>
            <div class="paginate">
                <?php for ($i = 1; $i <= $pages; $i++) : ?>
                    <?php if ($i == $page) : ?>
                        <a href="?halaman=<?= $i ?>" style="font-weight : bold; color: red;"><?= $i ?></a>
                    <?php else : ?>
                        <a href="?halaman=<?= $i ?>"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>

</body>
</html>