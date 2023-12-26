<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ServiceController extends Controller
{
   public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Service::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('services.index')->with('success', 'Service created successfully!');
    }
 public function show(Service $service)
    {
        return view('services.detail', compact('service'));
    }

      public function exportServices()
    {
        // Fetch all services from the database
        $services = Service::all();

        // Define the CSV file name
        $fileName = 'services_export.csv';

        // Generate CSV content
        $csvContent = "ID,Name\n";

        foreach ($services as $service) {
            $csvContent .= "{$service->id},{$service->name}\n";
        }

        // Store the CSV content in the storage path
        Storage::put($fileName, $csvContent);

        // Generate a response with the CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ];

        return Response::make(Storage::get($fileName), 200, $headers);
    }
}
