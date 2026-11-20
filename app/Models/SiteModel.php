<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteModel extends Model
{
    protected $table            = 'sites';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'domain',
        'site_key',
        'module_accessibility',
        'module_reviews',
        'module_seo',
        'module_dunning',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Generate a cryptographically secure, unique 16-character site key token
     *
     * @return string e.g. "so_9f81a7b2e4c6"
     */
    public function generateUniqueSiteKey(): string
    {
        do {
            // "so_" (3 chars) + 13 hex characters = 16 characters total
            $key = 'so_' . substr(bin2hex(random_bytes(7)), 0, 13);
            $exists = $this->where('site_key', $key)->first();
        } while ($exists !== null);

        return $key;
    }

    /**
     * Fetch all sites belonging to a user
     *
     * @param int $userId
     * @return array
     */
    public function getUserSites(int $userId): array
    {
        return $this->where('user_id', $userId)
                    ->orderBy('id', 'DESC')
                    ->findAll();
    }

    /**
     * Verify and fetch a site owned by a user
     *
     * @param int $siteId
     * @param int $userId
     * @return array|null
     */
    public function getSiteForUser(int $siteId, int $userId): ?array
    {
        return $this->where('id', $siteId)
                    ->where('user_id', $userId)
                    ->first();
    }
}
