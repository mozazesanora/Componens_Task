<?php  

function encrypt( $key, $plaintext, $meta = '' ) {

	// Generate valid key
	$key = hash_pbkdf2( 'sha256', $key, '', 10000, 0, true );

	// Inisialisasi meta data
	$meta = serialize($meta);

	// Acak data
	$mac_key = hash_hmac( 'sha256', 'mac', $key, true );
	$enc_key = hash_hmac( 'sha256', 'enc', $key, true );
	$enc_key = substr( $enc_key, 0, 32 );

	// Improve :D
	$temp = $nonce = ( 16 > 0 ? mcrypt_create_iv( 16 ) : "" );
	$temp .= hash_hmac( 'sha256', $plaintext, $mac_key, true );
	$temp .= hash_hmac( 'sha256', $meta, $mac_key, true );
	$mac = hash_hmac( 'sha256', $temp, $mac_key, true );
	$siv = substr( $mac, 0, 16 );

	// key encode
	$enc = mcrypt_encrypt( 'rijndael-128', $enc_key, $plaintext, 'ctr', $siv );
	return base64_encode( $siv . $nonce . $enc );

}

function decrypt( $key, $ciphertext, $meta = '' ) {

	// Generate valid key
	$key = hash_pbkdf2( 'sha256', $key, '', 10000, 0, true );

	// Serialize metadata
	$meta = serialize($meta);

	// Derive two subkeys from the original key
	$mac_key = hash_hmac( 'sha256', 'mac', $key, true );
	$enc_key = hash_hmac( 'sha256', 'enc', $key, true );
	$enc_key = substr( $enc_key, 0, 32 );

	// Unpack MAC, nonce and encrypted message from the ciphertext
	$enc = base64_decode( $ciphertext );
	$siv = substr( $enc, 0, 16 );
	$nonce = substr( $enc, 16, 16 );
	$enc = substr( $enc, 16 + 16 );

	// Decrypt message
	$plaintext = mcrypt_decrypt( 'rijndael-128', $enc_key, $enc, 'ctr', $siv );

	// Verify MAC, return null if message is invalid
	$temp = $nonce;
	$temp .= hash_hmac( 'sha256', $plaintext, $mac_key, true );
	$temp .= hash_hmac( 'sha256', $meta, $mac_key, true );
	$mac = hash_hmac( 'sha256', $temp, $mac_key, true );
	if ( $siv !== substr( $mac, 0, 16 ) ) return null;

	return $plaintext;

}
?>