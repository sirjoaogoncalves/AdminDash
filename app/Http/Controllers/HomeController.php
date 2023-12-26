<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      $todos = Todo::all();

        $mostUsedServices = DB::table('cliente_service')
   ->select('services.name', DB::raw('COUNT(*) as service_count'))
   ->groupBy('cliente_service.service_id', 'services.name')
   ->orderByDesc('service_count')
   ->leftJoin('services', 'cliente_service.service_id', '=', 'services.id')
   ->limit(5)
   ->get();

        $mostClients = DB::table('cliente_service')
   ->select('clientes.name', DB::raw('COUNT(*) as client_count'))
   ->groupBy('cliente_service.cliente_id', 'clientes.name')
   ->orderByDesc('client_count')
   ->leftJoin('clientes', 'cliente_service.cliente_id', '=', 'clientes.id')
   ->limit(5)
   ->get();

        return view('home', compact('todos', 'mostUsedServices', 'mostClients'));
    }
}
