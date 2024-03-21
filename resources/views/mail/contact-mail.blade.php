<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <h1>You have a new Contact</h1>
    <ul>
        <li>
            Name: {{ $data['name'] }}
        </li>
        <li>
            Email: {{ $data['email'] }}
        </li>
        <li>
            <u>Message</u> 
            <br><br>

            {{ $data['message'] }}
        </li>
    </ul>
</body>
</html>