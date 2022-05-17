<?php 
//koneksi ke database
$conn = mysqli_connect("localhost","root", "", "toko_baju")
        or die ('gagal terkoneksi ke database');

//query
function query ($query) {
    global $conn;
    $result = mysqli_query($conn,$query);
    $rows = [];
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}


// registrasi
function registrasi($data) {
    global $conn;

    $nama = strtolower(stripslashes($data ["nama"] ) );
    $username = strtolower( stripslashes($data ["username"] ) );
    $password = mysqli_real_escape_string( $conn, $data ["password"] );
    $password2 = mysqli_real_escape_string( $conn, $data ["password2"] );

    //cek konfirmasi password
    if ( $password !== $password2 ) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    //cek username sudah terdaftar/belum
    $result = mysqli_query( $conn, "SELECT username FROM user_admin WHERE username = '$username'");
    if ( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert ('Username sudah terdaftar,Silahkan ganti username ...!');
            </script>";
    return false;
    }

    //enskripsi password
    $password = password_hash($password , PASSWORD_DEFAULT);

    //tambahkan data ke database
    mysqli_query($conn, "INSERT INTO user_admin VALUES ('', '$nama', '$username', '$password')");
    return mysqli_affected_rows($conn);

}

//ubah profil
function ubah_profil($data){
    global $conn;
    
    //ambil data dari elemen form
    $id = $_SESSION["id_admin"];
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data["username"]);

    //query ubah data
    $query ="UPDATE user_admin SET
            name_admin = '$nama',
            username = '$username'
            WHERE id_admin = $id";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

//ubah password 
function ubah_pass($data){
    global $conn;
    
    $id = $_SESSION["id_admin"];


    $oldpass= htmlspecialchars($data['pass']);
    $newpass = htmlspecialchars($data["newpass"]);
    $newpass2 = htmlspecialchars($data["newpass2"]);

    $result = mysqli_query($conn,"SELECT * FROM user_admin WHERE id_admin = '$id'");
    $row = mysqli_fetch_assoc($result);

     // cek password lama
    if (password_verify($oldpass,$row["password"])) {
        
        if($newpass2 === $newpass) {
            //enskripsi password baru
            $newpass = password_hash($newpass, PASSWORD_DEFAULT);

            //update password di database
            $query = "UPDATE user_admin SET password = '$newpass' WHERE id_admin = $id";
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);

        } else {
            echo "<script>
                alert ('Konfirmasi password salah');
        </script>";
            return false;
        }
    } else {
        echo "<script>
                alert ('password lama salah');
        </script>";
    }
}

function tambah_kategori($data) {
    global $conn;

    //ambil data dari form
    $nama = htmlspecialchars($data["kategori"]);

    $query = "INSERT INTO kategori VALUES ('','$nama')";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function edit_kategori($data) {
    global $conn;

    $id = $data["id"];
    $nama_kategori = htmlspecialchars($data["nama_kategori"]);

    //query ubah data
    $query = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id_kategori=$id";
    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);

}

function hapus_kategori($id) {
    global $conn;
    
    mysqli_query($conn,"DELETE FROM kategori WHERE id_kategori = $id");
    return mysqli_affected_rows($conn);
}

