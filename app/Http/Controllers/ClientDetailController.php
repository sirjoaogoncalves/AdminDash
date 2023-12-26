<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Service;
use Illuminate\Http\Request;

class ClientDetailController extends Controller
{
  public function show(Cliente $client)
    {
        // Fetch the client details and associated services
        $client = $client->load('services');

        // Fetch all services from the database
        $services = Service::all();

        // Pass the client and services to the view
        return view('clients.detail', compact('client', 'services'));
    }

    public function addService(Request $request, Cliente $client)
    {
        // Validate the request
        $request->validate([
            'service' => 'required|exists:services,id',
        ]);

        // Attach the selected service to the client
        $service = Service::find($request->input('service'));

        if ($service) {
            $client->services()->attach($service);
            return redirect()->back()->with('success', 'Serviço adicionado com sucesso.');
        }

        return redirect()->back()->with('error', 'Falha ao adicionar o serviço.');
    }
    public function removeService(Cliente $client, Service $service)
{
    $client->services()->detach($service);

    return redirect()->back()->with('success', 'Serviço removido com sucesso.');
}
}
