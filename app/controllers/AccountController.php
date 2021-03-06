<?php

use ArabiaIOClone\Repositories\UserRepositoryInterface;


/**
 * Description of AccountController
 *
 * @author Hichem MHAMED
 */
class AccountController extends BaseController
{
    protected $users;
    
    public function __construct(UserRepositoryInterface $users)
    {
        

        $this->users = $users;
    }
    
    public function getLogout()
    {
        Auth::logout();
        return Redirect::route('default');
    }
    
    public function getLogin()
    {
        return View::make('account.login');
    }
    
    public function postLogin()
    {
        $loginForm = $this->users->getLoginForm();
        
        // 1. validator fails
        if (!$loginForm->isValid())
        {
            return  Redirect::route('account-login')
                ->withErrors($loginForm->getErrors());
        }
        
        
        $credentials = Input::only([ 'username', 'password' ]);
        //$remember = Input::get('remember', false);
        $remember = true;

        if (str_contains($credentials['username'], '@')) 
        {
            $credentials['email'] = $credentials['username'];
            unset($credentials['username']);
        }else
        {
            $userByUsername = $this->users->findByUsername($credentials['username']);
            if($userByUsername)
            {
                $credentials['email'] = $userByUsername->email;
            }else
            {
                return Redirect::route('account-login')
                        ->withInput()
                        ->withErrors(Lang::get('errors.login_wrong_credentials'));
            }
        }
        
        $attempt = Auth::attempt(array(
            'email' => $credentials['email'],
            'password' => $credentials['password'],
            'active' => 1));
        
        if ($attempt) 
        {
            return Redirect::intended(route('default'));
        }
        
        return Redirect::route('account-login')
                    ->withInput()
                    ->withErrors(Lang::get('errors.login_wrong_credentials'));

        
    }


}

?>
