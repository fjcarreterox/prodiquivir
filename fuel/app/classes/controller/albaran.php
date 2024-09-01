<?php
class Controller_Albaran extends Controller_Template{
	public function action_index(){
		$data['albarans'] = Model_Albaran::find('all');
		$this->template->title = "Albarans";
		$this->template->content = View::forge('albaran/index', $data);
	}

    public function action_list($year = null){
        if($year == null){
            $year = date('Y');
        }
		$albaranes = Model_Albaran::find('all', array("where" => array(array('fecha','LIKE',$year.'%')),"order_by"=>array('idalbaran'=>'desc')));
        /*$albaranes = array();
        $res=DB::select('idalbaran','fecha')->from('albarans')->distinct()->order_by('idalbaran','desc')->execute();
        foreach($res as $r) {
            if (strpos($r["fecha"],$year) !== false) {
                $albaranes[] = Model_Albaran::find('first', array("where" => array("idalbaran" => $r["idalbaran"])));
            }
        }*/
        $data['albarans'] = $albaranes;
        $data['titulo'] = "";
        $this->template->title = "Albaranes hasta la fecha";
        $this->template->content = View::forge('albaran/list', $data);
    }

    public function action_year($year){
        $albaranes = Model_Albaran::find('all',array('order_by'=>'id'));
        $data["albarans"] = array();
        foreach($albaranes as $a){
            //if(strpos($a->fecha,$year) !== false){
			if(strpos(date('Y',$a->created_at),$year) !== false){
                $data["albarans"][] = $a;
            }
        }
        $data['year'] = $year;
        $data['titulo'] = "durante la campaña $year.";
        $this->template->title = "Albaranes de la campaña $year";
        $this->template->content = View::forge('albaran/list', $data);
    }

    public function action_print($idalb = null, $year = null){
        is_null($idalb) and Response::redirect('albaran');

		if(is_null($year)){ $year = date('Y',time());}
		
        if (!$albaranes = Model_Albaran::find('all',array("where" => array("idalbaran"=>$idalb,array("fecha",'LIKE',$year.'%'))))) {
            Session::set_flash('error', 'No se ha encontrado el albarán núm. ' . $idalb);
            Response::redirect('albaran/list');
        }
        $entregas=array();

        foreach($albaranes as $a){
            	$entregas[]=$a->get('identrega');
        }

        $data['entregas']=$entregas;
        $data['albaranes']=$albaranes;

        $this->template->title = "Albarán Núm. ".$idalb;
        $this->template->content = View::forge('albaran/print', $data);
    }

	public function action_view($idalbaran = null, $year = null){
		is_null($idalbaran) and Response::redirect('albaran');

		if(is_null($year)){ $year = date('Y',time());}
		
		if ( ! $albaranes = Model_Albaran::find('all',array("where" => array("idalbaran"=>$idalbaran,array("fecha",'LIKE',$year.'%'))))){
			Session::set_flash('error', 'No se ha encontrado el albarán núm. '.$idalbaran);
			Response::redirect('albaran/list');
		}
        $entregas=array();         

        foreach($albaranes as $a){
			$entregas[]=$a->get('identrega');
        }

        $data['entregas']=$entregas;
        $data['albaranes']=$albaranes;

		$this->template->title = "Detalle de Albarán";
		$this->template->content = View::forge('albaran/view', $data);
	}

