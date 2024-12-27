<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <p>Date: <?= $curdate; ?></p>
    <p>Congratulations! <?= $business_name; ?></p>
    <p>You are successfully registered!.</p>
    <p>Login Lab Panel using this link: <a href="<?= $login_link; ?>"><?= $login_link; ?></a></p>
    <p>Here is your Login Email ID: <b><?= $business_email; ?></b> and Password: <b><?= $password; ?></b></p>
    <p>Thank you!</p>

</body>

</html>