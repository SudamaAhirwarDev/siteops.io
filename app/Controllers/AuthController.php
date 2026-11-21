<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

/**
 * Class AuthController
 * 
 * Handles registration, authentication, sessions, and logout
 * with secure password_hash(), CSRF validation, and clean UX.
 */
class AuthController extends Controller
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    /**
     * Show the Login page
     */
    public function getLogin()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to(site_url('dashboard'));
        }

        return view('auth/login', [
            'page_title' => 'Sign In — SiteOps',
        ]);
    }

    /**
     * Process Login authentication
     */
    public function postLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $email    = strtolower(trim($this->request->getPost('email')));
        $password = $this->request->getPost('password');

        $user = $this->userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid email address or password. Please try again.');
        }

        // Establish authenticated session with current plan status
        session()->set([
            'user_id'       => (int) $user['id'],
            'user_name'     => $user['name'],
            'user_email'    => $user['email'],
            'plan_type'     => $user['plan_type'],
            'trial_ends_at' => $user['trial_ends_at'] ?? null,
            'is_logged_in'  => true,
        ]);

        return redirect()->to(site_url('dashboard'))
            ->with('success', 'Welcome back, ' . esc($user['name']) . '!');
    }

    /**
     * Show the Registration page
     */
    public function getRegister()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to(site_url('dashboard'));
        }

        return view('auth/register', [
            'page_title' => 'Start Free — SiteOps',
        ]);
    }

    /**
     * Process user registration
     */
    public function postRegister()
    {
        $rules = [
            'name'             => 'required|min_length[2]|max_length[100]',
            'email'            => 'required|valid_email|is_unique[users.email]',
            'password'         => 'required|min_length[6]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $name     = trim($this->request->getPost('name'));
        $email    = strtolower(trim($this->request->getPost('email')));
        $password = $this->request->getPost('password');

        $trialEnd = date('Y-m-d H:i:s', strtotime('+15 days'));

        $userId = $this->userModel->insert([
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_BCRYPT),
            'plan_type'     => 'trial',
            'trial_ends_at' => $trialEnd,
        ]);

        if (!$userId) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create your account. Please try again.');
        }

        // Auto-provision initial site and snippet for instant execution
        try {
            $siteModel = new \App\Models\SiteModel();
            $reviewModel = new \App\Models\ReviewModel();
            $siteKey = 'so_' . substr(md5(uniqid((string)$userId, true)), 0, 12);
            $siteId = $siteModel->insert([
                'user_id'              => (int) $userId,
                'domain'               => 'mysite.com',
                'site_key'             => $siteKey,
                'module_accessibility' => 1,
                'module_reviews'       => 1,
                'module_seo'           => 1,
                'module_dunning'       => 0,
            ]);
            if ($siteId) {
                $reviewModel->insert([
                    'site_id'         => $siteId,
                    'reviewer_name'   => 'Alex Morgan',
                    'role_or_company' => 'Product Lead',
                    'rating'          => 5,
                    'review_text'     => 'SiteOps universal script integrated in under 60 seconds with zero lag.',
                    'source'          => 'google',
                    'is_active'       => 1,
                ]);
            }
        } catch (\Throwable $e) {
            // Non-blocking fallback
        }

        // Auto-login new user with 15-day trial
        session()->set([
            'user_id'       => (int) $userId,
            'user_name'     => $name,
            'user_email'    => $email,
            'plan_type'     => 'trial',
            'trial_ends_at' => $trialEnd,
            'is_logged_in'  => true,
        ]);

        return redirect()->to(site_url('dashboard'))
            ->with('success', 'Account created! Your 15-day free trial (5 tasks/day) is active.');
    }

    /**
     * Terminate user session and log out
     */
    public function getLogout()
    {
        session()->destroy();
        return redirect()->to(site_url('login'))
            ->with('success', 'You have been logged out securely.');
    }
}
