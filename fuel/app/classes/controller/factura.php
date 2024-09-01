<?php
class Controller_Factura extends Controller_Template{

	public function action_index(){
		$data['facturas'] = Model_Factura::find('all');
		$this->template->title = "Facturas";
		$this->template->content = View::forge('factura/index', $data);
	}

	public function action_year($year){
         $facturas = Model_Factura::find('all',array('order_by' => array('num_factura' => 'asc')));
         $data["facturas"] = array();
         foreach($facturas as $f){
             if(strpos($f->fecha,$year) !== false){
                 $data["facturas"][] = $f;
             }
         }
         $data['year'] = $year;
         $data['titulo'] = ": campaña $year.";
         $this->template->title = "Facturas de la campaña $year";
         $this->template->content = View::forge('factura/year', $data);
   	}
	
    public function action_init()
    {
        $this->template->title = "Selección de proveedor";
        $this->template->content = View::forge('factura/init');
    }

    public function action_list()
    {
        $data['facturas'] = Model_Factura::find('all',array('where'=>array(array('fecha','>','2023-12-31')),'order_by' => array('num_factura' => 'desc')));
        $data['titulo'] = "";
        $this->template->title = "Facturas registradas en el sistema";
        $this->template->content = View::forge('factura/list', $data);
    }

    public function action_report($year = null){
         if($year == null){ //if not defined, it's the current year
             $year = date('Y');
         }
 
        $data['facturas'] = Model_Factura::find('all',array('where'=>array(array('fecha','like',$year.'-%')),'order_by' => array('num_factura' => 'desc')));
        $this->template->title = "Informe de IVA y retenciones en facturas";
        $this->template->content = View::forge('factura/report', $data);
    }
	
	public function action_full($year = null){
        if($year == null){ //if not defined, it's the current year
            $year = date('Y');
        }

        $facts = array();
        $proveedores = Model_Proveedor::find('all',array('order_by' => array('nombre' => 'asc')));
        foreach($proveedores as $p) {
            $facturas = Model_Factura::find('all', array('where' => array('idprov' => $p->id,array('fecha','like',$year.'-%'))));
            if(count($facturas)>0) {
                $total_ret = 0;
                $iva_array = array("4"=>array("base"=>0,"comp"=>0,"suma"=>0),
                    "10"=>array("base"=>0,"comp"=>0,"suma"=>0),
                    "12"=>array("base"=>0,"comp"=>0,"suma"=>0)
                );

                foreach($facturas as $f){

                    $lineas = Model_Linea::find('all',array('where'=>array("idfactura"=>$f->get('id'))));
                    $base = 0;$iva = 0;$comp = 0;$suma = 0;
                    foreach($lineas as $l){
                        $base += $l->get('importe');
                    }

                    $iva = $f->get('iva');
                    $iva_array[$iva]["base"] += $base;
                    $comp = number_format(($base*$f->get('iva'))/100,2,'.','');
                    $iva_array[$iva]["comp"] += $comp;
                    $suma = $base+number_format(($base*$f->get('iva'))/100,2,'.','');
                    $iva_array[$iva]["suma"] += $suma;

                    if($f->get('retencion')==2){
                        $ret = number_format(($suma*$f->get('retencion'))/100,2,'.','');
                        $total_ret += $ret;
                        //$total_ret += number_format(($base+number_format(($base*$f->get('iva'))/100,2)*$f->get('retencion'))/100,2,'.','');

                    }
                    //echo "Prov: ".$p->id.", Base: $base, IVA: $iva, Comp: $comp, suma: $suma, retencion: $ret <br/>";
                    if(isset($facts[$p->id])) {
                        $facts[$p->id]["base"] += $base;
                        $facts[$p->id]["comp"] += $comp;
                        $facts[$p->id]["suma"] += $suma;
                        $facts[$p->id]["retencion"] += $ret;
                    }
                    else{
                        $facts[$p->id] = array("base" => $base, "iva" => $iva, "comp" => $comp, "suma" => $suma, "retencion" => $ret);
                    }
                }
            }
        }
        $data['facturas'] = $facts;

        $this->template->title = "Informe de IVA y retenciones en facturas por proveedor";
        $this->template->content = View::forge('factura/full', $data);
    }

