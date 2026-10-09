<?php

namespace App\Filters;

use App\Models\UserModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $users = model(UserModel::class);

        if (! $users->hasConfiguredAccount()) {
            return redirect()->to(site_url('setup'));
        }

        $userId = session()->get('userId');
        if (! is_numeric($userId) || $users->getById((int) $userId) === null) {
            session()->remove('userId');

            return redirect()->to(site_url('login'));
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
