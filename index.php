<?php 
	//Koneks Database
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "arkademy";

	$koneksi = mysqli_connect($server, $user, $pass, $database)or die(mysqli_error($koneksi));

	//jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{
		$simpan = mysqli_query($koneksi, "INSERT INTO produk (nama_produk, keterangan, harga, jumlah)
										 VALUES ('$_POST[tproduk]', 
										 		'$_POST[tket]', 
										 		'$_POST[tharga]', 
										 		'$_POST[tjumlah]')
										");
		if ($simpan) {
			echo "<script>
					 alert('Simpan data sukses!');
					 document.location='index.php';
			</script>";
		}
		else 
		{
			echo "<script>
					 alert ('Simpan data Gagal:(!');
					 document.location='index.php';
			</script>";
		}

	}

		//Jika tombol edit/hapus di klik
	if(isset($_GET['hal']))
	{
		//tampilkan data yang akan diedit
		if($_GET['hal'] == "edit")
		{
			$tampil = mysqli_query($koneksi, "SELECT * FROM produk WHERE nama_produk = '$_GET[id]'");
				$data = mysqli_fetch_array($tampil);
				if($data) 
				{
					$produk = $data['nama_produk'];
					$vketerangan = $data['keterangan'];
					$vharga = $data['harga'];
					$vjumlah = $data['jumlah'];
				}
		}
	}

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Arkademy</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		
	</div>

	<h1 class="text-center">PRODUK</h1>

	<!-- Awal form --> 

	<div class="card mt-3">
  <div class="card-header bg-primary text-white">
    Form Input Data Produk
  </div>
  <div class="card-body">
    <form method="post" action="">
    	<div class="form-group">
    		<label>Nama Produk</label>
    		<input type="text" name="tproduk" value="<?=@$nama_produk?>" class="form-control" placeholder="Ketik Produk anda disini!" required>

    	<div class="form-group">
    		<label>Keterangan</label>
    		<input type="text" name="tket" value="<?=@$keterangan?>" class="form-control"required>

    	<div class="form-group">
    		<label>Harga</label>
    		<input type="text" name="tharga" value="<?=@$harga?>" class="form-control" required>

    		<div class="form-group">
    		<label>Jumlah</label>
    		<input type="text" name="tjumlah" value="<?=@$jumlah?>" class="form-control" required>
    	</div>

    	<button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
    	<button type="submit" class="btn btn-danger" name="breset">Reset</button>

    </form>
  </div>
</div>
	<!--- Akhir form -->

<!-- Awal table --> 

	<div class="card mt-3">
  <div class="card-header bg-success text-white">
    Daftar Produk 
  </div>
  <div class="card-body">

  	<table class="table table-bordered table-striped">
  		<tr>
  			<th>No.</th>
  			<th>Nama Produk</th>
  			<th>Keterangan</th>
  			<th>Harga</th>
  			<th>Jumlah</th>
  			<th>Aksi</th>
  		</tr>
  		<?php 
  			$no = 1;
  			$tampil = mysqli_query($koneksi, "SELECT * from produk order by nama_produk desc");
  			while ($data = mysqli_fetch_array($tampil)) :



 
  		 ?>
  		<tr>
  			<td><?=$no++;?></td>
  			<td><?=$data['nama_produk']?></td>
  			<td><?=$data['keterangan']?></td>
  			<td><?=$data['harga']?></td>
  			<td><?=$data['jumlah']?></td>
  			<td>
  				<a href="#" class="btn btn-warning"> Edit </a>
  				<a href="#" class="btn btn-danger"> Hapus </a>
  			</td>
  		</tr>
  	
    <?php endwhile; //penutup perulangan while ?>
    </table>
  </div>
</div>
	<!--- Akhir table -->

<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>