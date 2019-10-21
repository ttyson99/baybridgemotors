<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// reCaptcha info
$secret = "6LcixLsUAAAAAIjwusFdE-fXnEeJ14L9NCQv6Rte";
$remoteip = $_SERVER["REMOTE_ADDR"];
$url = "https://www.google.com/recaptcha/api/siteverify";

if (empty($_POST)) {
    echo "Don't load this page directly";
    die();
} else {

    // Form info
    $first_name = strval($_POST["first_name"]);
    $last_name = strval($_POST["last_name"]);
    $phone = strval($_POST["phone"]);
    $email = strval($_POST["email"]);
    $message = strval($_POST["message"]);
    $response = strval($_POST["g-recaptcha-response"]);
    $okMessage = 'Your quote request was successfully submitted.';
    $errorMessage = 'There was an error while submitting your request. Please try again.';
    if (!isset($_POST['g-recaptcha-response'])) {
        echo "reCaptcha not set.";
        die();
    }
    // Curl Request
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, array(
        'secret' => $secret,
        'response' => $response,
        'remoteip' => $remoteip
        ));
    $curlData = curl_exec($curl);
    curl_close($curl);
    // Parse data
    $recaptcha = json_decode($curlData, true);
    if (!$recaptcha["success"]) {
        echo 'ReCaptcha was not validated.';
        die();
    }

    $admin_email = "tony@reddoorit.com";
    $subject = "Your Message to Bay Bridge Motors";
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $phone = $_POST["phone"];
    $to = $_POST["email"];
    $text = $_POST["message"];

    $headers = "From: info@baybridgemotors.com\r\n";
    $headers .= "Reply-To: info@baybridgemotors.com\r\n";
    $headers .= "CC: ";
    $headers .= $admin_email;
    $headers .= "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $message = <<<HEREDOC
<!doctype html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><title></title><!--[if !mso]><!-- --><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]--><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><style type="text/css">#outlook a { padding:0; }
          .ReadMsgBody { width:100%; }
          .ExternalClass { width:100%; }
          .ExternalClass * { line-height:100%; }
          body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }
          table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }
          img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }
          p { display:block;margin:13px 0; }</style><!--[if !mso]><!--><style type="text/css">@media only screen and (max-width:480px) {
            @-ms-viewport { width:320px; }
            @viewport { width:320px; }
          }</style><!--<![endif]--><!--[if mso]>
        <xml>
        <o:OfficeDocumentSettings>
          <o:AllowPNG/>
          <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
        </xml>
        <![endif]--><!--[if lte mso 11]>
        <style type="text/css">
          .outlook-group-fix { width:100% !important; }
        </style>
        <![endif]--><!--[if !mso]><!--><link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700" rel="stylesheet" type="text/css"><style type="text/css">@import url(https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700);</style><!--<![endif]--><style type="text/css">@media only screen and (min-width:480px) {
        .mj-column-per-100 { width:100% !important; max-width: 100%; }
      }</style><style type="text/css"></style></head><body style="background-color:#eee;"><div style="background-color:#eee;"><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="Margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:center;color:#555;">Bay Bridge Motors</div></td></tr></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#fff;background-color:#fff;Margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#fff;background-color:#fff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tr><td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;"><div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:left;color:#555;"><h3>For your records, this is the information you sent us:<br></h3><p>Name: [FIRST] [LAST]</p><p>Phone: [PHONE]</p><p>Email: [EMAIL]</p><p>Message: [MESSAGE]</p></div></td></tr></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="Margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;vertical-align:top;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 outlook-group-fix" style="font-size:13px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><div style="font-family:Ubuntu, Helvetica, Arial, sans-serif;font-size:13px;line-height:1;text-align:center;color:#555;">Copyright (c) 2019 Bay Bridge Motors - 3425 Ettie St., Oakland, CA 94608</div></td></tr></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></div></body></html>
HEREDOC;

    $num = 1;
    $message = strval(str_replace("[FIRST]", $first_name, $message, $num));
    $message = strval(str_replace("[LAST]", $last_name, $message, $num));
    $message = strval(str_replace("[EMAIL]", $to, $message, $num));
    $message = strval(str_replace("[PHONE]", $phone, $message, $num));
    $message = strval(str_replace("[MESSAGE]", $text, $message, $num));

    $result = mail($to, "$subject", $message, $headers, '-finfo@tonytysonstaging.com');

    if ($result) {
        $responseArray = array('type' => 'success', 'message' => $okMessage);
        $redirect = "Location: ";
        $redirect .= strval($_POST['redirect']);
        header($redirect);
    } else {
        $responseArray = array('type' => 'success', 'message' => "Your request could not be sent.  Please try again.");
    }
}

?>
