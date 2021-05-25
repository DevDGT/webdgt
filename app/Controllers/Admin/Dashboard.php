<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        // echo "Dashboard";
        // echo Input_("nama", true);
        // echo DATE_NOW;
        // Create(
        //     "users",
        //     [
        //         'username' => "admin2",
        //         'password' => "Hello",
        //         "email"    => "hello@gmail.com",
        //         "name"     => "Hello"
        //     ]
        // );
        Print_(Create("users", [
            [
                'username' => "admin2",
                'password' => "Hello",
                "email"    => "hello@gmail.com",
                "name"     => "Hello"
            ],
            [
                'username' => "admin3",
                'password' => "Hello",
                "email"    => "hello@gmail.com",
                "name"     => "Hello"
            ]
        ]));
        // Print_(Where("users", [
        //     'username' => "admin"
        // ]));

        // Delete("users", ['username' => "admin"]);

        // Print_();
        // Update("users", [
        //     "username" => "Hello Edit",
        //     "password" => "Hello Edit"
        // ], [
        //     "id" => "5"
        // ]);
    }
}
