<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessRequest;
use App\Models\ClientRequest;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    /**
     * Store a new client request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clientRequest = ClientRequest::create([
            'user_id' => \Auth::user()->id,
            'description' => $request->input('description'),
            'vendor_id' => $request->input('vendor_id'),
            'status' => ClientRequest::STATUS_QUEUE
        ]);

        ProcessRequest::dispatch($clientRequest)
            ->delay(now()->addSeconds(5));
    }
}