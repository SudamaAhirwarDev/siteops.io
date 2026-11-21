<?php

namespace App\Models;

use CodeIgniter\Model;

class QueryLogModel extends Model
{
    protected $table            = 'query_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'query_type',
        'target_domain',
        'ip_address',
        'status',
        'score_seo',
        'score_security',
        'details_json',
        'queried_at',
    ];

    protected $useTimestamps = false;

    /**
     * Get recent queries with optional search
     */
    public function getRecentQueries(int $limit = 50, ?string $search = null): array
    {
        $builder = $this->orderBy('id', 'DESC');

        if (!empty($search)) {
            $builder->groupStart()
                    ->like('target_domain', $search)
                    ->orLike('query_type', $search)
                    ->orLike('ip_address', $search)
                    ->groupEnd();
        }

        return $builder->findAll($limit);
    }

    /**
     * Summary stats for queries
     */
    public function getSummary(): array
    {
        $today = date('Y-m-d');
        $totalQueries = $this->countAllResults();
        $todayQueries = $this->where('queried_at >=', "{$today} 00:00:00")->countAllResults();

        $topQueried = $this->select('target_domain, COUNT(id) as count, AVG(score_seo) as avg_seo, AVG(score_security) as avg_sec')
                           ->groupBy('target_domain')
                           ->orderBy('count', 'DESC')
                           ->findAll(10);

        return [
            'total_queries' => $totalQueries,
            'today_queries' => $todayQueries,
            'top_queried'   => $topQueried,
        ];
    }
}
