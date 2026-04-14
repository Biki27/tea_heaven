<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if the user is logged in
        if (!session()->get('is_logged_in')) {
            // Store the intended URL so we can redirect them back after they log in
            session()->set('redirect_url', current_url());
            
            return redirect()->to('/login')->with('error', 'Please sign in to continue.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // We don't need anything here for auth
    }
}