	public function action_create(){
		if (Input::method() == 'POST'){
			$val = Model_Albaran::validate('create');

			if ($val->run()){
				$albaran = Model_Albaran::forge(array(
					'idalbaran' => Input::post('idalbaran'),
					'identrega' => Input::post('identrega'),
					'idproveedor' => Input::post('idproveedor'),
					'fecha' => Input::post('fecha'),
                    'comentario' => Input::post('comentario'),
				));

				if ($albaran and $albaran->save()){
					Session::set_flash('success', 'Albaran Núm.'.$albaran->id.' creado correctamente.');
					Response::redirect('albaran/list');
				}
				else{
					Session::set_flash('error', 'No se pudo almacenar el albarán.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Albaranes";
		$this->template->content = View::forge('albaran/create');
	}

	public function action_edit($id = null){
		is_null($id) and Response::redirect('albaran/list');

		if ( ! $albaran = Model_Albaran::find($id)){
			Session::set_flash('error', 'No existe en el sistema el albarán núm. '.$id);
			Response::redirect('albaran/list');
		}

		$val = Model_Albaran::validate('edit');

		if ($val->run()){
			$albaran->idalbaran = Input::post('idalbaran');
			$albaran->identrega = Input::post('identrega');
			$albaran->idproveedor = Input::post('idproveedor');
			$albaran->fecha = Input::post('fecha');
            $albaran->comentario = Input::post('comentario');

			if ($albaran->save()){
                $res1 = DB::update('albarans')
                    ->value("comentario", Input::post('comentario'))
                    ->where('idalbaran', '=',Input::post('idalbaran') )
					->and_where('fecha','LIKE', '2024%')
                    ->execute();

				$res2 = DB::update('albarans')
					->value("fecha", Input::post('fecha'))
					->where('idalbaran', '=',Input::post('idalbaran') )
					->and_where('fecha','LIKE', '2024%')
					->execute();

				Session::set_flash('success', 'Albarán núm. ' . $albaran->idalbaran .' actualizado.');
				Response::redirect('albaran/list');
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar el albarán núm. ' . $albaran->idalbaran);
			}
		}
		else{
			if (Input::method() == 'POST'){
				$albaran->idalbaran = $val->validated('idalbaran');
				$albaran->identrega = $val->validated('identrega');
				$albaran->idproveedor = $val->validated('idproveedor');
				$albaran->fecha = $val->validated('fecha');
                $albaran->comentario = $val->validated('comentario');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('albaran', $albaran, false);
		}

		$this->template->title = "Editando datos del Albarán";
		$this->template->content = View::forge('albaran/edit');
	}

	public function action_edit_prov($idalb = null, $idprov){
		is_null($idalb) and Response::redirect('albaran/list');

		$albaranes = Model_Albaran::find('all',array('where'=>array('idalbaran'=>$idalb,array('fecha','LIKE','2024%'))));

		if (empty($albaranes)){
			Session::set_flash('error', 'No existe en el sistema el albarán núm. '.$idalb);
			Response::redirect('albaran/list');
		}

		$val = Model_Albaran::validate('edit');

		if ($val->run()){
			foreach($albaranes as $alb) {
				$alb->idproveedor = Input::post('provider');
				if ($alb->save()) {
					Session::set_flash('success', 'Albarán núm. ' . $alb->idalbaran . ' actualizado.');
				} else {
					Session::set_flash('error', 'No se ha podido actualizar el albarán núm. ' . $alb->id);
				}
			}
			Response::redirect('albaran/view/'.$idalb);
		}
		$data["proveedores"] = Model_Proveedor::find('all',array('order_by'=>'nombre'));
		$data["current"] = $idprov;
		$data["idalb"] = $idalb;

		$this->template->title = "Cambiar proveedor para el Albarán";
		$this->template->content = View::forge('albaran/edit_prov',$data);
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('albaran/list');

		if ($albaran = Model_Albaran::find($id)){
            $related = Model_Albaran::find('all',array('where'=>array('idalbaran'=>$albaran->idalbaran,array('fecha','LIKE','2024%'))));
            foreach($related as $a) {
                $entrega = Model_Entrega::find('first', array('where' => array('albaran' => $a->id)));
                //echo "Borramos la entrega ".$entrega->id;
                $entrega->delete();
                //echo "Borramos el albaran ".$a->id;
                $a->delete();
            }
			Session::set_flash('success', 'Albarán núm. '.$albaran->idalbaran. ' borrado.');
		}
		else{
			Session::set_flash('error', 'No se pudo borrar el albarán núm. '.$albaran->idalbaran);
		}
		Response::redirect('albaran/list');
	}
}
