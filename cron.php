<?
mysql_connect();
mysql_select_db('bcpl');

$r=@mysql_query(" select user, pass, email from accounts where id = '1' ");
$d=mysql_fetch_array($r,MYSQL_ASSOC);

$loginURL = "https://catalog.bcpl.lib.md.us/Mobile/MyAccount/Logon";
$overviewURL = "https://catalog.bcpl.lib.md.us/polaris/patronaccount/default.aspx";


$listURL1 = "https://catalog.bcpl.lib.md.us/Mobile/MyAccount/ItemsOut";
$listURL2 = "https://catalog.bcpl.lib.md.us/Mobile/MyAccount/ItemsOut?page=1";
$listURL3 = "https://catalog.bcpl.lib.md.us/Mobile/MyAccount/ItemsOut?page=2";
$listURL4 = "https://catalog.bcpl.lib.md.us/Mobile/MyAccount/ItemsOut?page=3";

$email = '';

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

echo "<li>attempting to login to $loginURL</li>";
$buffer = curl_exec ($curl);




//if all goes well



echo "</li>Overview Page Loaded</li>";
echo $buffer;
$email .= $buffer;

curl_setopt ($curl, CURLOPT_URL, $listURL1);
$buffer = curl_exec ($curl);
echo "</li>Attempting to access page 1 items out vi $listURL1</li>";
echo $buffer;
$email .= $buffer;

curl_setopt ($curl, CURLOPT_URL, $listURL2);
$buffer = curl_exec ($curl);
echo "</li>Attempting to access page 2 items out vi $listURL2</li>";
echo $buffer;
$email .= $buffer;

curl_setopt ($curl, CURLOPT_URL, $listURL3);
$buffer = curl_exec ($curl);
echo "</li>Attempting to access page 3 items out vi $listURL3</li>";
echo $buffer;
$email .= $buffer;

curl_setopt ($curl, CURLOPT_URL, $listURL4);
$buffer = curl_exec ($curl);
echo "</li>Attempting to access page 4 items out vi $listURL4</li>";
echo $buffer;
$email .= $buffer;


curl_close ($curl);


// ok test mailing it out
$subject = "Items out for BCPL.info";
$headers = "MIME-Version: 1.0 \n";
$headers .= "Content-type: text/html; charset=iso-8859-1 \n";
$headers .= "From: insidenothing@gmail.com \n";
$headers .= "BCc: Patrick McGuire <insidenothing@gmail.com> \n";
mail($d[email],$subject,$email,$headers);



    $mail = new Zend_Mail();
    $mail->setBodyText('My Nice Test Text');
    $mail->setBodyHtml('My Nice <b>Test</b> Text');
    $mail->setFrom('patrick@mdwestserve.com', 'From Patrick');
    $mail->addTo('insidenothing@gmail.com', 'To Patrick');
    $mail->setSubject('Zend Email test');
    $mail->send();


?>