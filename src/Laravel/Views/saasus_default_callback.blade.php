<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Auth Callback</title>
</head>

<body>

    <script>
        localStorage.setItem('SaaSus.idToken', "{{$idToken}}");
        location.href = "/";
    </script>

</body>

</html>