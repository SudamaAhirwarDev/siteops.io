<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitorLogModel extends Model
{
    protected $table            = 'visitor_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'domain',
        'site_id',
        'page_url',
        'ip_address',
        'user_agent',
        'device_type',
        'referrer',
        'visited_at',
    ];

    protected $useTimestamps = false;

    /**
     * Get aggregate statistics per domain (Total hits, unique visitors, last visit)
     */
    public function getDomainStats(): array
    {
        return $this->select('domain, COUNT(id) as total_hits, COUNT(DISTINCT ip_address) as unique_ips, MAX(visited_at) as last_seen')
                    ->groupBy('domain')
                    ->orderBy('total_hits', 'DESC')
                    ->findAll();
    }

    /**
     * Get recent visit logs with optional domain filter
     */
    public function getRecentVisits(int $limit = 50, ?string $domainFilter = null, ?string $search = null): array
    {
        $builder = $this->orderBy('id', 'DESC');

        if (!empty($domainFilter)) {
            $builder->where('domain', trim($domainFilter));
        }

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('domain', $search)
                    ->orLike('page_url', $search)
                    ->orLike('ip_address', $search)
                    ->orLike('referrer', $search)
                    ->groupEnd();
        }

        return $builder->findAll($limit);
    }

    /**
     * Summary stats for quick admin overview
     */
    public function getSummary(): array
    {
        $today = date('Y-m-d');
        
        $totalVisits = $this->countAllResults();
        
        $rowUnique = $this->select('COUNT(DISTINCT ip_address) as unique_count')->first();
        $uniqueVisitors = (int) ($rowUnique['unique_count'] ?? 0);

        $todayVisits = $this->where('visited_at >=', "{$today} 00:00:00")->countAllResults();

        // Device breakdown
        $devices = $this->select('device_type, COUNT(id) as count')
                        ->groupBy('device_type')
                        ->findAll();

        return [
            'total_visits'    => $totalVisits,
            'unique_visitors' => $uniqueVisitors,
            'today_visits'    => $todayVisits,
            'devices'         => $devices,
        ];
    }
}
