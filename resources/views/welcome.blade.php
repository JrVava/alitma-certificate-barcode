<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scan Me</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card{
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            border-radius: 20px;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
        p{
            font-size: 34px;
            color: #31d2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card m-5 p-5 d-flex align-items-center justify-content-center" >
        {!! QrCode::size(400)->style('dot')->eye('circle')->color(49, 210, 242)->margin(1)->generate(route('doctors.form')) !!}
        <p class="mt-4"><i>Scan me</i></p>
        </div>
    </div>
</body>
</html>