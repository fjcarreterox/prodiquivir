<?php
class Controller_Entrega extends Controller_Template
{
    public function action_index(){
        //$data['proveedores'] = Model_Proveedor::find('all',array('order_by' => 'nombre'));
        $q = Model_Albaran::query()->select('idalbaran')->order_by('idalbaran');
        $data['idAlbaran']=$q->max('idalbaran');
        $this->template->title = "Registrar nueva entrega";
        $this->template->content = View::forge('entrega/index', $data);
    }

    public function action_init(){
        $data['proveedores'] = Model_Proveedor::find('all',array('order_by' => 'nombre'));
        $this->template->title = "Ficha final de proveedor";
        $this->template->content = View::forge('entrega/init',$data);
    }

    public function action_report(){
        $variedades = array(1,2,3);
        $data = array();
        $total_kilos = 0;
        $total_var = array();

        $total = DB::select('total')->from('entregas')->execute();
        foreach ($total as $t) {
            $total_kilos += $t['total'];
        }

        foreach($variedades as $k => $v) {
            $total = DB::select('total')->from('entregas')->where('variedad', $v)->execute();
            $total_var[$v] = 0;
            foreach($total as $t){
                $total_var[$v] += $t['total'];
            }
        }

        $data['total'] = $total_kilos;
        $data['var'] = $total_var;

        $this->template->title = "Informe global de la campaña 2021";
        $this->template->content = View::forge('entrega/report',$data);
    }

    public function action_historico($year=null){
        $user = Session::get('username');
        if ( $user == "" ){
            return Response::redirect('welcome/login');
        }
        else{
            if($year!=null){
                $data['year'] = $year;
                $this->template->title = "Datos históricos de la campaña ".$year;
                $this->template->content = View::forge('entrega/historico',$data);
            }else{
                $this->template->title = "Datos históricos de campañas anteriores";
                $this->template->content = View::forge('entrega/historico');
            }
        }
    }

    public function action_fechas($idpuesto){
        is_null($idpuesto) and Response::redirect('entrega/list');

        if ( !Model_Puesto::find($idpuesto)) {
            Session::set_flash('error', 'No se ha podido encontrar el puesto de entrega indicado');
            Response::redirect('entrega/list');
        }else{
            $data["idpuesto"] = $idpuesto;
            $data["entregas"] = array();
            if (Input::method() == 'POST'){
                $start = Input::post('start');
                $end = Input::post('end');
                $data["entregas"] = Model_Entrega::find('all',array('where' => array('idpuesto' => $idpuesto,array('fecha','>=',$start),array('fecha','<=',$end)),'order_by'=>array('fecha','albaran')));
                //$data["entregas"] = Model_Entrega::find('all',array('where' => array(array('idpuesto', '=', $idpuesto),
                //array('Fecha', '>=', $start),array('Fecha', '<=', $end))),array('order_by' => array('Fecha' => 'desc')));
            }
            $this->template->title = "Entrega diaria en rango de fechas";
            $this->template->content = View::forge('entrega/fechas',$data);
        }
    }

    public function action_sel_year($idprov){
        is_null($idprov) and Response::redirect('entrega/list');
        $data["idprov"] = $idprov;
        $data["prov_name"] = Model_Proveedor::find($idprov)->get('nombre');
        $this->template->title = "Selecciona el año a consultar";
        $this->template->content = View::forge('entrega/sel_year',$data);
    }

    public function action_list_prov($idprov = null, $year = null){

        is_null($idprov) and Response::redirect('entrega/list');

        is_null($year) and Response::redirect('entrega/sel_year/'.$idprov);

        if ( !Model_Proveedor::find($idprov)) {
            Session::set_flash('error', 'No se ha podido encontrar el proveedor indicado');
            Response::redirect('entrega/list');
        }else{
            $albaranes = Model_Albaran::find('all',array('where'=>array('idproveedor'=>$idprov,array('fecha', 'LIKE', $year.'%')),'order_by'=>array('id'=>'asc')));
            $entregas = array();
            foreach($albaranes as $a){
                $entregas[] = Model_Entrega::find($a->identrega);
            }
            $data['anticipos'] = Model_Anticipo::find('all',array('where'=>array(array('recogido'=>'1'),array('idprov'=> $idprov),array('fecha', 'LIKE', $year.'%')),'order_by'=>array('fecha'=>'desc')));
            $data['entregas'] = $entregas;
            $data['nombre_prov'] = Model_Proveedor::find($idprov)->get('nombre');
            $data['tlfno'] = Model_Proveedor::find($idprov)->get('telefono');
            $data['idc'] = $idprov;
        }

        $this->template->title = "Ficha final de proveedor";
        $this->template->content = View::forge('entrega/list_prov',$data);
    }