	public function action_gestoria($year = null){
         if($year == null){
             $year = date('Y');
 	     }
        $facts = array();
        $facturas = Model_Factura::find('all',array('where'=>array(array('fecha','like',$year.'-%')),'order_by' => array('id' => 'asc')));
        $data['titulo'] = "";
        foreach($facturas as $f) {
            $lineas = Model_Linea::find('all', array('where' => array("idfactura" => $f->get('id'))));
            $base = 0;
            foreach ($lineas as $l) {
                $base += $l->get('importe');
            }
            $comp = number_format(($base * $f->get('iva')) / 100, 2, '.', '');
            $suma = $base + number_format(($base * $f->get('iva')) / 100, 2, '.', '');
            if ($f->get('retencion') == 2) {
                $ret = number_format(($suma * $f->get('retencion')) / 100, 2, '.', '');
             }
            $facts[$f->id] = array("num"=>$f->num_factura,"prov"=>$f->idprov ,"base"=> $base, "comp"=> $comp, "suma" => $suma, "retencion" => $ret);
        }
        $data['facturas'] = $facts;
        $this->template->title = "Listado de facturas para gestoría";
        $this->template->content = View::forge('factura/gestoria', $data);
    }
	
    public function action_report_fechas(){
        $data["facturas"] = array();
        if (Input::method() == 'POST'){
            $start = Input::post('start');
            $end = Input::post('end');

            $data["facturas"] = Model_Factura::find('all',array('where' => array(array('fecha', '>=', $start),array('fecha', '<=', $end))),array('order_by' => array('num_factura' => 'desc')));

            $this->template->title = "Informe de IVA y retenciones en facturas";
            $this->template->content = View::forge('factura/report', $data);
        }
        //$data['facturas'] = Model_Factura::find('all',array('order_by' => array('num_factura' => 'desc')));
        $this->template->title = "Selección de fechas para la consulta";
        $this->template->content = View::forge('factura/fechas',$data);
    }
	
	public function action_sel_year($idprov){
     	is_null($idprov) and Response::redirect('factura/list');
     	$data["idprov"] = $idprov;
     	$data["prov_name"] = Model_Proveedor::find($idprov)->get('nombre');
     	$this->template->title = "Selecciona el año a consultar";
     	$this->template->content = View::forge('factura/sel_year',$data);
   	}

    public function action_list_prov($idprov = null, $year = null){
        is_null($idprov) and Response::redirect('factura/list');
		
		is_null($year) and Response::redirect('factura/sel_year/'.$idprov);

        if ( !Model_Proveedor::find($idprov)) {
            Session::set_flash('error', 'No se ha podido encontrar el proveedor indicado');
            Response::redirect('factura/list');
        }else{
            $data['facturas'] = Model_Factura::find('all', array(
                'where' => array(
                    array('idprov', $idprov),
					array('fecha', 'LIKE', $year.'%')
                ),
                'order_by' => array('fecha' => 'desc'),
            ));

            $data['titulo'] = "para el proveedor: " . Model_Proveedor::find($idprov)->get('nombre');
        }
        $this->template->title = "Facturas emitidas para el proveedor";
        $this->template->content = View::forge('factura/list', $data);
    }

