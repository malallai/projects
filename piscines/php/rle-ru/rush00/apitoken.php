<?php
$post = [
    'grant_type' => 'client_credentials',
    'client_id' => '0029f19eaa507a37628745e38f3c6a4120c4f66754778aa23aa91dd24ea6e2c8',
    'client_secret' => 'cc086bd28e02648d21dd27621b39ffda056d363e3dd123e81cc57b77d0c93cd8',
];
$ch = curl_init('https://api.intra.42.fr/oauth/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$response = get_object_vars(json_decode(curl_exec($ch)));
curl_close($ch);

// var_dump($response['access_token']);
// print_r($response);
$crl = curl_init('https://api.intra.42.fr/v2/cursus_users/');
// $crl = curl_init('https://api.intra.42.fr/v2/cursus/42/levels/?range=2-10');
// $crl = curl_init('https://api.intra.42.fr/v2/campus_users/?filer[campus]=1');
// $crl = curl_init('https://api.intra.42.fr/v2/users/?filer[primary_campus_id]=1&filer[updated_at]');
// $crl = curl_init('https://api.intra.42.fr/v2/users/rle-ru');
//&filer[campus]=1 JSON.parse(http_client.get(“/v2/users/#{username}“).body)[“cursus_users”][0][“level”].to_s
$headr = array();
$headr[] = 'Content-type: application/json';
$headr[] = 'Authorization: Bearer '.$response['access_token'];

curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($crl, CURLOPT_HTTPHEADER,$headr);
$rest = json_decode(curl_exec($crl), true);
curl_close($crl);
// var_dump($rest);
print_r($rest);

?>