    public function action_list($idpuesto = null){

        if(is_null($idpuesto)) {
            $data['titulo'] = "durante la campaña 2021.";
            $data['entregas'] = Model_Entrega::find('all', array('where'=>array(array('fecha','>','2020-12-31')),'order_by' => array('Fecha' => 'desc'),'order_by' => array('id' => 'desc')));
            $this->template->title = "Listado de todas las entregas realizadas";
        }
        else{
            $data['fecha']=date('Y-m-d');
            $nombre_puesto = Model_Puesto::find($idpuesto)->get('nombre');
            $data['idpuesto'] = $idpuesto;
            $data['puesto'] = $nombre_puesto;
            $data['entregas'] = Model_Entrega::find('all',array('where' => array(array('idpuesto', '=', $idpuesto), array('Fecha', '=', date('Y-m-d')))),array('order_by' => array('Fecha' => 'desc')));
            $this->template->title = "Entrega diaria para el puesto: ".$nombre_puesto;
        }
        $this->template->content = View::forge('entrega/list', $data);
    }

    public function action_year($year){
        $entregas = Model_Entrega::find('all',array('order_by'=>'id'));
        $data["entregas"] = array();
        foreach($entregas as $e){
            if(strpos($e->fecha,$year) !== false){
                $data["entregas"][] = $e;
            }
        }
        $data['year'] = $year;
        $data['titulo'] = "durante la campaña $year.";
        $this->template->title = "Entregas de la campaña $year";
        $this->template->content = View::forge('entrega/list', $data);
    }

    public function action_view($id = null){
        is_null($id) and Response::redirect('entrega');

        if ( ! $data['entrega'] = Model_Entrega::find($id))
        {
            Session::set_flash('error', 'Could not find entrega #'.$id);
            Response::redirect('entrega');
        }
        $this->template->title = "Detalle de Entrega";
        $this->template->content = View::forge('entrega/view', $data);
    }

