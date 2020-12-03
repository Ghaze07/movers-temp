<!DOCTYPE html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ORDER PLACED</title>
    <style>

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }
        table{
            border-collapse: collapse;
        }
        *, ::after, ::before {
            box-sizing: border-box;
        }
        
        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }
                table, th, td {
          border: 1px solid black;
          border-collapse: collapse;
          text-align: center;
          padding: 5px;
        }
        .tdhover:hover {
            background-color: #dee4e9!important;
            color: white;
        }
        td:hover{
            color:white;
        }
        li:hover{
            background-color: #dee4e9!important;
        }
        .ulclass{
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            list-style-position: inside;
            border: 1px solid black;
            padding: 10px;
            margin: 5px;
            align-content: justify;
            text-align: justify;
        }
        li{
            padding: 10px;
            margin: 5px;
            align-content: justify;
            text-align: justify;
        }
        .column {
          float: left;
          width: 50%;
          background-color:;
          background-image: 
        }
        .column1{
            width: 50%;
        }
        
        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
          widows: 50%;
          background-color:;
        }
        .maindiv{
            background-image: url("pix/bg_panga.png");
            background-color: #ccf1ff; 
        }
            </style>
        
  </head>
  <body>
    <div style="background-color:#F7DE6A; padding-top:8px;" class="row">
        <div class="column1">
            <h2 style="margin-left:15px" style="margin-top: 15px" style="padding: 10px;">Dear {{ $farm_manager_name }}, </h2>
            <h4 style="margin-left:15px" style="padding: 10px" class="text-danger">
                A new order has been placed with following details.
                {{--  Visit this link to view the order online {{oder_link_to_view}}. --}}
            </h4>
        </div>
          {{-- <div class="column1"><img src="pix/logo_full.png" alt="xyz"></div> --}}
      </div>
    
    
    <div class="maindiv" >
        <ul type="none" class="ulclass" style="display: flex" style="justify-content: space-between;" style="flex-direction: column;">
            <li style="color:black  ">
                <div class="row">
                    <div class="column">Order Number:</div>
                    <div class="column">{{ $order_number }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column"> Order Time: </div>
                    <div class="column">{{ $created_at }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column"> Order Status: </div>
                    <div class="column">{{ $status }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column">Customer Name: </div>
                    <div class="column">{{ $user_name }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column"> Customer Mobile:</div>
                    <div class="column">{{ '0'.$user_mobile }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column">Delivery Address:</div>
                    <div class="column">{{ $complete_address }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column"> Delivery Region:</div>
                    <div class="column"> {{ $region_name }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column">Delivery City:</div>
                    <div class="column"> {{ $city_name }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column">Recipient Name:</div>
                    <div class="column"> {{ $receiver_name }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column">Recipient Number:</div>
                    <div class="column">{{ '0'.$receiver_mobile }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column">Order Value:</div>
                    <div class="column">{{ $order_total }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column">Delivery Charges:</div>
                    <div class="column">{{ $delivery_charges }}</div>
                </div>
            </li>

            <li style="color:black;  ">
                <div class="row">
                    <div class="column">COD Amount:</div>
                    <div class="column"> {{ $cash_on_delivery }}</div>
                </div>
            </li>
        </ul>
    </div>
    <div style="overflow-x:auto;">
        <h4>Order Details: </h4>
        <table class="table table-hover"">
            <thead class="thead-dark">
                <tr style="background-color : #F7DE6A;" class=" border-dark">
                    <th  style="color: black;" class="text-center">ID</th>
                    <th  style="color: black;" class="text-center">Item Name</th>
                    <th  style="color: black;" class="text-center">Item Quantity</th>
                    <th  style="color: black;" class="text-center">Item Price</th>
                    <th  style="color: black;" class="text-center">Item Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderItems as $key => $orderItem)
                    <tr class="trhover"  style="background-color:#ccf1ff;" class=" border-dark">
                        <td style="color: black;" class="text-center">{{ $key+1 }}</td>
                        <td style="color: black;" class="text-center">{{ $orderItem->farmProduct->product->name }}</td>
                        <td style="color: black;" class="text-center">{{ $orderItem->quantity }}</td>
                        <td style="color: black;" class="text-center">RS {{ $orderItem->farmProduct->unit_price }}</td>
                        <td style="color: black;" class="text-center">RS {{ $orderItem->quantity * $orderItem->farmProduct->unit_price }}</td>
                    </tr> 
                @endforeach
                <tr class="trhover" style="background-color:#ccf1ff;"  >
                    <th style="color: red;" class="text-center" colspan="3">Order Total</th>
                    <td style="color: red;"  class="text-center" colspan="2">RS {{ $order_total }}</td>
                </tr>
                <tr class="trhover" style="background-color:#ccf1ff;"  >
                    <th style="color: red;" class="text-center" colspan="3">Delivery Charges</th>
                    <td style="color: red;"  class="text-center" colspan="2">RS {{ $delivery_charges }}</td>
                </tr>
                <tr class="trhover" style="background-color:#ccf1ff;"  >
                    <th style="color: red;" class="text-center" colspan="3">Grand Total</th>
                    <td style="color: red;"  class="text-center" colspan="2">RS {{ $cash_on_delivery }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <h5>Thanks </h5>
    <h4>{{$farm_name}}</h4>
  </body>
</html>