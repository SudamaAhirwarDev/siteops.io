<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'site_id',
        'reviewer_name',
        'role_or_company',
        'rating',
        'review_text',
        'source',
        'is_active',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get all reviews for a specific site
     *
     * @param int $siteId
     * @return array
     */
    public function getSiteReviews(int $siteId): array
    {
        return $this->where('site_id', $siteId)
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }

    /**
     * Get active reviews for client embed widget
     *
     * @param int $siteId
     * @return array
     */
    public function getActiveSiteReviews(int $siteId): array
    {
        return $this->where('site_id', $siteId)
                    ->where('is_active', 1)
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }
}