function tambah_produk($data) {
    global $conn;

    $nama = htmlspecialchars($data["nama_produk"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $harga = htmlspecialchars($data["harga_produk"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $status = htmlspecialchars($data["status"]);

    //upload foto
    $foto = upload_foto();

    if (!$foto) {
        return false;
    }

    //masukan data
    $query = "INSERT INTO produk VALUES (
            '', '$kategori', '$nama', '$harga',
                '$deskripsi', '$foto','$ukuran', '$status', current_timestamp())";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function upload_foto() {
    $namafile = $_FILES['foto']['name'];
    $sizefile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmp_name =$_FILES['foto']['tmp_name'];

    //cek ada/tidak
    if ($error === 4) {
        echo "<script>
                alert('Anda Belum Meng-Upload File');
            </script>";
        return false;
    }

    //cek jenis file
    $ekstensifileValid = ['jpg','jpeg','png'];
    $ekstensifile = explode('.', $namafile);
    $ekstensifile = strtolower(end($ekstensifile));
    if (!in_array($ekstensifile,$ekstensifileValid)) {
        echo "<script>
                alert('Format File yang anda upload tidak sesuai ');
            </script>";
        return false;
    }

    //cek ukuran file
    $maxsize = 10000000;
    if ($sizefile > $maxsize) {
        echo "<script>
                alert('Ukuran File yang Anda upload terlalu besar');
            </script>";
        return false;
    }

    //generate nama file
    $namafilebaru = uniqid();
    $namafilebaru .= ".";
    $namafilebaru .= $ekstensifile;
    move_uploaded_file($tmp_name, '../../img/' . $namafilebaru);

    return $namafilebaru;

}

function edit_produk($data){
    global $conn;

    $id = htmlspecialchars($data["id"]);
    $nama = htmlspecialchars($data["nama_produk"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $fotolama = htmlspecialchars($data["fotolama"]);
    $harga = htmlspecialchars($data["harga"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $status = htmlspecialchars($data["status"]);

    if($_FILES["foto"]["error"] === 4) {
        $foto = $fotolama;
    } else {
        $foto = upload_foto();
    }

    // update data 
    $query = "UPDATE produk SET 
            id_kategori = '$kategori',
            nama_produk = '$nama',
            harga = '$harga',
            deskripsi = '$deskripsi',
            gambar = '$foto',
            ukuran_produk = '$ukuran',
            status_produk = '$status'
            WHERE id_produk = $id";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function hapus_produk($id){
    global $conn;
    
    
    $produk = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk = $id");
    $row = mysqli_fetch_assoc($produk);


  //hapus foto dari folder
    $path = "img/". $row["gambar"];

    if(file_exists($path)){
        unlink($path);
    }

    // hapus data dari database
    mysqli_query($conn,"DELETE FROM produk WHERE id_produk = $id");
    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM  produk LEFT JOIN kategori USING (id_kategori)
            WHERE nama_produk LIKE
            '%$keyword%' OR
            nama_kategori LIKE '%$keyword%'
            ORDER BY id_produk DESC";
    
    return query($query);
}

function transaksi($data){
    global $conn;
    
    $id_produk = htmlspecialchars($data["id_produk"]);
    $nama_pembeli = htmlspecialchars($data["nama_pembeli"]);
    $harga = htmlspecialchars($data["harga"]);
    $telepon = htmlspecialchars($data["telepon"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $alamat = htmlspecialchars($data["Alamat"]);
    $catatan = htmlspecialchars($data["catatan"]);

    $totalHarga = ($harga * $jumlah);

    $query = "INSERT INTO transaksi VALUES
            ('','$id_produk','$nama_pembeli',
            '$telepon','$jumlah',
            '$ukuran','$alamat','$catatan','$totalHarga')";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function komen($data){
    global $conn;

    $id_produk = htmlspecialchars($data["id_produk"]);
    $nama = htmlspecialchars($data["nama"]);
    $isi = htmlspecialchars($data["isi"]);

    $query = "INSERT INTO komen VALUES (
            '','$id_produk','$nama','$isi', current_timestamp())";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

// registrasi
function Daftar($data) {
    global $conn;

    $nama = strtolower(stripslashes($data ["nama"] ) );
    $username = strtolower( stripslashes($data ["username"] ) );
    $email = strtolower( stripslashes($data ["email"] ) );
    $password = mysqli_real_escape_string( $conn, $data ["password"] );
    $password2 = mysqli_real_escape_string( $conn, $data ["password2"] );

    //cek konfirmasi password
    if ( $password !== $password2 ) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai');
            </script>";
        return false;
    }

    //cek username sudah terdaftar/belum
    $result = mysqli_query( $conn, "SELECT username FROM user_pelanggan WHERE username = '$username'");
    if ( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert ('Username sudah terdaftar,Silahkan ganti username ...!');
            </script>";
    return false;
    }

    //enskripsi password
    $password = password_hash($password , PASSWORD_DEFAULT);

    //tambahkan data ke database
    mysqli_query($conn, "INSERT INTO user_pelanggan VALUES ('', '$nama', '$username','$email','$password')");
    return mysqli_affected_rows($conn);

}

function lengakapi_data($data){
    global $conn;

    $id_pelanggan = htmlspecialchars($data["id_pelanggan"]);
    $umur = htmlspecialchars($data["umur"]);
    $jenis_kelamin = htmlspecialchars($data["jenis_kelamin"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $notelp = htmlspecialchars($data["notelp"]);

    mysqli_query($conn, "INSERT INTO detail_pelanggan VALUES (
    '$id_pelanggan', '$umur', '$jenis_kelamin','$alamat','$notelp')");
    return mysqli_affected_rows($conn);
}

//untuk user yang tidak login
function tambah_keranjang2($data){
    global $conn;

    $id_pelanggan = $data["id_pelanggan"];
    $id_produk = $data["id_produk"];

    mysqli_query($conn,"INSERT INTO keranjang2 VALUES('','$id_pelanggan','$id_produk')");
    return mysqli_affected_rows($conn);
}

//untuk user yang tidak login
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'IP tidak dikenali';
    return $ipaddress;
}

//untuk user login
function tambah_keranjang($data){
    global $conn;

    $id_pelanggan = htmlspecialchars( $data["id_pelanggan"]);
    $id_produk = htmlspecialchars($data["id_produk"]);
    $nama_pembeli = htmlspecialchars($data["nama"]);
    $notelp = htmlspecialchars($data["notelp"]);
    $jumlah = htmlspecialchars($data['jumlah']);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $alamat = htmlspecialchars($data["alamat"]);
    $catatan = htmlspecialchars($data["catatan"]);
    $harga = htmlspecialchars($data["harga"]);
    $total_harga =  ($harga * $jumlah);

    mysqli_query($conn,"INSERT INTO keranjang VALUES('','$id_pelanggan','$id_produk',
    '$nama_pembeli','$notelp','$jumlah','$ukuran','$alamat','$catatan','$total_harga')");
    return mysqli_affected_rows($conn);
}

function edit_keranjang($data) {
    global $conn;

    $id_keranjang = htmlspecialchars($data["id_keranjang"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $harga = htmlspecialchars($data["harga"]);
    $total_harga = ($harga*$jumlah);

    $query = "UPDATE keranjang SET jumlah='$jumlah',
            ukuran='$ukuran' total_harga='$total_harga' WHERE id_keranjang=$id_keranjang";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

function ubah($data){
    global $conn;

    $id = $data["id_pelanggan" ];
    $nama = htmlspecialchars($data["Nama"]);
    $notelp = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["Alamat"]);

    $query = "UPDATE keranjang SET nama_pembeli ='$nama',
            no_telp = '$notelp', 
            Alamat = '$alamat' 
            WHERE id_pelangan = $id ";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function check_out(){
    global $conn;

    $id = $_SESSION["id"];

    $produk = query( "SELECT * FROM keranjang WHERE id_pelangan = $id");
    $jumlah = mysqli_query($conn, "SELECT COUNT(*) FROM keranjang WHERE id_pelangan = $id ");
    foreach ($produk as $key => $value) {
        $id_produk = $value["id_produk"];
        $nama = $value["nama_pembeli"];
        $notelp = $value["no_telp"];
        $jumlah = $value["jumlah"];
        $ukuran = $value["ukuran"];
        $alamat = $value["Alamat"];
        $catatan= $value['catatan'];
        $total_harga = $value["total_harga"];
        $sql = "INSERT INTO transaksi (`id_transaksi`, `id_produk`, `nama_pembeli`, `no_telp`, `jumlah`, `ukuran`, `Alamat`, `catatan`, `total_harga`) 
        VALUES (NULL, '$id_produk', '$nama', '$notelp', '$jumlah', '$ukuran', '$alamat', '$catatan', '$total_harga');";
        
        $res = mysqli_query($conn,$sql);
    }
    return mysqli_affected_rows($conn);
}

function riwayat(){
    global $conn;

    $id = $_SESSION["id"];

    $produk = query( "SELECT * FROM keranjang WHERE id_pelangan = $id");
    $jumlah = mysqli_query($conn, "SELECT COUNT(*) FROM keranjang WHERE id_pelangan = $id ");
    foreach ($produk as $key => $value) {
        $id_pelangan = $value["id_pelangan"];
        $id_produk = $value["id_produk"];
        $nama = $value["nama_pembeli"];
        $notelp = $value["no_telp"];
        $jumlah = $value["jumlah"];
        $ukuran = $value["ukuran"];
        $alamat = $value["Alamat"];
        $catatan= $value['catatan'];
        $total_harga = $value["total_harga"];
        $sql = "INSERT INTO riwayat (`id_riwayat`,`id_pelangan`, `id_produk`, `nama_pembeli`, `no_telp`, `jumlah`, `ukuran`, `Alamat`, `catatan`, `total_harga`) 
        VALUES (NULL,'$id_pelangan', '$id_produk', '$nama', '$notelp', '$jumlah', '$ukuran', '$alamat', '$catatan', '$total_harga');";
        
        $res = mysqli_query($conn,$sql);
    }
    return mysqli_affected_rows($conn);
}

function hapus_all_cart(){
    global $conn;

    $id = $_SESSION["id"];

    $sql = "DELETE FROM keranjang WHERE id_pelangan= $id";
    mysqli_query($conn,$sql);
    return mysqli_affected_rows($conn);
}

function hapus_keranjang($id){
    global $conn;

    mysqli_query($conn,"DELETE FROM keranjang WHERE id_keranjang = $id");
    return mysqli_affected_rows($conn);
    
}

function masukan($data){
    global $conn;

    $nama = htmlspecialchars($data["nama"]);
    $isi = htmlspecialchars($data["masukan"]);

    $query = "INSERT INTO  masukan VALUE ('','$nama','$isi')";

    mysqli_query($conn,$query);
    return mysqli_affected_rows($conn);
}

function ubah_profil_pelanggan($data){
    global $conn;
    
    //ambil data dari elemen form
    $id = $_SESSION["id"];
    $nama = htmlspecialchars($data['nama']);
    $username = htmlspecialchars($data["username"]);
    $email = htmlspecialchars($data["email"]);

    //query ubah data
    $query ="UPDATE user_pelanggan SET
            Nama = '$nama',
            Username = '$username',
            Email = '$email'
            WHERE id_pelanggan = $id";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function ubah_data_diri($data){
    global $conn;

    $id = $_SESSION["id"];
    $umur = htmlspecialchars($data['umur']);
    $alamat = htmlspecialchars($data["alamat"]);
    $notelp = htmlspecialchars($data["notelp"]);

    //query ubah data
    $query ="UPDATE detail_pelanggan SET
            umur = '$umur',
            Alamat = '$alamat',
            No_telp = '$notelp'
            WHERE id_pelanggan = $id";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function ubah_password_pembeli($data){
    global $conn;
    
    $id = $_SESSION["id"];


    $oldpass= htmlspecialchars($data['pass']);
    $newpass = htmlspecialchars($data["newpass"]);
    $newpass2 = htmlspecialchars($data["newpass2"]);

    $result = mysqli_query($conn,"SELECT * FROM user_pelanggan WHERE id_pelanggan = '$id'");
    $row = mysqli_fetch_assoc($result);

     // cek password lama
    if (password_verify($oldpass,$row["Password"])) {
        
        if($newpass2 === $newpass) {
            //enskripsi password baru
            $newpass = password_hash($newpass, PASSWORD_DEFAULT);

            //update password di database
            $query = "UPDATE user_pelanggan SET password = '$newpass' WHERE id_pelanggan = $id";
            mysqli_query($conn, $query);

            return mysqli_affected_rows($conn);

        } else {
            echo "<script>
                alert ('Konfirmasi password salah');
        </script>";
            return false;
        }
    } else {
        echo "<script>
                alert ('password lama salah');
        </script>";
    }
}


?>