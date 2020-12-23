<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="@yield('description', 'Zaynab Fish Farm - Hassan Abdal. The organic farm fresh Pangasius fish producer in Pakistan.')">
    <meta name="author" content="Asaheeb Est, Riyadh">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        

        .page-break {
            page-break-after: always;
            page-break-inside: avoid;
            display: block !important;
        }
        @media print {
            
        .btn {
                display: none;
            }
        
        }
    </style>
    
</head>
<body>
    <div class="container mt-5">
        <div class="row">
                <button  class="btn btn-primary mb-2 ml-1" onClick="window.print()">Print</button>
                &nbsp;
                <a href="{{route('order.index')}}" class="btn btn-danger mb-2 ml-1">Back</a>   
        </div>
        {{-- Initialising variable $label for columns layout and $page for page break div --}}
        <?php 
            $label = 0; 
            $page = 1;
        ?>
        @foreach($orders as $order)
        {{-- checking condition if remainder of $label is not equal to 0 then start row  --}}
            @if( !($label%2))
                <div class="row">
            @endif
                <div class="col-md-6 border border-secondary mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-right">{{ $order->user->name }}</h5>
                        </div>
                        <div class="col-md-6">    
                            <h5 class="text-left">(0{{ $order->receiver_mobile }})</h5>
                        </div>
                    </div>
                    <div class="col text-left ">
                        <h6 class="text-justify">{{ $order->address->complete_address }}</h6>
                    </div>
                    <div class="row ml-1">
                        <div class="col text-left">
                            <h4>
                                @foreach ($order->orderItems as $orderItem)
                                    {{$orderItem->quantity}} Kg
                                @endforeach
                            </h4>
                        </div>
                        <div class="col text-right mr-4">
                          <h4>Rs.{{ $order->cash_on_delivery }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-justify ml-4 mb-1">{{ $order->processing_option }}/{{$order->further_instructions}}</p>
                        </div>
                        <div class="col-md-4 text-right">
                            {{-- Google Infographics api for generating QR code --}}
                            @php
                                $width = $height = 80;
                                $url   = urlencode("https://zaynabfishfarm.com");
                                echo "<img src=\"http://chart.googleapis.com/chart?chs={$width}x{$height}&cht=qr&chl=$url\" />";   
                            @endphp   
                        </div>
                        <div class="row ml-4">secondary mobile number:&nbsp;<h5>0{{ $order->user->mobile }}</h5></div>
                    </div>                  
                </div>
                <?php $label++ ?>
            @if( !($label%2) )
                </div>
            @endif

            {{-- checkking condition if number of columns on page exceed from 12 than break the page --}}
            @php
                if(!($page%12) )
                {
                    echo '<div class="page-break">&nbsp;</div>';
                }   
                $page++;
            @endphp
                
        @endforeach

        
    </div>
    
</body>
</html>
