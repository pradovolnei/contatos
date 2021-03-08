<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Base;
use App\User;

use Illuminate\Support\Facades\URL;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Agenda $agenda)
    {
		$this->agenda = $agenda;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		if(Auth::check() == true ){
			return $this->home();
		}else{
			return view('auth.login');
		}
    }
	
	public function home()
    {
		$lista_agenda = $this->agenda->listar();
        return view('home')->with( [ "lista_agenda" => $lista_agenda ] );
    }
	
	public function cadastrar(Request $request)
    {
		$this->agenda->insert([ "first_name" => $request->first_name, "last_name" => $request->last_name, "email" => $request->email, "phone" => $request->phone, "id_usuario" =>  Auth::user()->id  ]);
        return $this->home();
    }
	
	public function atualizar(Request $request)
    {
		$this->agenda->where("id_usuario",  Auth::user()->id )->update([ "first_name" => $request->first_name, "last_name" => $request->last_name, "email" => $request->email, "phone" => $request->phone ]);
        return $this->home();
    }
	
	public function deletar()
    {
		$this->agenda->where("id",  $_GET["u"] )->delete();
        return $this->home();
    }
	
	
}
