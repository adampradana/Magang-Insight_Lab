<?php
$host   = "localhost";
$user   = "root";
$pass   = "";
$db     = "tugas_backend";
$koneksi = mysqli_connect($host, $user, $pass, $db);

//if (!$db) {
//echo "gagal" ;
//} else {
//echo "berhasil" ;
//}

$nama       = "";
$rasa       = "";
$harga      = "";
$bahan      = "";
$topping    = "";
$expired    = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id     = $_GET['id'];
    $sql1   = "delete from tugas_backend where id = '$id'";
    $q1 = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error = "Gagal menghapus data";
    }
}

if ($op == 'edit') {
    $id         = $_GET['id'];
    $sqli       = "select * from tugas_backend where id = '$id'";
    $q1         = mysqli_query($koneksi, $sqli);
    $r1         = mysqli_fetch_array($q1);
    $nama       = $r1['nama'];
    $rasa       = $r1['rasa'];
    $harga      = $r1['harga'];
    $bahan      = $r1['bahan'];
    $topping    = $r1['topping'];
    $expired    = $r1['expired'];

    if ($nama == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) { //untuk create
    $nama = $_POST['nama'];
    $rasa = $_POST['rasa'];
    $harga = $_POST['harga'];
    $bahan = $_POST['bahan'];
    $topping = $_POST['topping'];
    $expired = $_POST['expired'];

    if ($nama && $rasa && $harga && $bahan && $topping && $expired) {
        if ($op == 'edit') { //untuk update
            $sql1 = "update tugas_backend nama = '$nama', rasa = '$rasa', harga = '$harga', bahan = '$bahan', topping = '$topping', expired = '$expired' where id = '$id'";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil di update";
            } else {
                $error = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1 = "insert into tugas_backend(nama,rasa,harga,bahan,topping,expired) values('$nama','$rasa', '$harga', '$bahan', '$topping', '$expired')";
            $q1 = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Berhasil memasukkan data baru";
            } else {
                $error = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silahkan masukkan semua data";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roti Dewi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Rasa</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="rasa" id="rasa">
                                <option value="">- Pilih Rasa -</option>
                                <option value="coklat" <?php if ($rasa == "coklat") echo "selected" ?>>Coklat</option>
                                <option value="strawberry" <?php if ($rasa == "strawberry") echo "selected" ?>>Strawberry</option>
                                <option value="keju" <?php if ($rasa == "keju") echo "selected" ?>>Keju</option>
                                <option value="pisang coklat" <?php if ($rasa == "pisang coklat") echo "selected" ?>>Pisang Coklat</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Bahan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="bahan" name="bahan" value="<?php echo $bahan ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Topping</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="topping" name="topping" value="<?php echo $topping ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Expired</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="expired" name="expired" value="<?php echo $expired ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Roti
            </div>
            <div class="card-body">
                <table class="table">
                    <tread>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Rasa</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Bahan</th>
                            <th scope="col">Topping</th>
                            <th scope="col">Expired</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        <tbody>
                            <?php
                            $sql2   = "select * from tugas_backend order by id desc";
                            $q2     = mysqli_query($koneksi, $sql2);
                            $urut   = 1;
                            while ($r2 = mysqli_fetch_array($q2)) {
                                $id         = $r2['id'];
                                $nama       = $r2['nama'];
                                $rasa       = $r2['rasa'];
                                $harga      = $r2['harga'];
                                $bahan      = $r2['bahan'];
                                $topping    = $r2['topping'];
                                $expired    = $r2['expired'];

                            ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $nama ?></td>
                                    <td scope="row"><?php echo $rasa ?></td>
                                    <td scope="row"><?php echo $harga ?></td>
                                    <td scope="row"><?php echo $bahan ?></td>
                                    <td scope="row"><?php echo $topping ?></td>
                                    <td scope="row"><?php echo $expired ?></td>
                                    <td scope="row">
                                        <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                        <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin untuk mendelete data?')"><button type="button" class="btn btn-danger">Delete</button></a>
                                        
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </tread>
                </table>
            </div>
        </div>
    </div>
</body>

</html>