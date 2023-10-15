<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\UnitProdiModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;
    protected $unitprodiModel;
    protected $rolesModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->unitprodiModel = new UnitProdiModel();
    }

    public function index()
    {
        $users = $this->userModel->getUserDetails();
        $data = [
            'title' => 'User',
            'user' => $users
        ];

        return view('auth/user/index', $data);
    }

    public function create()
    {
        $units = $this->unitprodiModel->findAll();
        $data = [
            'title' => 'Tambah User',
            'unit' => $units,
            'validation' => \Config\Services::validation()
        ];
        return view('auth/user/create', $data);
    }

    public function save()
    {
        $validationRules = [
            'nik_nip' => [
                'rules' => 'required|is_unique[users.nik_nip]',
                'errors' => [
                    'required' => 'NIK/NIP Harus di isi!',
                    'is_unique' => 'NIK/NIP sudah ada',
                ]
            ],
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            // 'jabatan' => 'required',
            'verifikasi_password' => 'required|matches[password]',
            'unit_prodi_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Unit/Program Studi Harus di isi!',
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'User Role Harus di isi!',
                ]
            ],
            'image' => [
                'rules' => 'max_size[image,1024]|is_image[image]',
                'errors' => [
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimum 1MB.',
                    'is_image' => 'File harus berupa gambar (JPG, JPEG, PNG, GIF, atau BMP).',
                ]
            ],
            // 'image' => [
            //     'rules' => 'uploaded[image]|max_size[image,1024]|is_image[image]',
            //     'errors' => [
            //         'uploaded' => 'Gambar belum dipilih.',
            //         'max_size' => 'Ukuran gambar terlalu besar. Maksimum 1MB.',
            //         'is_image' => 'File harus berupa gambar (JPG, JPEG, PNG, GIF, atau BMP).',
            //     ]
            // ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Image upload handling
        $image = $this->request->getFile('image');
        if ($image->isValid() && !$image->hasMoved()) {
            // Generate random name
            $newImageName = $image->getRandomName();
            // Move the uploaded image to a public
            $image->move('assets/img/profile/', $newImageName);
        } else {
            // Handle the case where no valid image was uploaded or there was an error
            $newImageName = 'default.png';
        }
        $this->userModel->save([
            'nik_nip' => $this->request->getVar('nik_nip'),
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'jabatan' => $this->request->getVar('jabatan'),
            'unit_prodi_id' => $this->request->getVar('unit_prodi_id'),
            'role' => $this->request->getVar('role'),
            'image' => $newImageName,
        ]);

        session()->setFlashdata('pesan', 'Data User Berhasil ditambahkan!');

        return redirect()->to('/user');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        // dd($user);
        if (!$user) {
            return redirect()->to('/user')->with('error', 'User not found');
        }

        $units = $this->unitprodiModel->findAll();
        $data = [
            'title' => 'Edit Data User',
            'user' => $user,
            'unit' => $units,
            'validation' => \Config\Services::validation(),
        ];

        return view('auth/user/edit', $data);
    }

    public function update($id)
    {
        // Get the user data by ID
        $user = $this->userModel->find($id);

        if (!$user) {
            // User not found, handle the error or redirect back with a message
            return redirect()->back()->with('error', 'User not found.');
        }

        $validationRules = [
            'nik_nip' => [
                'rules' => "required|is_unique[users.nik_nip,id,$id]",
                'errors' => [
                    'required' => 'NIK/NIP Harus Diisi!',
                    'is_unique' => 'NIK/NIP sudah ada',
                ]
            ],
            'nama' => 'required',
            'email' => [
                'rules' => "required|valid_email",
                // 'rules' => "required|valid_email|is_unique[users.email,id,$id]",
                'errors' => [
                    'required' => 'Email Harus Diisi!',
                    'valid_email' => 'Format Email Tidak Valid!',
                    // 'is_unique' => 'Email sudah ada',
                ]
            ],
            'password' => 'permit_empty|min_length[6]',
            // 'jabatan' => 'required',
            'verifikasi_password' => 'permit_empty|matches[password]',
            'unit_prodi_id' => 'required',
            'role' => 'required',
            'new_image' => [
                'rules' => 'max_size[new_image,1024]|is_image[new_image]',
                'errors' => [

                    'max_size' => 'Ukuran gambar terlalu besar. Maksimum 1MB.',
                    'is_image' => 'File harus berupa gambar (JPG, JPEG, PNG, GIF, atau BMP).',
                ]
                // 'new_image' => [
                //     'rules' => 'uploaded[new_image]|max_size[new_image,1024]|is_image[new_image]',
                //     'errors' => [
                //         'uploaded' => 'Gambar belum dipilih.',
                //         'max_size' => 'Ukuran gambar terlalu besar. Maksimum 1MB.',
                //         'is_image' => 'File harus berupa gambar (JPG, JPEG, PNG, GIF, atau BMP).',
                //     ]
            ],
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Image upload handling for the new image
        $newImage = $this->request->getFile('new_image');
        if ($newImage->isValid() && !$newImage->hasMoved()) {
            // Generate random name for the new image
            $newImageName = $newImage->getRandomName();
            // Move the uploaded new image to the public directory
            $newImage->move('assets/img/profile', $newImageName);

            // Perbarui sesi gambar
            session()->set('image', $newImageName);
            // Delete the old image if it exists
            if (!empty($user['image'])) {
                $oldImagePath = 'assets/img/profile/' . $user['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image file from the server
                }
            }
        } else {
            // Keep the existing image path if no new image is uploaded
            $newImageName = $user['image'];

            // Delete the old image if the "delete_image" field is present
            if ($this->request->getPost('delete_image')) {
                $oldImagePath = 'assets/img/profile/' . $user['image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image file from the server
                }
                $newImageName = null; // Set new image name to null
            }
        }

        // Update the user data in the database
        $userData = [
            'nik_nip' => $this->request->getVar('nik_nip'),
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'jabatan' => $this->request->getVar('jabatan'),
            'unit_prodi_id' => $this->request->getVar('unit_prodi_id'),
            'role' => $this->request->getVar('role'),
            'image' => $newImageName,
        ];

        // Only update password if a new one is provided
        if (!empty($this->request->getVar('password'))) {
            $userData['password'] = password_hash($this->request->getVar('password'), PASSWORD_BCRYPT);
        }

        $this->userModel->update($id, $userData);

        session()->setFlashdata('pesan', 'Data User Berhasil diupdate!');

        return redirect()->to('/user');
    }

    public function delete($id)
    {
        // Get the user data by ID
        $user = $this->userModel->find($id);

        if (!$user) {
            // User not found, handle the error or redirect back with a message
            return redirect()->back()->with('error', 'User not found.');
        }

        // Delete the user's photo if it exists
        if (!empty($user['image'])) {
            $imagePath = 'assets/img/' . $user['image'];
            if (file_exists($imagePath)) {
                unlink($imagePath); // Delete the image file from the server
            }
        }

        // Delete the user from the database
        $this->userModel->delete($id);

        session()->setFlashdata('pesan', 'Data User Berhasil dihapus!');

        return redirect()->to('/user');
    }
}
