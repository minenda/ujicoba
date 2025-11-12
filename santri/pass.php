<?php
// ====== koneksi ke database ======
$conn = new mysqli("localhost", "root", "minenda", "db_ponpes");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// ====== fungsi pengganti random_int untuk PHP 5 ======
function my_random_int($min, $max) {
    // jika openssl tersedia, pakai yang aman
    if (function_exists('openssl_random_pseudo_bytes')) {
        $range = $max - $min;
        if ($range < 1) return $min;
        $bytes = (int) ceil(log($range + 1, 256));
        $result = 0;
        do {
            $randomBytes = openssl_random_pseudo_bytes($bytes);
            $val = 0;
            for ($i = 0; $i < $bytes; $i++) {
                $val = ($val << 8) + ord($randomBytes[$i]);
            }
            $result = $val % ($range + 1);
        } while ($result > $range);
        return $min + $result;
    }
    // fallback
    return mt_rand($min, $max);
}

// ====== fungsi generator password ======
function generate_pronounceable_password($length = 10) {
    $vowels = array('a','e','i','o','u');
    $consonants = array('b','c','d','f','g','h','j','k','l','m','n','p','r','s','t','v','w','y','z');
    $password = '';
    $use_vowel = my_random_int(0, 1);

    while (strlen($password) < $length - 2) {
        if ($use_vowel) {
            $password .= $vowels[my_random_int(0, count($vowels) - 1)];
        } else {
            $password .= $consonants[my_random_int(0, count($consonants) - 1)];
        }
        $use_vowel = !$use_vowel;
    }

    $password .= my_random_int(10, 99);
    return $password;
}

// ====== fungsi pengganti password_hash untuk PHP 5 ======
if (!function_exists('password_hash')) {
    function password_hash($password, $algo = PASSWORD_DEFAULT) {
        return md5($password); // ⚠️ tidak seaman bcrypt, tapi masih bisa dipakai di PHP 5
    }
}

// ====== proses pendaftaran ======
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama  = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    if ($nama && $email) {
        $password_plain = generate_pronounceable_password(10);
        $password_hash  = password_hash($password_plain, PASSWORD_DEFAULT);
        //$password_hash  = password_hash($password_plain);

        $stmt = $conn->prepare("INSERT INTO tbl_santri_baru (nama_santri, email, pass, password) VALUES ('$nama', '$email', '$password_plain', '$password_hash')");
        //$stmt->bind_param("sss", $nama, $email, $password_hash);
        $stmt->execute();

        echo "<p>Pendaftaran berhasil!</p>";
        echo "<p><b>Nama:</b> $nama<br>";
        echo "<b>Email:</b> $email<br>";
        echo "<b>Password login Anda:</b> <span style='color:blue'>$password_plain</span></p>";
        echo "<p><i>Harap simpan password ini baik-baik.</i></p>";
    } else {
        echo "<p style='color:red'>Nama dan email wajib diisi!</p>";
    }
}
?>

<!-- ====== FORM PENDAFTARAN ====== -->
<form method="post">
    <label>Nama:</label><br>
    <input type="text" name="nama" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <button type="submit">Daftar</button>
</form>
