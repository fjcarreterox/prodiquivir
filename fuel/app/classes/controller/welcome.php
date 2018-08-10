<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.7
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2014 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller
{

	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{

        $user = Session::get('username');
        if ( $user == "" ){
            return Response::redirect('welcome/login');
        }
        else{
            if(\Fuel\Core\Session::get('ses_anticipo_prov')!==null){
                \Fuel\Core\Session::delete('ses_anticipo_prov');
            }
            elseif(\Fuel\Core\Session::get('idfactura')!==null){
                \Fuel\Core\Session::delete('idfactura');
                \Fuel\Core\Session::delete('fecha');
                \Fuel\Core\Session::delete('idprov');
                \Fuel\Core\Session::delete('comment');
            }
            return Response::forge(View::forge('welcome/index'));
        }
	}

    public function action_guide()
    {
        $user = Session::get('username');
        if ( $user == "" ){
            return Response::redirect('welcome/login');
        }
        else{
            return Response::forge(View::forge('welcome/guide'));
        }
    }

    public function action_login()
    {
        if (Input::method() == 'POST'){
            $user=Model_User::find('first', array('where' => array( array('username',Input::post('username')))));
            if($user!=NULL){
                $pass=$user->get('pass');
                $puesto=$user->get('idpuesto');
                if(strcmp(md5(Input::post('pass')),$pass)==0){
                    Session::create();
                    Session::set('username',Input::post('username'));
                    Session::set('userid',Input::post('username').'_'.time());
                    Session::set('puesto',$puesto);
                    return Response::redirect('/');
                }
                else{
                    Session::set_flash('error', 'Error en el acceso');
                    Response::redirect('welcome/login');
                }
            }
            else{
                //User not found
                return Response::forge(View::forge('welcome/login'));
            }
        }
        else{
            //Not a submit process
            return Response::forge(View::forge('welcome/login'));
        }

    }

    public function action_logout(){
        Session::delete('username');
        Session::destroy();
        return Response::redirect('welcome/login');
    }

	/**
	 * A typical "Hello, Bob!" type example.  This uses a Presenter to
	 * show how to use them.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_hello()
	{
		return Response::forge(Presenter::forge('welcome/hello'));
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(Presenter::forge('welcome/404'), 404);
	}
}
