<?php

namespace App\Http\Controllers;

use Gerencianet\Gerencianet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    private function api()
    {
        $options = [
            'client_id' => env('GERENCIANET_CLIENT_ID'),
            'client_secret' => env('GERENCIANET_CLIENT_SECRET'),
            'pix_cert' => base_path() . '/app/certificates/certificado.pem',
            'sandbox' => false,
            'debug' => false
        ]; 

        $api = new Gerencianet($options);

        return $api;
    }

    public function create(Request $request)
    {
        $input = $request->json()->all();

        $validated = Validator::make($request->all(),
            [
                'ammount' => [
                    'required',
                    'string',
                    'regex:/^[0-9]{1,10}\\.[0-9]{2}$/i'
                ]
            ]
        );

        if ($validated->fails())
        {
            return response('error');
        }

        $body = [
            "calendario" => [
                "expiracao" => 3600
            ],
            "devedor" => [
                "cpf" => "18853873698",
                "nome" => "Cliente Pagador"
            ],
            "valor" => [
                "original" => strval($input['ammount'])
            ],
            "chave" => "fad430df-5480-492a-99b9-8d5f9285fb84",
            "solicitacaoPagador" => "422453"
        ];

        $resp = $this->api()->pixCreateImmediateCharge([], $body);

        $params = [
            'id' => $resp['loc']['id']
        ];

        $qrcode = $this->api()->pixGenerateQRCode($params);

        DB::table('orders')->insert([
            'user_id' => '1',
            'expiration' => '3600',
            'txid' => $resp['txid'],
            'loc_id' => $resp['loc']['id'],
            'loc' => '',
            'status' => strtolower($resp['status']),
            'ammount' => $input['ammount'],
            'pix_key' => $resp['chave']
        ]); 

        return response()->json(json_encode(array(
            'pix' => $qrcode['qrcode'],
            'image' => $qrcode['imagemQrcode'],
            'ammount' => $input['ammount']
        )));
    }
}
