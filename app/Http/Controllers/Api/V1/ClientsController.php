<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Woocommerce;

class ClientsController extends Controller
{
    
    //Retourner la liste de ous les clients
    public function list(Request $request) {
        return Woocommerce::get('Customers');
    }

}
