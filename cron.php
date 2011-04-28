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

curl_setopt( $curl, CURLOPT_FOLLOWLOCATION, true );



curl_setopt( $curl, CURLOPT_COOKIEJAR, $cookie );

    curl_setopt( $curl, CURLOPT_ENCODING, "" );
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $curl, CURLOPT_AUTOREFERER, true );
    curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );    

curl_setopt ($curl, CURLOPT_POSTFIELDS, 'barcodeOrUsername='.$d['user'].'&password='.$d['pass'].'&rememberMe=true');

echo "<li>attempting to login to $loginURL with $d[user]/$d[pass]</li>";
$buffer = curl_exec ($curl);




//if all goes well



echo "</li>Overview Page Loaded</li>";
echo $buffer;


curl_setopt ($curl, CURLOPT_URL, $listURL);
$buffer = curl_exec ($curl);
echo "</li>Attempting to access items out vi $listURL</li>";
echo $buffer;

curl_close ($curl);
?>