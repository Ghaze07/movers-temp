<?php

namespace App\Exports;

use App\Order;
use App\Models\Farm;
use App\Models\User;
use App\Models\Address;
use App\Models\OrderStatus;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements 
FromCollection, 
ShouldAutoSize, 
WithMapping, 
WithHeadings 
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    
    public function __construct(String $status, String $from, String $to)
    {
        $this->status = $status;
        $this->from = $from;
        $this->to = $to;

    }

    public function collection()
    {
            return  Order::where('order_status_id', $this->status)
            ->whereDate('created_at','>=', $this->from)
            ->whereDate('created_at','<=', $this->to)
            ->with(['user', 'farm', 'address', 'orderStatus', 'orderItems'])
            ->orderBy('created_at', 'desc')->get();
    }
    /**
    * @return array
    */

    public function map($order): array
    {
        return [ 
          'Islamabad',
           $order->user->name,
           $order->address->complete_address,
           $order->user->mobile,
           $order->user->email,
           $order->address->city->name,
           'Bykea',
           '1',    
           $order->cash_on_delivery,
           'NO',
           'BL',
           'Fish',
           '0'
        ];
        
    }

    //function header in excel
    public function headings(): array
    {
        return [
            'Pickup Location',
            'Consignee Name',
            'Consignee Address',
            'Consignee Mobile Number',
            'Consignee Email',
            'Destination City',
            'Carrier',
            'Pieces',
            'COD',
            'Special Handling',
            'Service Type',
            'Product Details',
            'Insurance/Declared Value'
       ];
   }
}