    public function action_print($idfactura)
    {
        is_null($idfactura) and Response::redirect('factura/list');

        if ( ! $factura = Model_Factura::find($idfactura))
        {
            Session::set_flash('error', 'No se ha podido encontrar en el sistema la factura núm. '.$idfactura);
            Response::redirect('factura/list');
        }

        if (Input::method() == 'POST')
        {
            $factura->num_factura = Input::post('num_factura');
            $factura->fecha = Input::post('fecha');
            $factura->total = Input::post('total_factura');
            $factura->iva = Input::post('iva');
            $factura->retencion = Input::post('retencion');
            $factura->cuota = Input::post('cuota');
            $factura->comentario = Input::post('comentario');

            if ($factura->save())
            {
                Session::set_flash('success', 'Factura núm. ' . $factura->num_factura . ' almacenada correctamente.');
                Response::redirect('factura/print/'.$idfactura);
            }
            else{
                Session::set_flash('error', 'No se ha podido almacenar la factura núm. ' . $factura->num_factura);
            }

        }else {
            $data['factura'] = $factura;
            $data['lineas'] = Model_Linea::find('all',array('where'=>array('idfactura'=>$idfactura),'order_by'=>'orden'));
            $this->template->title = "Sistema automático de facturación de PRODIQUIVIR S.L.U.";
            $this->template->content = View::forge('factura/print', $data);
        }
    }

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('factura');

		if ( ! $data['factura'] = Model_Factura::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar la factura deseada.');
			Response::redirect('factura');
		}

		$this->template->title = "Factura";
		$this->template->content = View::forge('factura/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Factura::validate('create');
			if ($val->run()){
				$factura = Model_Factura::forge(array(
					'num_factura' => Input::post('num_factura'),
					'idprov' => Input::post('idprov'),
					'fecha' => Input::post('fecha'),
					'total' => Input::post('total'),
					'cuota' => Input::post('cuota'),
					'iva' => Input::post('iva'),
					'retencion' => Input::post('retencion'),
                    'comentario' => Input::post('comentario'),
				));

				if ($factura and $factura->save()){
					Session::set_flash('success', 'Factura núm. '.$factura->num_factura.' registrada en el sistema.');
					Response::redirect('factura/print/'.$factura->id);
				}
				else{
					Session::set_flash('error', 'No se ha podido guardar la factura.');
				}
			}
			else{
				Session::set_flash('error', $val->error());
			}
		}
		
        $newyear=false;
        if(!$newyear) {
            $fmax= Model_Factura::max('id');
            $data['num_fact'] = Model_Factura::find($fmax)->get('num_factura');
        }else{
            $data['num_fact'] = 0;
            $newyear=false;
        }

		$this->template->title = "Emisión de facturas";
		$this->template->content = View::forge('factura/create',$data);
	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('factura');

		if ( ! $factura = Model_Factura::find($id))
		{
			Session::set_flash('error', 'No se ha podido encontrar la factura núm.'.$id);
			Response::redirect('factura');
		}

		$val = Model_Factura::validate('edit');

		if ($val->run()){
			$factura->num_factura = Input::post('num_factura');
			$factura->idprov = Input::post('idprov');
			$factura->fecha = Input::post('fecha');
			$factura->total = Input::post('total');
			$factura->cuota = Input::post('cuota');
			$factura->iva = Input::post('iva');
			$factura->retencion = Input::post('retencion');
            $factura->comentario = Input::post('comentario');

			if ($factura->save()){
				Session::set_flash('success', 'Factura núm. ' . $factura->num_factura . ' actualizada correctamente.');
				Response::redirect('factura/print/'.$id);
			}
			else{
				Session::set_flash('error', 'No se ha podido actualizar la factura núm. ' . $factura->num_factura);
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$factura->num_factura = $val->validated('num_factura');
				$factura->idprov = $val->validated('idprov');
				$factura->fecha = $val->validated('fecha');
				$factura->total = $val->validated('total');
				$factura->cuota = $val->validated('cuota');
				$factura->iva = $val->validated('iva');
				$factura->retencion = $val->validated('retencion');
                $factura->comentario = $val->validated('comentario');
				Session::set_flash('error', $val->error());
			}
			$this->template->set_global('factura', $factura, false);
		}
		$this->template->title = "Facturas";
		$this->template->content = View::forge('factura/edit');
	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('factura');

		if ($factura = Model_Factura::find($id)){
			$factura->delete();
			Session::set_flash('success', 'Factura núm. '.$factura->num_factura . ' borrada del sistema.');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar la factura núm. '.$factura->num_factura);
		}
		Response::redirect('factura/list');
	}
}
