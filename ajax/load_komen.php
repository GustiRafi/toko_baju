<?php

session_start();

require '../functions.php';


$id = $_GET['id'];

$query = "SELECT * FROM komen WHERE id_produk = $id ORDER BY id_komen DESC";

$komen = query($query);


?>

<div class="col-md-6 mb-md-0 p-md-4 ">
    <!-- form komen -->
    <form action="" method="post" id="form_Comment">
        <div class="mb-3">
            <input type="hidden" class="form-control" name="id_produk" id="id_produk"
                value="<?php echo $produk['id_produk'] ?>">
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama"
                value="<?php echo $_SESSION['nama']?>" required>
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="isi" id="isi" rows="3" placeholder="Tulis komentar disini"
                required></textarea>
        </div>
        <button class="btn btn-outline-primary" type="submit" name="komen" id="komen"><svg
                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-send-fill mx-1" viewBox="0 0 16 16">
                <path
                    d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083l6-15Zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471-.47 1.178Z" />
            </svg>komen</button>
    </form>
</div>


<!-- isi komen -->
<h3 class="text-primary px-4 pt-3"><b>Komentar</b></h3>
<div class="col-md-6 p-2  ps-md-0 mx-2">

    <?php foreach($komen as $row){ ?>
    <div class="border border-primary rounded-3 mt-3 ">
        <div class="bg-primary text-light rounded-3">
            <p class="px-2"><b style="font-size: 20px;"><?php echo $row["nama"] ?> </b> | posted on
                <?php echo $row["tanggal"] ?>
            </p>
        </div>
        <p class="px-2"><?php echo $row["isi_komen"] ?></p>
    </div>
    <?php } ?>

</div>