<!DOCTYPE html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h4>Dear {{ $farm_manager_name }}, </h4>
    <h5>
        A new order has been placed with following details.
        {{--  Visit this link to view the order online {{oder_link_to_view}}. --}}
    </h5>
    <ul>
        <li>
            Order Number: {{ $order_number }}
        </li>
        <li>
            Order Time: {{ $created_at }}
        </li>
        <li>
            Order Status: {{ $status }}
        </li>
        <li>
            Customer Name: {{ $user_name }}
        </li>
        <li>
            Customer Mobile: {{ $user_mobile }}
        </li>
        <li>
            Delivery Address: {{ $complete_address }}
        </li>
        <li>
            Delivery Region: {{ $region_name }}
        </li>
        <li>
            Delivery City: {{ $city_name }}
        </li>
        <li>
            Recipient Name: {{ $receiver_name }}
        </li>
        <li>
            Recipient Number: {{ $receiver_mobile }}
        </li>
        <li>
            Order Value: {{ $order_total }}
        </li>
        <li>
            Delivery Charges: {{ $delivery_charges }}
        </li>
        <li>
            COD Amount: {{ $cash_on_delivery }}
        </li>
    </ul>

    <h4>Order Details: </h4>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Item Quantity</th>
                <th>Item Price</th>
                <th>Item Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItems as $key => $orderItem)
                <tr>
                    <th>{{ $key+1 }}</th>
                    <td>{{ $orderItem->farmProduct->product->name }}</td>
                    <td>{{ $orderItem->quantity }}</td>
                    <td>{{ $orderItem->farmProduct->unit_price }}</td>
                    <td>{{ $orderItem->quantity * $orderItem->farmProduct->unit_price }}</td>
                </tr> 
            @endforeach
            
            <tr>
                <td colspan="3">Grand Total</td>
                <td colspan="2">{{ $order_total }}</td>
            </tr>
            
        </tbody>
    </table>

    <h5>Thanks </h5>
    <h4>{{$farm_name}}</h4>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>