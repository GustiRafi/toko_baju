<?php

require '../functions.php';

$keyword = $_GET["keyword"];

$query = "SELECT * FROM  produk LEFT JOIN kategori USING (id_kategori)
            WHERE nama_produk LIKE
            '%$keyword%' OR
            nama_kategori LIKE '%$keyword%'
            ORDER BY id_produk DESC";
    
$produk = query($query);


?>

<?php foreach($produk as $row) { ?>
<div class=" box flex-row bg-highlight mb-4 px-4">
    <div class="item " style="height: 450px;">
        <a style="text-decoration: none;" href="detail_produk.php?id_produk=<?php echo $row['id_produk'] ?>"
            data-bs-toggle="tooltip" data-bs-placement="top" title="Klik untuk melihat detail produk">
            <div class="text-center shadow-lg pt-0 mt-0 " style="border-radius: 15px;">
                <div class="card bg-primary text-white shadow pt-0 mt-0 " style="width: 18rem; border-radius: 15px;">
                    <img style="border-radius: 15px; height:300px; width: 18rem;"
                        src="img/<?php echo $row['gambar'] ?>">
        </a>
        <div class="card-body">
            <h3><?php echo $row['nama_produk'] ?></h3>
            <p>Rp. <?php echo $row['harga'] ?></p>
            <a href="" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Klik untuk menambahkan produk ke keranjang"><button type="submit"
                    class="rounded-6 btn btn-outline-light w-100"><i class="bi bi-cart-plus-fill mx-2"></i>Masukan Ke
                    Keranjang</button></a>
        </div>
    </div>
</div>
</div>
</div>
<?php } ?>