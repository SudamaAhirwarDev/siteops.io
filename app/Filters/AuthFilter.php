<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Class AuthFilter
 * 
 * Protects authenticated dashboard routes.
 */
class AuthFilter implements FilterInterface
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
        if (!$session->get('is_logged_in')) {
            $session->setFlashdata('error', 'Please log in to access your SiteOps dashboard.');
            return redirect()->to(site_url('login'));
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
