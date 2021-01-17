<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessRequest;
use App\Models\ClientRequest;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    /**
     * Execute a request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function execute(Request $request, $id)
    {
        $clientRequest = ClientRequest::findOrFail($id);
        $clientRequest->update([
            'status' => ClientRequest::STATUS_EXECUTED
        ]);

    }
}