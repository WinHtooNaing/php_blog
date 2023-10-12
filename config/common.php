<?php

// csrf attack

if (empty($_SESSION['_token'])) {
    if (function_exists('random_bytes')) {
        $_SESSION['_token'] = bin2hex(random_bytes(32));
    } else {
        // Fallback to a less secure method if random_bytes is not available
        $_SESSION['_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}

if($_SERVER['REQUEST_METHOD']  === 'POST'){
    if(!hash_equals($_SESSION['_token'],$_POST['_token'])) {
        echo 'Invalid CSRF token';
        die();
    }else{
        unset($_SESSION['_token']);
    }
}

/**
 * Escapes HTML for output
 * ဒီ function ကို ဘယ်နေရာမှာ မှ မသုံးရသေးဘူး 
 * xss attack
 */
function escape($html) {
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}

?>