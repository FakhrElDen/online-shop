<?php

namespace App\Http\Controllers;

use App\User;
use App\Order;
use App\Status;
use App\Promocode;
use App\DeliveryFees;
use App\OrderProduct;
use App\Mail\AdminMail;
use App\Mail\OrderMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class OrderController extends Controller
{
    public function checkPromoCode(Request $request)
    {
        $input = $request->all();
        $promoCode = Promocode::checkPromocode($input['promocode']);

        return $promoCode->isEmpty()
            ? Status::mergeStatus([], 5010)
            : Status::mergeStatus(['data' => $promoCode], 200);
    }

    public function createOrder(Request $request)
    {
        $input = $request->all();
        $orderCode = IdGenerator::generate(['table' => 'orders', 'length' => 10, 'prefix' => date("Ymd")]);

        User::saveUserData($input);
        
        $promocode = $input['promocode'] ? Promocode::getPromocodeId($input['promocode']) : null;

        $orderData = [
            'user_id' => $input['user_id'],
            'promocode_id' => $promocode['id'] ?? null,
            'total_price' => $input['total'],
            'subtotal_price' => $input['subtotal'],
            'delivery_fees' => $input['delivery_fees'],
            'order_code' => $orderCode,
        ];
        $order = Order::create($orderData);

        OrderProduct::createOrderProduct($input['order_products'], $input['user_id'], $order->id);

        $this->sendOrderMails($input, $orderCode);

        return Status::mergeStatus(['data' => ['Order' => $order, 'OrderProduct' => $order->orderProducts]], 200);
    }

    private function sendOrderMails($input, $orderCode)
    {
        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'order' => $input['order_products'],
            'total_price' => $input['total'],
            'subtotal_price' => $input['subtotal'],
            'delivery_fees' => $input['delivery_fees'],
            'promocode' => $input['promocode'],
            'order_code' => $orderCode,
        ];

        Mail::to($data['email'])->send(new OrderMail($data));
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new AdminMail($data));
    }

    public function listDeliveryFees()
    {
        $result = DeliveryFees::listDeliveryFees();

        return Status::mergeStatus(['data' => $result], 200);
    }

    public function getOrders($user_id)
    {
        $orders = Order::getOrders($user_id);

        return Status::mergeStatus(['data' => $orders], 200);
    }
}
