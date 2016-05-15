<?php
//kirim email
$to      = 'rega.blank@gmail.com';
$subject = 'Pemesanan Papercraft #'.$id;
$message = '
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3>Pemesanan papercraft</h3>
<p>
	Terimakasih atas pemesanan papercraft
</p>
<br>Berikut detail pemesanan anda :
Nama:
No HP:
Email:
Alamat:
Ucapan:
tgl_pesan:
----
konten:

</body>
</html>
';
$headers = 'From: info@quicrafts.com' . "\r\n" .
    'Reply-To: info@quicrafts.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
print_r(error_get_last())