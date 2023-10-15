<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (session('user_id')) {
            return redirect()->to('/dashboard');
        }
        $data = [
            'title' => 'Halaman Login',
        ];
        return view('auth/login', $data);
    }

    public function profile()
    {
        // Pastikan user sudah login sebelum mengakses halaman profil
        if (!session('user_id')) {
            return redirect()->to('/login');
        }

        $user_id = session('user_id');
        $user = $this->userModel->getDataByUserId($user_id);

        $data = [
            'title' => 'Profil Pengguna',
            'user' => $user,
        ];

        return view('auth/user/profile', $data); // Gantilah 'auth/profile' sesuai dengan nama view yang Anda gunakan untuk tampilan profil.
    }

    public function updateProfile()
    {
        // Pastikan user sudah login sebelum mengakses halaman ini
        if (!session('user_id')) {
            return redirect()->to('/login');
        }

        $user_id = session('user_id');
        $user = $this->userModel->getDataByUserId($user_id);

        $validation =  \Config\Services::validation();
        // Set validation rules sesuai dengan kebutuhan Anda
        $validation->setRules([
            'nama' => 'required',
            'email' => 'required|valid_email',
            // 'jabatan' => '', // Anda dapat menambahkan validasi jabatan jika diperlukan
            'new_image' => 'max_size[new_image,1024]|ext_in[new_image,jpg,jpeg,png,gif]', // Validasi gambar
            'password' => 'permit_empty|matches[verifikasi_password]',
        ]);

        // Validasi data yang diinput oleh user
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Mengelola gambar profil jika ada yang diunggah
        $newImage = $this->request->getFile('new_image');
        if ($newImage->isValid() && !$newImage->hasMoved()) { // Periksa apakah file valid sebelum mengelolanya
            // Hapus gambar lama jika diperlukan
            if ($user['image']) {
                $oldImagePath = 'assets/img/profile/' . $user['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image file from the server
                }
            }

            // Simpan gambar yang diunggah
            $newImageName = $newImage->getRandomName();
            $newImage->move('assets/img/profile', $newImageName);
            $user['image'] = $newImageName;
        }

        // Perbarui data nama, jabatan, dan email
        $user['nama'] = $this->request->getPost('nama');
        $user['email'] = $this->request->getPost('email');
        // $user['jabatan'] = $this->request->getPost('jabatan'); // Jika Anda ingin memperbarui jabatan

        // Mengelola perubahan password jika ada yang diinput
        if (!empty($this->request->getVar('password'))) {
            $user['password'] = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
        }

        // Simpan perubahan ke database
        $this->userModel->save($user);
        // Perbarui sesi 
        $userData = [
            'user_id' => $user['id'],
            'nik_nip' => $user['nik_nip'],
            'nama' => $user['nama'],
            'email' => $user['email'],
            'password' => $user['password'],
            'jabatan' => $user['jabatan'],
            'image' => $user['image'],
        ];
        session()->set($userData);
        return redirect()->to('user-profile')->with('success', 'Profil berhasil diperbarui.');
    }




    public function login()
    {
        $validation =  \Config\Services::validation();
        // Set validation rules
        $validation->setRules([
            'nik_nip' => 'required',
            'password' => 'required',
        ]);

        // validation
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $nik_nip = $this->request->getPost('nik_nip');
        $password = $this->request->getVar('password');

        $user = $this->userModel->getUserByNikNip($nik_nip);
        if ($user && password_verify($password, $user['password'])) {

            $userData = [
                'user_id' => $user['id'],
                'nik_nip' => $user['nik_nip'],
                'nama' => $user['nama'],
                'email' => $user['email'],
                'password' => $user['password'],
                'jabatan' => $user['jabatan'],
                'unit_prodi_id' => $user['nama_unit_prodi'],
                'role' => $user['role'],
                'image' => $user['image'],
            ];
            session()->set($userData);
            // dd($userData);
            return redirect()->to('/');
        } else {
            return redirect()->back()->withInput()->with('error', 'NIK/NIP atau password salah.');
        }
    }

    public function logout()
    {
        // Clear all session data
        session()->destroy();

        // Redirect to the login page
        return redirect()->to('/login');
    }
}
