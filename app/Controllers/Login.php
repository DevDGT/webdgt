<?php

namespace App\Controllers;

use App\Models\LoginModel;

class Login extends BaseController
{

    function __construct()
    {
        $this->auth = new loginModel;
    }

    public function index()
    {
        return view('login', [
            'title' => "Login"
        ]);
    }

    public function action()
    {
        try {

            $validate = Validate([
                "username" => "required|min:5|username",
                "password" => "required"
            ], [
                "password" => Enc(Input_("password"))
            ]);

            // cek apakah Validator success atau tidak
            if (!$validate['success']) throw new \Exception("Error Processing Request");

            // cek apakah user ada atau tidak
            $user = $this->auth->getLogin($validate['data']);
            if ($user->countAllResults() == 0) throw new \Exception("Username atau password salah !");

            // cek apakah user aktif atau tidak
            $userData = $user->get()->getRow();
            if ($userData->active == 0) throw new \Exception("Akun tidak aktif, tidak dapat melanjutkan");

            $session = [
                'username' => $userData->username,
                'name' => $userData->name,
                'email' => $userData->email,
                'level' => $userData->level,
                'token' => Enc(SALT . time() . $userData->username . $userData->password)
            ];

            session()->set($session);

            $message = [
                'status' => 'ok',
                'message' => "Selamat datang $userData->name"
            ];
        } catch (\Throwable $th) {
            $message = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $message = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            $message = array_merge($message, ['validate' => $validate]);
            echo json_encode($message);
        }
    }
}
