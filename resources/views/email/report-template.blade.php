<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Send Notificaiton</title>

    <style>
        *{
            margin: 0 auto;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<div class="container" style="width:70%; background-color: white; border: 1px solid black;">
    <div class="head" style="background-color: #F05A22; padding: 10px; text-align: center; color: black; font-size: 22px;">
        <h2>Cyber Bulwark</h2>
    </div>
    <div class="body" style="margin-top: 20px;">

        <h2 style="text-align: center;"><b>Hi {{ $name }}, New Report Uploaded</b></h2>
        <h4 style="text-align: center;">Click/Paste URL for login <b><a href="https://edenspell.com/cyber-bulwark">https://edenspell.com/cyber-bulwark</a> for check the report or please check the attachement </b></h4>
        <table border="1" cellpadding="8" style="width: 90%; margin-top: 20px; border-collapse: collapse; margin-bottom: 20px;">
            <tr>
                <th>Report Title</th>
                <td>{{ $report_title }}</td>
            </tr>
            <tr>
                <th>Website</th>
                <td>{{ $website }}</td>
            </tr>
            <tr>
                <th>Uploaded By</th>
                <td>Support Team</td>
            </tr>
        </table>

    </div>
</div>
</body>
</html>
