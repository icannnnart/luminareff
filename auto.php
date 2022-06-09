<?php
error_reporting(0);
function nama()
   {
   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   $ex = curl_exec($ch);
   // $rand = json_decode($rnd_get, true);
   preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
   return $name[2][mt_rand(0, 14) ];
   }
function angkarand($panjang)
{
    $karakter= '123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}

echo "[+] Lumina Auto Reff\n\n\n";
echo "[?] Mau reff berapa : ";
$reff = trim(fgets(STDIN));
for ($i=0; $i < $reff; $i++) { 

ngulang:
$ipnya = getkomen();
$nope = '8'.angkarand(10);
$nama = explode(" ", nama());
$nama1 = $nama[0];
$nama2 = $nama[1];
$emailnya = $nama1.angkarand(5)."@gmail.com";
$fullname = $nama1." ".$nama2;

$url = "https://api.lumina.mba/mobile/users/register/";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
   "Content-Type: application/json",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = '{"email":"'.$emailnya.'","password":"'.$nama1.'123#","phone_number":"'.$nope.'"}';

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
$mentah = json_decode($resp,true);
$tokennya = $mentah['token'];
//print_r($resp);
if ($tokennya != NULL) {
  echo "[+] Mencoba Mendaftar Dengan Email : $emailnya\n";
} elseif (strpos($resp, 'Kamu terkena batasan')) {
   echo "[-] Gagal Limit\n[+] Mencoba Kembali\n";
   sleep(5);
    goto ngulang;
} else {
    echo "[-] Gagal register\n[+] Mencoba Kembali\n";
    goto ngulang;
}




$url = "https://api.lumina.mba/mobile/workers/biodata/";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


$headers = array(
   "Content-Type: application/json",
   "Authorization: Token $tokennya",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = '{"birth_date":"1997-06-09T00:00:00.000002Z","full_name":"'.$fullname.'","gender":"male","profile_card_id":"f60af855-1ebf-4e52-bffe-d9a52f7f2b23","referral_code":"IHSAN194","register_references":["13c59f47-5fbb-487e-b699-944c4799658b","6ebc285c-655b-4c9c-a2e0-1959d870c23a","a9401613-ec53-41a6-b268-805068ccae51","671adc7b-3e78-479b-9873-eee7c6ebc723"]}';//ganti kode reffmu

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

//for debug only!
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
if (strpos($resp, $fullname)) {
  echo "[+] Sukses Mendaftar Dengan Email : $emailnya\n";
} else {
   echo "[-] Gagal Ngereff\n[+] Mencoba Kembali\n";
   goto ngulang;
}
sleep(1);
}





?>
