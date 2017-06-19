<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!-- Created by Nik Gunawan Monikos LLC-->

<html>

<head>
    <link rel="stylesheet" type="text/css" href="/mvc/public/css/main.css">

</head>

<body class='email-page'>

    <?php

        require_once 'db_init.php';

        $name = $_POST['name'];
        $drug = $_POST['drug'];
        $mnemonic = $_POST['mnemonic'];
        $from = 'From: Monikos'; 
        $to = 'monikos.llc@gmail.com'; 
        $subject = 'New Mnemonic Suggestion';
        $body = "From: $name\n Message:\n $mnemonic Drug: $drug";
 
        if ($_POST['submit']) {
            $to      =  'monikos.llc@gmail.com';
            $subject = 'New Mnemonic Request';
            
            $message = 'new mnemonic for '.$drug."\nname of mnemonic:".$name."\nmnemonic:".$mnemonic."\n".

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= 'From: <monikosguide@monikos.com>' . "\r\n";
            
            if(mail($to, $subject, $message, $headers)){
                echo '<p>Thanks, your hint has been sent!</p>';
                $collection = $client -> monikos -> Users;
                $find = $collection -> findOne(
                    ['username' => $name]
                );
                $new = $find['capsules'] + 200;
                $result = $collection->updateOne(
                    ['username'=> $name],
                    ['$set'=>['capsules'=> $new]]
                );
            } else {
                echo "failed to send email :(";
            }
        }
        ?>

        <a class=back-btn href=../mvc/public/home/drugDatabase>Back</a>
</body>

</html>
