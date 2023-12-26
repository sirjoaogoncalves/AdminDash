<?php

namespace App\Http\Controllers;


use App\Models\Cliente;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;

class ClientController extends Controller
{
public function index(Request $request)
{
    $totalClients = Cliente::count();
    $activeClients = Cliente::where('status', 'active')->count();
    $inactiveClients = Cliente::where('status', 'inactive')->count();

    // Retrieve the search term from the request
    $search = $request->input('search');

    // Query to get all clients or filter by search term
    $clients = ($search)
        ? Cliente::where('name', 'like', '%' . $search . '%')->get()
        : Cliente::all();

    return view('clients.index', compact('clients', 'totalClients', 'activeClients', 'inactiveClients'));
}
public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:Active,Inactive',
        ]);

        // Create a new client
        Cliente::create($validatedData);

        // Redirect back to the client list with a success message
        return redirect()->route('clients.index')->with('success', 'Client added successfully!');
    }
     public function updateStatus(Cliente $client)
    {
        // Validate the request
        request()->validate([
            'status' => 'required|in:Active,Inactive',
        ]);

        // Update the client's status
        $client->update([
            'status' => request('status'),
        ]);

        // Redirect back
        return redirect()->back()->with('success', 'Client status updated successfully.');
    }
    public function destroy($id)
{
    // Find the client
    $client = Cliente::findOrFail($id);

    // Delete the client
    $client->delete();

    // Redirect back with a success message
    return redirect()->route('clients.index')->with('success', 'Cliente apagado com sucesso.');
}

public function edit(Cliente $client)
{
    return view('clients.edit', compact('client'));
}
public function update(Request $request, Cliente $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'status' => 'required|in:Active,Inactive',

        ]);

        $client->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'status' => $request->status,

        ]);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully');
    }

public function exportClients(Request $request)
    {
$clients = Cliente::all(); // Get all clients

    $csvFileName = 'clients.csv'; // Name of the CSV file

    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$csvFileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0",
    ];

    $handle = fopen('php://output', 'w');

    // Add CSV headers
    fputcsv($handle, ['ID', 'Name', 'Phone', 'Status']);

    // Add data for each client
    foreach ($clients as $client) {
        fputcsv($handle, [$client->id, $client->name, $client->phone, $client->status]);
    }

    fclose($handle);

    return Response::make(rtrim(ob_get_clean(), "\n"), 200, $headers);
}
    }