    public function action_create(){
        if (Input::method() == 'POST'){
            $val = Model_Entrega::validate('create');

            if ($val->run()){
                $albs=Model_Albaran::find('all',array('where'=>array(array('fecha','LIKE','2021%')),'order_by'=>array('id'=>'desc','idalbaran'=>'desc')));

                if(count($albs)==0) {
                    $last_albaran_num = 0;
                }
                else {
                    $last_albaran_num = Model_Albaran::query()->where('fecha','LIKE','2021%')->max('idalbaran');
                }
                $last_albaran_all = Model_Albaran::find('last', array('order_by' => array('id'=>'desc')));
                $last_albaran_id = $last_albaran_all->get('id');

                $entrega = Model_Entrega::forge(array(
                    'fecha' => Input::post('fecha'),
                    'albaran' => $last_albaran_id+1,
                    'variedad' => Input::post('variedad'),
                    'tam' => Input::post('tam'),
                    'total' => Input::post('total'),
                    'envases' => Input::post('envases'),
                    'rate_picado' => Input::post('rate_picado'),
                    'rate_molestado' => Input::post('rate_molestado'),
                    'rate_morado' => Input::post('rate_morado'),
                    'rate_mosca' => Input::post('rate_mosca'),
                    'rate_azofairon' => Input::post('rate_azofairon'),
                    'rate_agostado' => Input::post('rate_agostado'),
                    'rate_granizado' => Input::post('rate_granizado'),
                    'rate_perdigon' => Input::post('rate_perdigon'),
                    'rate_taladro' => Input::post('rate_taladro'),
                    'idpuesto' => Input::post('idpuesto'),
                ));

                if ($entrega and $entrega->save()){
                    $current_albaran_num=$last_albaran_num+1;
                    if(\Fuel\Core\Session::get('num_alb')){
                        $current_albaran_num=\Fuel\Core\Session::get('num_alb');
                    }

                    $albaran = Model_Albaran::forge(array(
                        'id'=> $last_albaran_id+1,
                        'idalbaran' => $current_albaran_num,
                        'identrega' => $entrega->id,
                        'idproveedor' => Input::post('idprov'),
                        'fecha' => date('Y-m-d'),
                        'comentario' => "",
                    ));

                    if($albaran->save()){
                        Session::set_flash('success', 'Entrega añadida (núm. '.$entrega->id.'). Albarán añadido (núm. '.$albaran->idalbaran.').');
                    }
                    if(isset($_POST['more'])) {
                        \Fuel\Core\Session::set('idprov',Input::post('idprov'));
                        \Fuel\Core\Session::set('num_alb',$albaran->idalbaran);
                        Response::redirect('entrega/create');
                    }
                    else{
                        \Fuel\Core\Session::delete('idprov');
                        \Fuel\Core\Session::delete('num_alb');
                        Response::redirect('albaran/print/'.$albaran->idalbaran);
                    }
                }

                else{
                    Session::set_flash('error', 'No se pudo registrar la nueva entrega.');
                }
            }
            else{
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Registrar nueva entrega";
        $this->template->content = View::forge('entrega/create');

    }

    public function action_edit($id = null){
        is_null($id) and Response::redirect('entrega');

        if ( ! $entrega = Model_Entrega::find($id))
        {
            Session::set_flash('error', 'Could not find entrega #'.$id);
            Response::redirect('entrega');
        }

        $val = Model_Entrega::validate('edit');

        if ($val->run()){
            $entrega->fecha = Input::post('fecha');
            $entrega->albaran = Input::post('albaran');
            $entrega->variedad = Input::post('variedad');
            $entrega->tam = Input::post('tam');
            $entrega->total = Input::post('total');
            $entrega->envases = Input::post('envases');
            $entrega->rate_picado = Input::post('rate_picado');
            $entrega->rate_molestado = Input::post('rate_molestado');
            $entrega->rate_morado = Input::post('rate_morado');
            $entrega->rate_mosca = Input::post('rate_mosca');
            $entrega->rate_azofairon = Input::post('rate_azofairon');
            $entrega->rate_agostado = Input::post('rate_agostado');
            $entrega->rate_granizado = Input::post('rate_granizado');
            $entrega->rate_perdigon = Input::post('rate_perdigon');
            $entrega->rate_taladro = Input::post('rate_taladro');
            $entrega->idpuesto = Input::post('idpuesto');

            if ($entrega->save())
            {
                Session::set_flash('success', 'Datos de la entrega actualizados.');
                Response::redirect('entrega/list');
            }

            else
            {
                Session::set_flash('error', 'No se ha podido actualizar la entrega.');
            }
        }

        else
        {
            if (Input::method() == 'POST')
            {
                $entrega->fecha = $val->validated('fecha');
                $entrega->albaran = $val->validated('albaran');
                $entrega->variedad = $val->validated('variedad');
                $entrega->tam = $val->validated('tam');
                $entrega->total = $val->validated('total');
                $entrega->envases = $val->validated('envases');
                $entrega->rate_picado = $val->validated('rate_picado');
                $entrega->rate_molestado = $val->validated('rate_molestado');
                $entrega->rate_morado = $val->validated('rate_morado');
                $entrega->rate_mosca = $val->validated('rate_mosca');
                $entrega->rate_azofairon = $val->validated('rate_azofairon');
                $entrega->rate_agostado = $val->validated('rate_agostado');
                $entrega->rate_granizado = $val->validated('rate_granizado');
                $entrega->rate_perdigon = $val->validated('rate_perdigon');
                $entrega->rate_taladro = $val->validated('rate_taladro');
                $entrega->idpuesto = $val->validated('idpuesto');

                Session::set_flash('error', $val->error());
            }
            $this->template->set_global('entrega', $entrega, false);
        }

        $this->template->title = "Entregas";
        $this->template->content = View::forge('entrega/edit');
    }

    public function action_delete($id = null){
        is_null($id) and Response::redirect('entrega');
        if ($entrega = Model_Entrega::find($id)){
            //Deleting the associated line on Albaran model.
            $albaran = Model_Albaran::find($entrega->albaran);
            $entrega->delete();
            $albaran->delete();
            Session::set_flash('success', 'Entrega borrada y albarán asociado actualizado.');
        }else{
            Session::set_flash('error', 'No se ha podido borrar la entrega solicitada.');
        }
        Response::redirect('entrega/list');
    }
}