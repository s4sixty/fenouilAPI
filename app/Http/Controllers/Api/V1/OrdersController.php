<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Woocommerce;

class OrdersController extends Controller
{
    
    //Retourner la liste de toutes les commandes
    public function list(Request $request) {
        return Woocommerce::get('Orders');
    }

    public function totalProductsSold(Request $request) {
        $result =  Woocommerce::get('Orders');
        $total = 0;
        foreach($result as $order) {
            foreach($order["line_items"] as $order_item) {
                $total += $order_item["quantity"];
            }
        }

        return $total;
    }

}
