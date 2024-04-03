<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <style>
            
        </style>      
    </head>
    <body>
        <h1>Order</h1>
        <h3>Hi, This <Strong style="font-family: cursive;">{{ $data['name'] }}'s</Strong> order.</h3>
        <h3>Order Code</h3>
        <h3>{{ $data['order_code'] }}</h3>
        <table class="table">
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Quantity</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data['order'] as $order)
            <tr>
                <td>{{ $order['name'] }}</td>
                <td>{{ $order['price'] }}</td>
                <td>{{ $order['quantity'] }}</td>
            </tr>
            @endforeach 
            </tbody>
        </table>
        <h3>Subtotal Price</h3>
        <h3>{{ $data['subtotal_price'] }}</h3>
        <h3>Delivery Fees</h3>
        <h3>{{ $data['delivery_fees'] }}</h3>
        <h3>Promo Code</h3>
        <h3>{{ $data['promocode'] }}</h3>
        <h3>Total Price</h3>
        <h3>{{ $data['total_price'] }}</h3>
        
    </body>
</html>