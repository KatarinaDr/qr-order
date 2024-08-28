<!DOCTYPE html>
<html>

<head>
    <title>Table number: {{$record->number}}</title>
</head>
<style>
            .center {
                line-height: 350px;
                height: 350px;
                border: 3px;
                text-align: center;
            }
            .center img {
                display: block;
            }
            
</style>

<body class="center">
    <h>Table number: {{$record->number}}</h>
        <div class="center">
            <center>
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->format('png')->generate(implode(['link' => $record->number, 'number' => $record->web_page]))) !!} ">
            </center>
        </div>

</body>

</html>

