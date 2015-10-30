<?php 
   function encrypt($data) {
    $key = "bigdig";  // Clé de 8 caractères max
    $data = serialize($data);
    $td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,"");
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND); 
    mcrypt_generic_init($td,$key,$iv);
    $data = base64_encode(mcrypt_generic($td, '!'.$data));
    mcrypt_generic_deinit($td);
    return $data; 
}
 
function decrypt($data) {
    $key = "bigdig"; 
    $td = mcrypt_module_open(MCRYPT_DES,"",MCRYPT_MODE_ECB,""); 
    $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND); 
    mcrypt_generic_init($td,$key,$iv); 
    $data = mdecrypt_generic($td, base64_decode($data));
    mcrypt_generic_deinit($td); 
 
    if (substr($data,0,1) != '!') 
        return false; 
 
    $data = substr($data,1,strlen($data)-1); 
    return unserialize($data); 
}

function random_string($length) {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'));

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}

function generer_token($nom = ''){
    session_start();
    $token = uniqid(rand(), true);
    $_SESSION[$nom.'_token'] = $token;
    $_SESSION[$nom.'_token_time'] = time();
    return $token;
}

function verifier_token($temps, $referer, $nom = ''){
session_start();
if(isset($_SESSION[$nom.'_token']) && isset($_SESSION[$nom.'_token_time']) && (isset($_POST['token']) || isset($_GET['token'])))
    if($_SESSION[$nom.'_token'] == $_POST['token'] || $_SESSION[$nom.'_token'] == $_GET['token'])
        if($_SESSION[$nom.'_token_time'] >= (time() - $temps))
            if($_SERVER['HTTP_REFERER'] == $referer)
                return true;
return false;
}
?>
