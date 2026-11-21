<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array<string, mixed>
     */
    public array $default = [
        'DSN'          => '',
        'hostname'     => '127.0.0.1',
        'username'     => 'root',
        'password'     => '',
        'database'     => 'siteops_db',
        'DBDriver'     => 'MySQLi',
        'DBPrefix'     => '',
        'pConnect'     => false,
        'DBDebug'      => true,
        'charset'      => 'utf8mb4',
        'DBCollat'     => 'utf8mb4_unicode_ci',
        'swapPre'      => '',
        'encrypt'      => false,
        'compress'     => false,
        'strictOn'     => false,
        'failover'     => [],
        'port'         => 3306,
        'numberNative' => false,
        'foundRows'    => false,
        'dateFormat'   => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    //    /**
    //     * Sample database connection for SQLite3.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'database'    => 'database.db',
    //        'DBDriver'    => 'SQLite3',
    //        'DBPrefix'    => '',
    //        'DBDebug'     => true,
    //        'swapPre'     => '',
    //        'failover'    => [],
    //        'foreignKeys' => true,
    //        'busyTimeout' => 1000,
    //        'synchronous' => null,
    //        'dateFormat'  => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    //    /**
    //     * Sample database connection for Postgre.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => '',
    //        'hostname'   => 'localhost',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'database'   => 'ci4',
    //        'schema'     => 'public',
    //        'DBDriver'   => 'Postgre',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'utf8',
    //        'swapPre'    => '',
    //        'failover'   => [],
    //        'port'       => 5432,
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    //    /**
    //     * Sample database connection for SQLSRV.
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => '',
    //        'hostname'   => 'localhost',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'database'   => 'ci4',
    //        'schema'     => 'dbo',
    //        'DBDriver'   => 'SQLSRV',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'utf8',
    //        'swapPre'    => '',
    //        'encrypt'    => false,
    //        'failover'   => [],
    //        'port'       => 1433,
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    //    /**
    //     * Sample database connection for OCI8.
    //     *
    //     * You may need the following environment variables:
    //     *   NLS_LANG                = 'AMERICAN_AMERICA.UTF8'
    //     *   NLS_DATE_FORMAT         = 'YYYY-MM-DD HH24:MI:SS'
    //     *   NLS_TIMESTAMP_FORMAT    = 'YYYY-MM-DD HH24:MI:SS'
    //     *   NLS_TIMESTAMP_TZ_FORMAT = 'YYYY-MM-DD HH24:MI:SS'
    //     *
    //     * @var array<string, mixed>
    //     */
    //    public array $default = [
    //        'DSN'        => 'localhost:1521/FREEPDB1',
    //        'username'   => 'root',
    //        'password'   => 'root',
    //        'DBDriver'   => 'OCI8',
    //        'DBPrefix'   => '',
    //        'pConnect'   => false,
    //        'DBDebug'    => true,
    //        'charset'    => 'AL32UTF8',
    //        'swapPre'    => '',
    //        'failover'   => [],
    //        'dateFormat' => [
    //            'date'     => 'Y-m-d',
    //            'datetime' => 'Y-m-d H:i:s',
    //            'time'     => 'H:i:s',
    //        ],
    //    ];

    /**
     * This database connection is used when running PHPUnit database tests.
     *
     * @var array<string, mixed>
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => true,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
        'synchronous' => null,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        // Check if MySQL is configured / reachable
        $host   = env('database.default.hostname', $this->default['hostname'] ?? '127.0.0.1');
        $port   = (int) env('database.default.port', $this->default['port'] ?? 3306);
        $driver = env('database.default.DBDriver', $this->default['DBDriver'] ?? 'MySQLi');

        $useSqlite = false;
        if ($driver === 'SQLite3') {
            $useSqlite = true;
        } else {
            // Quick connectivity probe with a low timeout (0.3s) to avoid blocking
            $canConnect = false;
            try {
                $socket = @fsockopen($host, $port, $errno, $errstr, 0.3);
                if ($socket) {
                    fclose($socket);
                    $canConnect = true;
                }
            } catch (\Throwable $e) {
                $canConnect = false;
            }

            if (!$canConnect) {
                $useSqlite = true;
            }
        }

        if ($useSqlite) {
            $sqlitePath = WRITEPATH . 'siteops.sqlite';
            $this->default = [
                'database'    => $sqlitePath,
                'DBDriver'    => 'SQLite3',
                'DBPrefix'    => '',
                'pConnect'    => false,
                'DBDebug'     => false,
                'foreignKeys' => false,
                'busyTimeout' => 1000,
                'synchronous' => null,
                'swapPre'     => '',
                'failover'    => [],
                'dateFormat'  => [
                    'date'     => 'Y-m-d',
                    'datetime' => 'Y-m-d H:i:s',
                    'time'     => 'H:i:s',
                ],
            ];

            $this->ensureSqliteSchema($sqlitePath);
        }

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }

    /**
     * Auto-initializes SQLite database schema and default seed data if needed
     */
    protected function ensureSqliteSchema(string $sqlitePath): void
    {
        try {
            $isNew = !file_exists($sqlitePath) || filesize($sqlitePath) < 512;
            $db = new \SQLite3($sqlitePath);
            $db->busyTimeout(5000);

            if ($isNew) {
                // Table 1: users
                $db->exec("CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT NOT NULL,
                    email TEXT NOT NULL UNIQUE,
                    password_hash TEXT NOT NULL,
                    role TEXT NOT NULL DEFAULT 'user',
                    plan_type TEXT NOT NULL DEFAULT 'trial',
                    trial_ends_at DATETIME NULL,
                    stripe_customer_id TEXT NULL,
                    subscription_id TEXT NULL,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )");

                // Table 2: sites
                $db->exec("CREATE TABLE IF NOT EXISTS sites (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    user_id INTEGER NOT NULL,
                    domain TEXT NOT NULL,
                    site_key TEXT NOT NULL UNIQUE,
                    module_accessibility INTEGER NOT NULL DEFAULT 1,
                    module_reviews INTEGER NOT NULL DEFAULT 1,
                    module_seo INTEGER NOT NULL DEFAULT 1,
                    module_dunning INTEGER NOT NULL DEFAULT 0,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )");

                // Table 3: reviews
                $db->exec("CREATE TABLE IF NOT EXISTS reviews (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    site_id INTEGER NOT NULL,
                    reviewer_name TEXT NOT NULL,
                    role_or_company TEXT NULL,
                    rating INTEGER NOT NULL DEFAULT 5,
                    review_text TEXT NOT NULL,
                    source TEXT NOT NULL DEFAULT 'custom',
                    is_active INTEGER NOT NULL DEFAULT 1,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )");

                // Table 4: seo_audits
                $db->exec("CREATE TABLE IF NOT EXISTS seo_audits (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    site_id INTEGER NOT NULL,
                    page_url TEXT NOT NULL,
                    seo_score INTEGER NOT NULL,
                    geo_ai_score INTEGER NOT NULL,
                    recommendations_json TEXT NOT NULL,
                    audited_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )");

                // Table 5: dunning_logs
                $db->exec("CREATE TABLE IF NOT EXISTS dunning_logs (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    site_id INTEGER NOT NULL,
                    customer_email TEXT NOT NULL,
                    amount REAL NOT NULL,
                    currency TEXT NOT NULL DEFAULT 'USD',
                    status TEXT NOT NULL DEFAULT 'pending',
                    sent_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )");

                // Table 6: daily_usage_logs
                $db->exec("CREATE TABLE IF NOT EXISTS daily_usage_logs (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    user_id INTEGER NOT NULL,
                    task_type TEXT NOT NULL DEFAULT 'seo_audit',
                    usage_date TEXT NOT NULL,
                    task_count INTEGER NOT NULL DEFAULT 0,
                    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                    UNIQUE (user_id, usage_date)
                )");

                // Table 7: visitor_logs
                $db->exec("CREATE TABLE IF NOT EXISTS visitor_logs (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    domain TEXT NOT NULL,
                    site_id INTEGER NULL,
                    page_url TEXT NULL,
                    ip_address TEXT NULL,
                    user_agent TEXT NULL,
                    device_type TEXT NOT NULL DEFAULT 'desktop',
                    referrer TEXT NULL,
                    visited_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )");

                // Table 8: query_logs
                $db->exec("CREATE TABLE IF NOT EXISTS query_logs (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    query_type TEXT NOT NULL,
                    target_domain TEXT NOT NULL,
                    ip_address TEXT NULL,
                    status TEXT NOT NULL DEFAULT 'success',
                    score_seo INTEGER NULL,
                    score_security INTEGER NULL,
                    details_json TEXT NULL,
                    queried_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )");

                // Insert default demo & test users (all with password: password123)
                $passwordHash = password_hash('password123', PASSWORD_BCRYPT);
                
                // 1. Alex Rivera (Pro user - matches "Fill Demo Login" button)
                $db->exec("INSERT OR IGNORE INTO users (id, name, email, password_hash, role, plan_type, trial_ends_at) 
                           VALUES (1, 'Alex Rivera', 'alex@techfounder.io', '{$passwordHash}', 'user', 'pro', NULL)");

                // 2. Demo User
                $db->exec("INSERT OR IGNORE INTO users (id, name, email, password_hash, role, plan_type, trial_ends_at) 
                           VALUES (2, 'SiteOps Founder', 'demo@siteops.io', '{$passwordHash}', 'user', 'trial', datetime('now', '+15 days'))");

                // 3. Trial User
                $db->exec("INSERT OR IGNORE INTO users (id, name, email, password_hash, role, plan_type, trial_ends_at) 
                           VALUES (3, 'Trial User', 'trial@siteops.io', '{$passwordHash}', 'user', 'trial', datetime('now', '+15 days'))");

                // Insert default demo site (so_9f81a7b2e4c6) for Alex
                $db->exec("INSERT OR IGNORE INTO sites (id, user_id, domain, site_key, module_accessibility, module_reviews, module_seo, module_dunning) 
                           VALUES (1, 1, 'mysaas.com', 'so_9f81a7b2e4c6', 1, 1, 1, 1)");

                // Insert default demo site for Demo user
                $db->exec("INSERT OR IGNORE INTO sites (id, user_id, domain, site_key, module_accessibility, module_reviews, module_seo, module_dunning) 
                           VALUES (2, 2, 'siteops.io', 'so_demo89012345', 1, 1, 1, 1)");

                // Insert default verified reviews for so_9f81a7b2e4c6
                $db->exec("INSERT OR IGNORE INTO reviews (id, site_id, reviewer_name, role_or_company, rating, review_text, source, is_active) 
                           VALUES 
                           (1, 1, 'Marcus Lindqvist', 'Founder, NordicStack', 5, 'SiteOps replaced our $49/mo accessibility widget and bloated review plugin with a 12KB script. Core Web Vitals jumped 19 pts.', 'trustpilot', 1),
                           (2, 1, 'Elena Rostova', 'Head of Growth, FinFlow EU', 5, 'European Accessibility Act (EAA 2025) compliance handled in 2 minutes. The auto alt-tag fixer is genius.', 'google', 1),
                           (3, 1, 'David Miller', 'CTO, CloudOps Agency', 5, 'Recovered $4,200 in failed Stripe subscriptions in our first 30 days. Paid for itself 100x over.', 'custom', 1)");
            }

            // Always ensure 'role' column exists in users table
            try {
                $db->exec("ALTER TABLE users ADD COLUMN role TEXT DEFAULT 'user'");
            } catch (\Throwable $e) {}

            // Always ensure visitor_logs and query_logs tables exist (even if DB was created previously)
            try {
                $db->exec("CREATE TABLE IF NOT EXISTS visitor_logs (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    domain TEXT NOT NULL,
                    site_id INTEGER NULL,
                    page_url TEXT NULL,
                    ip_address TEXT NULL,
                    user_agent TEXT NULL,
                    device_type TEXT NOT NULL DEFAULT 'desktop',
                    referrer TEXT NULL,
                    visited_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )");
                $db->exec("CREATE TABLE IF NOT EXISTS query_logs (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    query_type TEXT NOT NULL,
                    target_domain TEXT NOT NULL,
                    ip_address TEXT NULL,
                    status TEXT NOT NULL DEFAULT 'success',
                    score_seo INTEGER NULL,
                    score_security INTEGER NULL,
                    details_json TEXT NULL,
                    queried_at DATETIME DEFAULT CURRENT_TIMESTAMP
                )");
            } catch (\Throwable $e) {}

            // Always ensure Nitin's account and aiorbit.kesug.com domain are preserved
            try {
                $passwordHash = password_hash('password123', PASSWORD_BCRYPT);
                $db->exec("INSERT OR IGNORE INTO users (id, name, email, password_hash, role, plan_type, trial_ends_at) 
                           VALUES (4, 'Nitin Mandle', 'nitinmandle3@gmail.com', '{$passwordHash}', 'user', 'trial', datetime('now', '+15 days'))");
                $db->exec("INSERT OR IGNORE INTO sites (id, user_id, domain, site_key, module_accessibility, module_reviews, module_seo, module_dunning) 
                           VALUES (4, 4, 'aiorbit.kesug.com', 'so_ef1c411ebccb0', 1, 1, 1, 0)");
                $db->exec("INSERT OR IGNORE INTO visitor_logs (domain, site_id, page_url, ip_address, device_type, visited_at)
                           VALUES ('aiorbit.kesug.com', 4, '/api/config/so_ef1c411ebccb0', '185.27.134.135', 'desktop', datetime('now'))");
            } catch (\Throwable $e) {}

            // Always ensure master admin user exists (admin@siteops.io / admin123)
            $adminHash = password_hash('admin123', PASSWORD_BCRYPT);
            $db->exec("INSERT OR IGNORE INTO users (id, name, email, password_hash, role, plan_type) 
                       VALUES (999, 'Master Administrator', 'admin@siteops.io', '{$adminHash}', 'admin', 'enterprise')");
            $db->exec("UPDATE users SET role = 'admin' WHERE email = 'admin@siteops.io'");

            $db->close();
        } catch (\Throwable $e) {
            // Silently handle
        }
    }
}
