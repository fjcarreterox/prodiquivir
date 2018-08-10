<?php
class Controller_Puesto extends Controller_Template
{

	public function action_index()
	{
		$data['puestos'] = Model_Puesto::find('all');
		$this->template->title = "Puestos";
		$this->template->content = View::forge('puesto/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('puesto');

		if ( ! $data['puesto'] = Model_Puesto::find($id))
		{
			Session::set_flash('error', 'Could not find puesto #'.$id);
			Response::redirect('puesto');
		}

		$this->template->title = "Puesto";
		$this->template->content = View::forge('puesto/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Puesto::validate('create');

			if ($val->run())
			{
				$puesto = Model_Puesto::forge(array(
					'nombre' => Input::post('nombre'),
				));

				if ($puesto and $puesto->save())
				{
					Session::set_flash('success', 'Added puesto #'.$puesto->id.'.');

					Response::redirect('puesto');
				}

				else
				{
					Session::set_flash('error', 'Could not save puesto.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Puestos";
		$this->template->content = View::forge('puesto/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('puesto');

		if ( ! $puesto = Model_Puesto::find($id))
		{
			Session::set_flash('error', 'Could not find puesto #'.$id);
			Response::redirect('puesto');
		}

		$val = Model_Puesto::validate('edit');

		if ($val->run())
		{
			$puesto->nombre = Input::post('nombre');

			if ($puesto->save())
			{
				Session::set_flash('success', 'Updated puesto #' . $id);

				Response::redirect('puesto');
			}

			else
			{
				Session::set_flash('error', 'Could not update puesto #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$puesto->nombre = $val->validated('nombre');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('puesto', $puesto, false);
		}

		$this->template->title = "Puestos";
		$this->template->content = View::forge('puesto/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('puesto');

		if ($puesto = Model_Puesto::find($id))
		{
			$puesto->delete();

			Session::set_flash('success', 'Deleted puesto #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete puesto #'.$id);
		}

		Response::redirect('puesto');

	}

}
