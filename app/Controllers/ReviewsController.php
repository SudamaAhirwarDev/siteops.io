<?php

namespace App\Controllers;

use App\Models\SiteModel;
use App\Models\ReviewModel;
use CodeIgniter\Controller;

/**
 * Class ReviewsController
 * 
 * Manages social proof, customer reviews, rating aggregations,
 * and visibility toggles for the client review popup.
 */
class ReviewsController extends Controller
{
    protected SiteModel $siteModel;
    protected ReviewModel $reviewModel;

    public function __construct()
    {
        $this->siteModel   = new SiteModel();
        $this->reviewModel = new ReviewModel();
        helper(['form', 'url']);
    }

    /**
     * Display reviews management panel
     */
    public function index($siteId = null)
    {
        $userId = (int) session()->get('user_id');
        $sites  = $this->siteModel->getUserSites($userId);

        if (empty($sites)) {
            return redirect()->to(site_url('dashboard'))
                ->with('error', 'Please add a website before managing reviews.');
        }

        // Selected site
        $selectedSite = null;
        if ($siteId !== null) {
            $selectedSite = $this->siteModel->getSiteForUser((int) $siteId, $userId);
        }
        if (!$selectedSite) {
            $selectedSite = $sites[0];
        }

        $reviews = $this->reviewModel->getSiteReviews((int) $selectedSite['id']);
        $trialStatus = (new \App\Services\UsageService())->getTrialStatus($userId);

        return view('modules/reviews', [
            'page_title'    => 'Reviews Manager — SiteOps',
            'sites'         => $sites,
            'selected_site' => $selectedSite,
            'reviews'       => $reviews,
            'trial_status'  => $trialStatus,
        ]);
    }

    /**
     * Store new customer review
     */
    public function create($siteId)
    {
        $userId = (int) session()->get('user_id');
        $site   = $this->siteModel->getSiteForUser((int) $siteId, $userId);

        if (!$site) {
            return redirect()->to(site_url('modules/reviews'))
                ->with('error', 'Unauthorized site access.');
        }

        // Trial & Daily Task Limit Guard Check
        $usageService = new \App\Services\UsageService();
        $usageCheck = $usageService->canExecuteTask($userId, 'review_sync', true);
        if (!$usageCheck['allowed']) {
            return redirect()->back()
                ->withInput()
                ->with('error', $usageCheck['message']);
        }

        $rules = [
            'reviewer_name'   => 'required|min_length[2]|max_length[100]',
            'role_or_company' => 'permit_empty|max_length[100]',
            'rating'          => 'required|in_list[1,2,3,4,5]',
            'review_text'     => 'required|min_length[5]|max_length[1500]',
            'source'          => 'required|in_list[google,trustpilot,custom]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->reviewModel->insert([
            'site_id'         => (int) $site['id'],
            'reviewer_name'   => trim($this->request->getPost('reviewer_name')),
            'role_or_company' => trim($this->request->getPost('role_or_company')),
            'rating'          => (int) $this->request->getPost('rating'),
            'review_text'     => trim($this->request->getPost('review_text')),
            'source'          => $this->request->getPost('source'),
            'is_active'       => 1,
        ]);

        return redirect()->to(site_url('modules/reviews/' . $site['id']))
            ->with('success', 'Customer review added successfully! It is now active in your widget.');
    }

    /**
     * Toggle visibility of a review
     */
    public function toggle($reviewId)
    {
        $userId = (int) session()->get('user_id');
        $review = $this->reviewModel->find((int) $reviewId);

        if (!$review) {
            return redirect()->back()->with('error', 'Review not found.');
        }

        $site = $this->siteModel->getSiteForUser((int) $review['site_id'], $userId);
        if (!$site) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $newState = $review['is_active'] ? 0 : 1;
        $this->reviewModel->update($reviewId, ['is_active' => $newState]);

        return redirect()->to(site_url('modules/reviews/' . $site['id']))
            ->with('success', 'Review status updated to ' . ($newState ? 'Active' : 'Hidden') . '.');
    }

    /**
     * Delete review
     */
    public function delete($reviewId)
    {
        $userId = (int) session()->get('user_id');
        $review = $this->reviewModel->find((int) $reviewId);

        if (!$review) {
            return redirect()->back()->with('error', 'Review not found.');
        }

        $site = $this->siteModel->getSiteForUser((int) $review['site_id'], $userId);
        if (!$site) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $this->reviewModel->delete($reviewId);

        return redirect()->to(site_url('modules/reviews/' . $site['id']))
            ->with('success', 'Review deleted successfully.');
    }
}
