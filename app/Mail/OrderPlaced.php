<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Order
     */
    protected $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        //
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $farm_manager_name = $this->order->farm->manager;
        $farm_name = $this->order->farm->name;
        $farm_email = $this->order->farm->email;

        $order_number = $this->order->order_number;
        $created_at = $this->order->created_at;

        $status = $this->order->orderStatus->status;

        $user_name = $this->order->user->name;
        $user_mobile = $this->order->user->mobile;

        $complete_address = $this->order->address->complete_address;

        $city_name = $this->order->address->city->name;
        
        $region_name = $this->order->address->city->region->name;

        $receiver_name = $this->order->receiver_name;
        $receiver_mobile = $this->order->receiver_mobile;
        $order_total = $this->order->order_total;
        $delivery_charges = $this->order->delivery_charges;
        $cash_on_delivery = $this->order->cash_on_delivery;

        $orderItems = $this->order->orderItems()->with('farmProduct.product')->get();

        return $this->to($farm_email)->view('mail.orderplaced')
                    ->with([
                        'farm_manager_name' => $farm_manager_name,
                        'farm_name' => $farm_name,
                        'farm_email' => $farm_email,
                        'order_number' => $order_number,
                        'created_at' => $created_at,

                        'status' => $status,
                        'user_name' => $user_name,
                        'user_mobile' => $user_mobile,
                        'complete_address' => $complete_address,
                        'city_name' => $city_name,

                        'region_name' => $region_name,
                        'receiver_name' => $receiver_name,
                        'receiver_mobile' => $receiver_mobile,
                        'order_total' => $order_total,
                        'delivery_charges' => $delivery_charges,
                        'cash_on_delivery' => $cash_on_delivery,

                        'orderItems' => $orderItems
                    ]);
    }
}
