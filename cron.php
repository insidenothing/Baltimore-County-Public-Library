<?
mysql_connect();
mysql_select_db('bcpl');

$r=@mysql_query(" select user, pass from accounts where id = '1' ");
$d=mysql_fetch_array($r,MYSQL_ASSOC);

$loginURL = "https://catalog.bcpl.lib.md.us/Mobile/MyAccount/Logon";
$overviewURL = "https://catalog.bcpl.lib.md.us/polaris/patronaccount/default.aspx";
$listURL = "https://catalog.bcpl.lib.md.us/Mobile/MyAccount/ItemsOut";

$curl = curl_init();
// Set options
curl_setopt ($curl, CURLOPT_URL, $loginURL);
curl_setopt ($curl, CURLOPT_TIMEOUT, '5');
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, '1');
curl_setopt ($curl, CURLOPT_POSTFIELDS, 'barcodeOrUsername='.$d['user'].'&password='.$d['pass'].'&rememberMe=true');

$buffer = curl_exec ($curl);

curl_setopt ($curl, CURLOPT_URL, $listURL);
curl_setopt ($curl, CURLOPT_TIMEOUT, '5');
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, '1');

$buffer2 = curl_exec ($curl);

curl_close ($curl);

//if all goes well

echo $buffer."<hr>".$buffer2;



?>