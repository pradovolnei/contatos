<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Base;
use Auth;

class Agenda extends Base
{
    protected $table = "agenda";
	
	public function listar()
    {
		$exibir = self::select();
		$exibir->where("id_usuario", Auth::user()->id);
		
		if(isset($_GET["nome"]) && $_GET["nome"])
			$exibir->where(function ($query) {
				$query->whereRaw("first_name LIKE '%".$_GET["nome"]."%'")
				  ->orWhereRaw("first_name LIKE '%".$_GET["nome"]."%'");
			});
		
		return $exibir->get ();
    }

	
}