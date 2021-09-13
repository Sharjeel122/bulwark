<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notificaiton</title>

    <style>
        *{
            margin: 0 auto;
            box-sizing: border-box;
        }
        .reminder-email{
            padding:20px;
        }
    </style>
</head>
<body>
<div class="container" style="width:70%; background-color: white; border: 1px solid black;">
    <div class="head" style="background-color: #F05A22; padding: 10px; text-align: center; color: black; font-size: 22px;">
        <h2>Cyber Bulwark</h2>
    </div>
    <div class="body reminder-email" style="margin-top: 20px;">
        <h2 style="text-align: center;"><b>Reminder Notification</b></h2>
        Hi {{ $name }},<br />
        This is a reminder, that we are still waiting for your reply about the correct website credentials.
        <br /><br />
        we are ready to start working on your website ({{ $website }})
        but unfortunately we are unable to login to Website's admin panel due to incomplete/wrong website credentials.
        <br /><br />
        kindly check and resend credentials so that we can start working on it.<br />
        Thank You,<br />
        Cyber Bulwark Support Team


    </div>
</div>
</body>
</html>
