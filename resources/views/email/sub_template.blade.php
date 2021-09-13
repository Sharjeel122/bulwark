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
        p, ul{
            font-size: 20px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    {{-- <h1 style="text-align: center;"><b>New Subscription</b></h1> --}}
    <p>Hello <b>{{$name}}</b></p>
    <p>Thanks for Subscribing to Cyber Bulwark <b>{{$package_name}}</b></p>
    <p>Your Package includes the following:</p>
    <ul>
        @foreach ($package_list as $list)
            <li>{{$list}}</li>
        @endforeach
    </ul>
    <p>{{$description}}</p>
    <p>You can login to the Customer dashboard to add required website details, view performance reports, initiate support tickets and manage your subscription.</p>
    <p>We are glad to have you with us and our team will make sure that your website is always:</p>
    <p><b>SECURED</b> <b>OPTIMIZED</b> & <b>UPDATED</b></p>
    <p>Sincerely</p>
    <p>Cyber Bulwark Team</p>
</body>
</html>
