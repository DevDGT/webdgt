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
        // echo __DIR__ . "<br>";
        // echo FILESDIR;
        // Print_(FILESDIR, false, false);
        // exit();
        $data = [
            'title' => 'Profile',
            'menu' => 'profile',
            'roti' => [
                'Home:blank' => base_url(),
                'Dashboard' => base_url(ADMIN_PATH . '/dashboard'),
                'Profile' => '',
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
                'name' => 'required|min:2|max:50|name',
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
                if ($oldPhoto != "") {
                    // $path = ROOTPATH . 'public/uploads/users/' . $oldPhoto;
                    $path = FILESDIR . '/uploads/users/' . $oldPhoto;
                    if (file_exists($path)) unlink($path);
                }
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
            // $path = ROOTPATH . 'public/uploads/users/';
            $path = FILESDIR . '/uploads/users/';
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

    public function setPassword()
    {
        try {
            //code...

            $validate = Validate([
                'password' => 'required|password',
                'passwordLama' => 'required',
                'passwordConfirm' => 'required|sameAs:password',
            ], [
                'passwordLama' => 'false',
                'passwordConfirm' => 'false',
            ]);

            $user = $this->db->table($this->table)->where(['id' => session('userId'), 'password' => Enc(Input_('passwordLama'))])->get()->getRow();

            if (!$user) $validate = ValidateAdd($validate, 'passwordLama', "Password lama salah !");

            if (!$validate['success']) throw new \Exception("gagal memproses data");

            if (!Update($this->table, ['password' => Enc(Input_('password'))], ['id' => session('userId')])) throw new \Exception("Gagal merubah password");

            $result = [
                'status' => 'ok',
                'message' => 'Berhasil merubah password'
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

    public function socialsStore()
    {
        try {

            $validate = Validate([
                "social" => "required",
                "link" => "required"
            ], [
                'user_id' => session('userId')
            ]);

            $socials = $this->db->table('social')->where(['user_id' => session('userId'), 'social' => Input_('social')])->get()->getRow();

            if ($socials) $validate = ValidateAdd($validate, "social", "Media sosial sudah ada");

            if (!$validate['success']) throw new \Exception("gagal memproses data");

            if (!Create("social", $validate['data'])) throw new \Exception("Gagal memasukan data !");

            $result = [
                'status' => 'ok',
                'message' => 'Menambahkan data'
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

    public function socialsDelete()
    {
        try {

            if (!isset($_POST['id'])) throw new \Exception("no param");

            $id = Input_('id');

            if (Delete("social", [EncKey('id') => $id]) == false) throw new \Exception("Gagal menghapus data");

            $result = [
                'status' => 'ok',
                'message' => 'Berhasil menghapus data'
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
            echo json_encode($result);
        }
    }

    public function socialsUpdate()
    {
        try {

            $validate = Validate([
                'social' => 'required',
                'link' => 'required'
            ], [
                'user_id' => session('userId')
            ]);

            $social = $this->db->table('social')->where(['user_id' => session('userId'), 'social' => Input_('social')])->get()->getRow();
            if ($social && Enc($social->id) != Input_('id')) $validate = ValidateAdd($validate, 'social', "Media social sudah ada");
            if (!$validate['success']) throw new \Exception("Error Processing Request");
            if (!Update("social", $validate['data'], [EncKey('id') => Input_('id')])) throw new \Exception("Tidak ada perubahan");

            $result = [
                'status' => 'ok',
                'message' => 'Berhasih mengubah data'
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
            $result = array_merge($result, ['validate' => $validate, 'modalClose' => true]);
            echo json_encode($result);
        }
    }

    public function getWeb()
    {
        try {

            $web = $this->db->table('web')->where(['user_id' => session('userId')])->get()->getRowArray();
            if (!$web) throw new \Exception("data tidak ditemukan");

            $result = [
                'status' => 'ok',
                'data' => Guard($web, ['user_id:hash'])
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
            echo json_encode($result);
        }
    }

    public function saveWeb()
    {
        try {

            $data = [
                'html' => Input_('html', false),
                'css' => Input_('css', false),
                'js' => Input_('js', false),
            ];

            // Print_($data);

            if (!Update('web', $data, ['user_id' => session('userId')])) throw new \Exception("Tidak ada perubahan");
            // echo $this->db->getLastQuery();

            $result = [
                'status' => 'ok',
                'message' => 'Berhasil menyimpan perubahan'
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
            echo json_encode($result);
        }
    }

    public function previewWeb()
    {
        echo "<style>" . $_REQUEST['css'] . "</style>";
        echo $_REQUEST['html'];
        echo "<script>" . $_REQUEST['js'] . "</script>";
    }
}
