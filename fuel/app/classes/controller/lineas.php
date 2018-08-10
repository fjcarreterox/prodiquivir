<?php
class Controller_Lineas extends Controller_Template
{

	public function action_index() //TODO: capar
	{
		$data['lineas'] = Model_Linea::find('all');
		$this->template->title = "Lineas de la factura";
		$this->template->content = View::forge('lineas/index', $data);

	}

	public function action_view($id = null) //TODO: capar
	{
		is_null($id) and Response::redirect('lineas');

		if ( ! $data['linea'] = Model_Linea::find($id))
		{
			Session::set_flash('error', 'Could not find linea #'.$id);
			Response::redirect('lineas');
		}

		$this->template->title = "Linea";
		$this->template->content = View::forge('lineas/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
            $linea = Model_Linea::forge(array(
                'idfactura' => Input::post('idfactura'),
                'orden' => Input::post('orden'),
                'concepto' => Input::post('concepto'),
                'precio' => Input::post('precio'),
                'kg' => Input::post('kg'),
                'importe' => Input::post('precio')*Input::post('kg'),
            ));

            if ($linea and $linea->save())
            {
                $data["id"] = $linea->id;
                $data["message"] = "TODO OK.";
            }
            else{
                $data["id"] = $linea->id;
                $data["message"] = "ERROR.";
            }
            $content_type = array('Content-type'=>'application/json');
            return new \Response(json_encode($data),200,$content_type);
		}
	}

	public function action_edit($id = null)
	{
		if(is_null($id)){
          $id = $_POST['id'];
        }

        $linea = Model_Linea::find($id);
		if ($linea){
			$linea->concepto = Input::post('concepto');
			$linea->precio = Input::post('precio');
			$linea->kg = Input::post('kg');
			$linea->importe = Input::post('importe');

			if ($linea->save()){
                $data["id"] = $id;
                $data["message"] = "TODO OK.";
			}
			else{
                $data["id"] = $id;
                $data["message"] = "ERROR.";
            }

            $content_type = array('Content-type'=>'application/json');
            return new \Response(json_encode($data),200,$content_type);
		}
	}

	public function action_delete($id = null)
	{
		if(is_null($id)) $id = $_POST['id'];

		if ($linea = Model_Linea::find($id)){
			$linea->delete();

            $data["id"] = $id;
            $data["message"] = "TODO OK.";
		}
        else{
            $data["id"] = $id;
            $data["message"] = "ERROR.";
		}
        $content_type = array('Content-type'=>'application/json');
        return new \Response(json_encode($data),200,$content_type);
	}
}
