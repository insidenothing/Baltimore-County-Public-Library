<?
mysql_connect();
mysql_select_db('bcpl');

$r=@mysql_query(" select user, pass from accounts where id = '1' ");
$d=mysql_fetch_array($r,MYSQL_ASSOC);

$loginURL = "https://catalog.bcpl.lib.md.us/Mobile/MyAccount/Logon";
$overviewURL = "https://catalog.bcpl.lib.md.us/polaris/patronaccount/default.aspx";
$listURL = "https://catalog.bcpl.lib.md.us/polaris/patronaccount/itemsout.aspx";

$curl = curl_init();
// Set options
curl_setopt ($curl, CURLOPT_URL, $loginURL);
curl_setopt ($curl, CURLOPT_TIMEOUT, '5');
curl_setopt ($curl, CURLOPT_RETURNTRANSFER, '1');
curl_setopt ($curl, CURLOPT_POSTFIELDS, 'textboxBarcodeUsername='.$d['user'].'&textboxPassword='.$d['pass'].'&buttonSubmit=Log In');

$buffer = curl_exec ($curl);
curl_close ($curl);

//if all goes well

echo $buffer;

?>