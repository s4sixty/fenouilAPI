<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\ArrayToXml\ArrayToXml;

use Woocommerce;

class ClientsController extends Controller
{
    
    //Retourner la liste de ous les clients
    public function list(Request $request) {
        return Woocommerce::get('Customers');
    }

    public function listParams(Request $request) {

        $categorie = $request->categorie;
        $age_min = $request->age_min;
        $age_max = $request->age_max;
        $departement = $request->departement;
        $deja_client = $request->deja_client;
        $liste_clients_categorie = [];
        $liste_clients_age = [];
        $liste_clients_departement = [];
        $liste_clients_deja = [];
        
        $liste_globale = Woocommerce::get('Customers');

        foreach($liste_globale as $client) {
            foreach($client["meta_data"] as $elements) {
                    if($elements["key"]=="billing_categorie_socio_pro" && $elements["value"]==strtolower($categorie)) {
                        array_push($liste_clients_categorie,$client);
                    }
            }
        }

        foreach($liste_clients_categorie as $client) {
            foreach($client["meta_data"] as $elements) {
                if($elements["key"]=="billing_birth_date" && 2019-intval(substr($elements["value"], 0, 4))>=$age_min&&2019-intval(substr($elements["value"], 0, 4))<=$age_max) {
                    array_push($liste_clients_age,$client);
                }
            }
        }

        foreach($liste_clients_age as $client) {
            foreach($client["meta_data"] as $elements) {
                    if($elements["key"]=="billing_departement" && $elements["value"]==$departement) {
                        array_push($liste_clients_departement,$client);
                    }
            }
        }

        foreach($liste_clients_departement as $client) {
            if($deja_client=="true") {
                if($client["orders_count"]>0) {
                    array_push($liste_clients_deja,$client);
                }
            } else {
                array_push($liste_clients_deja,$client);
            }
        }

        return $liste_clients_deja;

    }

}
