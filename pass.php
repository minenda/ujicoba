<?php
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

?>
