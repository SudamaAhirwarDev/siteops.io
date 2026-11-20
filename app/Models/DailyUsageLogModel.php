<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Class DailyUsageLogModel
 * 
 * Manages daily task quota tracking for 15-day free trial users (5 tasks/day).
 */
class DailyUsageLogModel extends Model
{
    protected $table            = 'daily_usage_logs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'task_type',
        'usage_date',
        'task_count',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get the count of tasks executed today by a user
     *
     * @param int $userId
     * @return int
     */
    public function getTodayCount(int $userId): int
    {
        $today = date('Y-m-d');
        $record = $this->where('user_id', $userId)
                       ->where('usage_date', $today)
                       ->first();

        return $record ? (int) $record['task_count'] : 0;
    }

    /**
     * Atomically increment the daily task usage count
     *
     * @param int $userId
     * @param string $taskType
     * @return int The updated task count
     */
    public function incrementUsage(int $userId, string $taskType = 'seo_audit'): int
    {
        $today = date('Y-m-d');
        $db = \Config\Database::connect();

        $sql = "INSERT INTO {$this->table} (user_id, task_type, usage_date, task_count, created_at, updated_at)
                VALUES (?, ?, ?, 1, NOW(), NOW())
                ON DUPLICATE KEY UPDATE 
                    task_count = task_count + 1,
                    task_type = VALUES(task_type),
                    updated_at = NOW()";

        $db->query($sql, [$userId, $taskType, $today]);

        return $this->getTodayCount($userId);
    }
}
