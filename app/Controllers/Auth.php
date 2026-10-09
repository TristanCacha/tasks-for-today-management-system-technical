<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function setup(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (model(UserModel::class)->hasConfiguredAccount()) {
            return redirect()->to(site_url('login'));
        }

        return view('auth/setup', ['title' => 'Set up your account']);
    }

    public function createAccount(): \CodeIgniter\HTTP\RedirectResponse
    {
        $users = model(UserModel::class);
        if ($users->hasConfiguredAccount()) {
            return redirect()->to(site_url('login'));
        }

        $rules = [
            'full_name' => 'required|max_length[100]',
            'username'  => 'required|min_length[3]|max_length[50]|alpha_numeric_punct',
            'email'     => 'required|valid_email|max_length[100]',
            'password'  => 'required|min_length[8]|max_length[72]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->to(site_url('setup'))->withInput()->with('formErrors', $this->validator->getErrors());
        }

        $username = trim((string) $this->request->getPost('username'));
        $firstId  = $users->getFirstAccountId();
        $duplicate = $users->where('username', $username);
        if ($firstId !== null) {
            $duplicate->where('id !=', $firstId);
        }
        if ($duplicate->countAllResults() > 0) {
            return redirect()->to(site_url('setup'))->withInput()->with('formErrors', ['username' => 'That username is already in use.']);
        }

        $record = [
            'username'      => $username,
            'full_name'     => trim((string) $this->request->getPost('full_name')),
            'email'         => trim((string) $this->request->getPost('email')),
            'password_hash' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'          => 'owner',
        ];

        if ($firstId === null) {
            $record['created_at'] = date('Y-m-d H:i:s');
            $users->insert($record);
            $userId = (int) $users->getInsertID();
        } else {
            $users->update($firstId, $record);
            $userId = $firstId;
        }

        // Attach the existing assessment sample tasks to the initial account.
        db_connect()->table('tasks')->where('user_id', null)->update(['user_id' => $userId]);

        session()->regenerate(true);
        session()->set('userId', $userId);

        return redirect()->to(site_url('/'))->with('success', 'Your account is ready.');
    }

    public function login(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $users = model(UserModel::class);
        if (! $users->hasConfiguredAccount()) {
            return redirect()->to(site_url('setup'));
        }

        if (is_numeric(session()->get('userId'))) {
            return redirect()->to(site_url('/'));
        }

        return view('auth/login', ['title' => 'Sign in']);
    }

    public function authenticate(): \CodeIgniter\HTTP\RedirectResponse
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user     = model(UserModel::class)->getByUsername($username);

        if ($user === null || empty($user['password_hash']) || ! password_verify($password, $user['password_hash'])) {
            return redirect()->to(site_url('login'))->withInput()->with('authError', 'The username or password was not recognized.');
        }

        session()->regenerate(true);
        session()->set('userId', (int) $user['id']);

        return redirect()->to(site_url('/'));
    }

    public function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }
}
