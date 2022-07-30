<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SaaSus Token Transfer</title>
</head>

<body>

    <script>
        function tokentransfer() {
            if (window.parent == null || window.parent === window) {
                console.log("SaaSus ERROR: no parents");
                return;
            }
            const data = localStorage.getItem('SaaSus.idToken');
            window.parent.postMessage(`token-transfer:${data}`, "{{$origin}}");
        }
        tokentransfer();
    </script>

</body>

</html>