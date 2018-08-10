<?php
class Controller_Variedad extends Controller_Template
{

	public function action_index()
	{
		$data['variedads'] = Model_Variedad::find('all');
		$this->template->title = "Variedads";
		$this->template->content = View::forge('variedad/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('variedad');

		if ( ! $data['variedad'] = Model_Variedad::find($id))
		{
			Session::set_flash('error', 'Could not find variedad #'.$id);
			Response::redirect('variedad');
		}

		$this->template->title = "Variedad";
		$this->template->content = View::forge('variedad/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Variedad::validate('create');

			if ($val->run())
			{
				$variedad = Model_Variedad::forge(array(
					'nombre' => Input::post('nombre'),
					'en_anticipo' => Input::post('en_anticipo'),
				));

				if ($variedad and $variedad->save())
				{
					Session::set_flash('success', 'Added variedad #'.$variedad->id.'.');

					Response::redirect('variedad');
				}

				else
				{
					Session::set_flash('error', 'Could not save variedad.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Variedads";
		$this->template->content = View::forge('variedad/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('variedad');

		if ( ! $variedad = Model_Variedad::find($id))
		{
			Session::set_flash('error', 'Could not find variedad #'.$id);
			Response::redirect('variedad');
		}

		$val = Model_Variedad::validate('edit');

		if ($val->run())
		{
			$variedad->nombre = Input::post('nombre');
			$variedad->en_anticipo = Input::post('en_anticipo');

			if ($variedad->save())
			{
				Session::set_flash('success', 'Updated variedad #' . $id);

				Response::redirect('variedad');
			}

			else
			{
				Session::set_flash('error', 'Could not update variedad #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$variedad->nombre = $val->validated('nombre');
				$variedad->en_anticipo = $val->validated('en_anticipo');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('variedad', $variedad, false);
		}

		$this->template->title = "Variedads";
		$this->template->content = View::forge('variedad/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('variedad');

		if ($variedad = Model_Variedad::find($id))
		{
			$variedad->delete();

			Session::set_flash('success', 'Deleted variedad #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete variedad #'.$id);
		}

		Response::redirect('variedad');

	}

}
