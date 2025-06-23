<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @foreach ($products as $product)
        <div>
            <h3>{{ $product['name'] }}</h3>
            <p>Price: {{ $product['price'] }}</p>
        </div>
    @endforeach


</body>

</html>