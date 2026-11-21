<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class AdminFilter
 * 
 * Enforces admin authorization for all /admin routes.
 * Non-admin users or unauthenticated visitors are redirected to /admin/login.
 */
class AdminFilter implements FilterInterface
{
    /**
     * Inspect session before handling request.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return ResponseInterface|null
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // Check if user is logged in and possesses admin privilege
        $isAdmin = (bool) $session->get('is_admin');
        $userRole = (string) ($session->get('user_role') ?? '');

        if (!$isAdmin && $userRole !== 'admin') {
            $session->setFlashdata('error', 'Administrator access required. Please sign in with admin credentials.');
            return redirect()->to(site_url('admin/login'));
        }

        return null;
    }

    /**
     * Nothing to do after request.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed
    }
}
