<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Profile extends BaseController
{
    function __construct()
    {
        $this->table = "users";
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = [
            'title' => 'Profile',
            'menu' => 'profile',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'users' => '',
                session('name') . ':active' => '',
            ]
        ];
        return View('admin/users/vProfile', $data);
    }

    public function update()
    {
        try {

            $validate = Validate([
                'username' => 'required|min:5|max:20|username',
                'name' => 'required|min:2|name',
                'email' => 'required|email',
                'quotes' => 'required'
            ]);

            if (!$validate['success']) throw new \Exception("gagal memproses data");

            session()->set([
                'username' => Input_('username'),
                'name' => Input_('name'),
                'email' => Input_('email'),
            ]);

            $updatePhoto = false;
            if ($_FILES['photo']['size'] > 0) {
                // mengambil nama file photo
                $oldPhoto = $this->db->table($this->table)->select('photo')->where(['id' => session('userId')])->get()->getRow()->photo;

                // jika phptp ada maka hapus filenya
                if ($oldPhoto != "")
                    unlink(ROOTPATH . 'public/uploads/users/' . $oldPhoto);

                // upload photo baru
                $updatePhoto = $this->uploadPhoto();
            }

            if (!Update($this->table, $validate['data'], ['id' => session('userId')]) && !$updatePhoto) throw new \Exception("Tidak ada perubahan");

            $result = [
                'status' => 'ok',
                'message' => "Berhasil merubah pengaturan"
            ];
        } catch (\Throwable $th) {
            $result = [
                'status' => 'fail',
                'message' => $th->getMessage()
            ];
        } catch (\Exception $ex) {
            $result = [
                'status' => 'fail',
                'message' => $ex->getMessage()
            ];
        } finally {
            $result = array_merge($result, ['validate' => $validate]);
            echo json_encode($result);
        }
    }

    private function uploadPhoto()
    {
        try {

            $validated = $this->validate([
                'photo' => [
                    'rules' => 'uploaded[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]|max_size[photo,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'Format File Harus Berupa jpg, jpeg, gif, png',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ]
            ]);

            if ($validated == false) throw new \Exception($this->validator->listErrors());
            $file = $this->request->getFile('photo');
            $fileName = time() . "_" . $file->getName();
            session()->set('photo', $fileName);
            $path = ROOTPATH . 'public/uploads/users/';
            $file->move($path, $fileName);
            $result = Update($this->table, ['photo' => $fileName], ['id' => session('userId')]);;
        } catch (\Throwable $th) {
            $result = [
                "uploaded" => 0,
                "error" => ['message' => preg_replace('!\s+!', ' ', strip_tags($th->getMessage()))]
            ];
        } catch (\Exception $ex) {
            $result = [
                "uploaded" => 0,
                "error" => ['message' => preg_replace('!\s+!', ' ', strip_tags($ex->getMessage()))]
            ];
        } finally {
            return $result;
        }
    }
}
