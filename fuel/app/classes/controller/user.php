<?php
class Controller_User extends Controller_Template
{

	public function action_index()
	{
		$data['users'] = Model_User::find('all');
        $data['puestos'] = Model_Puesto::find('all');
		$this->template->title = "Usuarios";
		$this->template->content = View::forge('user/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('user');

		if ( ! $data['user'] = Model_User::find($id))
		{
			Session::set_flash('error', 'Could not find user #'.$id);
			Response::redirect('user');
		}

		$this->template->title = "Ver detalle de usuario";
		$this->template->content = View::forge('user/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{

			$val = Model_User::validate('create');

			if ($val->run())
			{
				$user = Model_User::forge(array(
					'username' => Input::post('username'),
					'pass' => md5(Input::post('pass')),
                    'idpuesto' => Input::post('idpuesto')
				));

				if ($user and $user->save())
				{
					Session::set_flash('success', 'Usuario añadido.');
					Response::redirect('user');
				}

				else
				{
					Session::set_flash('error', 'No se pudo crear el nuevo usuario.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Usuarios";
		$this->template->content = View::forge('user/create');
	}

    public function action_new_pass($id = null)
    {
        is_null($id) and Response::redirect('user');

        if ( ! $user = Model_User::find($id))        {
            Session::set_flash('error', 'No se ha podido encontrar el usuario especificado.');
            Response::redirect('user');
        }

        $val = Model_User::validate_new_pass('edit');

        if ($val->run()){
            $user->pass = md5(Input::post('pass'));
            if ($user->save()){
                Session::set_flash('success', 'La nueva contraseña ha sido actualizada correctamente');
                Response::redirect('user');
            }
            else{
                Session::set_flash('error', 'Ocurrió un error al actualizar la contraseña');
            }
        }
        else{
            if (Input::method() == 'POST'){
                $user->pass = $val->validated('pass');
                Session::set_flash('error', $val->error());
            }
            $this->template->set_global('user', $user, false);
        }
        $this->template->title = "Usuarios";
        $this->template->content = View::forge('user/_form_pass');
    }

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('user');

		if ( ! $user = Model_User::find($id))
		{
			Session::set_flash('error', 'Could not find user #'.$id);
			Response::redirect('user');
		}

		$val = Model_User::validate('edit');

		if ($val->run())
		{
			$user->username = Input::post('username');
            $user->idpuesto = Input::post('idpuesto');

			if ($user->save()){
				Session::set_flash('success', 'Usuario actualizado correctamente');
				Response::redirect('user');
			}
			else{
				Session::set_flash('error', 'Could not update user #' . $id);
			}
		}
		else{
			if (Input::method() == 'POST'){
				$user->username = $val->validated('username');
				//$user->pass = $val->validated('pass');
                $user->idpuesto = $val->validated('idpuesto');
				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('user', $user, false);
		}
		$this->template->title = "Usuarios";
		$this->template->content = View::forge('user/edit');
	}

	public function action_delete($id = null){
		is_null($id) and Response::redirect('user');

		if ($user = Model_User::find($id)){
			$user->delete();
			Session::set_flash('success', 'Usuario borrado del sistema');
		}
		else{
			Session::set_flash('error', 'No se ha podido borrar el usuario solicitado.');
		}
		Response::redirect('user');
	}
}
