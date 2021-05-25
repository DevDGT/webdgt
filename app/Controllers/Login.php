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

            if (!$validate['success']) throw new \Exception("Error Processing Request");

            $message = [
                'status' => 'fail'
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
