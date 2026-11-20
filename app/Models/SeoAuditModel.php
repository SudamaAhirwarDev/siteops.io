<?php

namespace App\Models;

use CodeIgniter\Model;

class SeoAuditModel extends Model
{
    protected $table            = 'seo_audits';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'site_id',
        'page_url',
        'seo_score',
        'geo_ai_score',
        'recommendations_json',
        'audited_at',
    ];

    protected $useTimestamps = false;

    /**
     * Get recent audits for a site
     *
     * @param int $siteId
     * @param int $limit
     * @return array
     */
    public function getSiteAudits(int $siteId, int $limit = 10): array
    {
        return $this->where('site_id', $siteId)
                    ->orderBy('id', 'DESC')
                    ->findAll($limit);
    }
}
