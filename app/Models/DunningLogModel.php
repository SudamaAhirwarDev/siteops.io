<?php

namespace App\Models;

use CodeIgniter\Model;

class DunningLogModel extends Model
{
    protected $table            = 'dunning_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'site_id',
        'customer_email',
        'amount',
        'currency',
        'status',
        'sent_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'sent_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get recent logs for a site
     *
     * @param int $siteId
     * @param int $limit
     * @return array
     */
    public function getSiteLogs(int $siteId, int $limit = 20): array
    {
        return $this->where('site_id', $siteId)
                    ->orderBy('id', 'DESC')
                    ->findAll($limit);
    }

    /**
     * Get aggregate recovery stats for a site
     *
     * @param int $siteId
     * @return array
     */
    public function getSiteStats(int $siteId): array
    {
        $db = \Config\Database::connect();
        
        $builder = $db->table($this->table)->where('site_id', $siteId);
        $totalLogs = $builder->countAllResults(false);

        $recovered = $db->table($this->table)
            ->selectSum('amount', 'total_recovered')
            ->where('site_id', $siteId)
            ->where('status', 'recovered')
            ->get()->getRowArray()['total_recovered'] ?? 0;

        $pending = $db->table($this->table)
            ->selectSum('amount', 'total_pending')
            ->where('site_id', $siteId)
            ->where('status', 'pending')
            ->get()->getRowArray()['total_pending'] ?? 0;

        return [
            'total_logs'      => $totalLogs,
            'total_recovered' => floatval($recovered),
            'total_pending'   => floatval($pending),
        ];
    }
}
