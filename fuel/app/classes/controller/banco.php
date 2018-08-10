<?php
class Controller_Banco extends Controller_Template
{

	public function action_index()
	{
		$data['bancos'] = Model_Banco::find('all');
		$this->template->title = "Bancos";
		$this->template->content = View::forge('banco/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('banco');

		if ( ! $data['banco'] = Model_Banco::find($id))
		{
			Session::set_flash('error', 'Could not find banco #'.$id);
			Response::redirect('banco');
		}

		$this->template->title = "Banco";
		$this->template->content = View::forge('banco/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Banco::validate('create');

			if ($val->run())
			{
				$banco = Model_Banco::forge(array(
					'nombre' => Input::post('nombre'),
				));

				if ($banco and $banco->save())
				{
					Session::set_flash('success', 'Añadiendo '.$banco->name.'.');

					Response::redirect('banco');
				}

				else
				{
					Session::set_flash('error', 'No pudo guardarse.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Bancos";
		$this->template->content = View::forge('banco/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('banco');

		if ( ! $banco = Model_Banco::find($id))
		{
			Session::set_flash('error', 'Could not find banco #'.$id);
			Response::redirect('banco');
		}

		$val = Model_Banco::validate('edit');

		if ($val->run())
		{
			$banco->nombre = Input::post('nombre');

			if ($banco->save())
			{
				Session::set_flash('success', 'Updated banco #' . $id);

				Response::redirect('banco');
			}

			else
			{
				Session::set_flash('error', 'Could not update banco #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$banco->nombre = $val->validated('nombre');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('banco', $banco, false);
		}

		$this->template->title = "Bancos";
		$this->template->content = View::forge('banco/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('banco');

		if ($banco = Model_Banco::find($id))
		{
			$banco->delete();

			Session::set_flash('success', 'Banco borrado: #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete banco #'.$id);
		}

		Response::redirect('banco');

	}

}
