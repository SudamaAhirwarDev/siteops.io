-- =====================================================================
-- SiteOps - Ultra-Lightweight All-in-One Website Growth & Compliance Suite
-- Database Schema for MySQL 8.0+ / MariaDB 10.4+
-- Charset: utf8mb4 | Collation: utf8mb4_unicode_ci
-- =====================================================================

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS `dunning_logs`;
DROP TABLE IF EXISTS `seo_audits`;
DROP TABLE IF EXISTS `reviews`;
DROP TABLE IF EXISTS `sites`;
DROP TABLE IF EXISTS `users`;
SET FOREIGN_KEY_CHECKS = 1;

-- ---------------------------------------------------------------------
-- Table 1: users
-- Core account storage for SaaS founders, agency owners, and operators.
-- ---------------------------------------------------------------------
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(191) NOT NULL,
    `password_hash` VARCHAR(255) NOT NULL,
    `plan_type` ENUM('trial', 'pro', 'agency', 'expired') NOT NULL DEFAULT 'trial',
    `trial_ends_at` DATETIME NULL DEFAULT NULL,
    `stripe_customer_id` VARCHAR(100) NULL DEFAULT NULL,
    `subscription_id` VARCHAR(191) NULL DEFAULT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_users_email` (`email`),
    KEY `idx_users_plan_type` (`plan_type`),
    KEY `idx_users_stripe_cust` (`stripe_customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='SiteOps registered accounts, trial status, and plan tiers';

-- ---------------------------------------------------------------------
-- Table 2: sites
-- Client websites monitored by SiteOps. Each site gets a unique 16-char
-- token for the lightweight CDN embed script (<15KB).
-- ---------------------------------------------------------------------
CREATE TABLE `sites` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `domain` VARCHAR(255) NOT NULL,
    `site_key` VARCHAR(16) NOT NULL,
    `module_accessibility` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'EU EAA 2025 & US ADA Toolbar',
    `module_reviews` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'Social Proof & Review Widget',
    `module_seo` TINYINT(1) NOT NULL DEFAULT 1 COMMENT 'AI Search & GEO Optimization Auditor',
    `module_dunning` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Stripe Failed Payment Recovery',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_sites_site_key` (`site_key`),
    KEY `idx_sites_user_id` (`user_id`),
    KEY `idx_sites_domain` (`domain`),
    CONSTRAINT `fk_sites_user` FOREIGN KEY (`user_id`) 
        REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Websites registered under user accounts';

-- ---------------------------------------------------------------------
-- Table 3: reviews
-- Social proof testimonials, imported reviews (Google, Trustpilot, Custom).
-- ---------------------------------------------------------------------
CREATE TABLE `reviews` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `site_id` BIGINT UNSIGNED NOT NULL,
    `reviewer_name` VARCHAR(100) NOT NULL,
    `role_or_company` VARCHAR(100) NULL DEFAULT NULL,
    `rating` TINYINT UNSIGNED NOT NULL DEFAULT 5 COMMENT 'Star rating between 1 and 5',
    `review_text` TEXT NOT NULL,
    `source` ENUM('google', 'trustpilot', 'custom') NOT NULL DEFAULT 'custom',
    `is_active` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1 = visible in widget, 0 = hidden',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_reviews_site_id` (`site_id`),
    KEY `idx_reviews_status_rating` (`site_id`, `is_active`, `rating`),
    CONSTRAINT `fk_reviews_site` FOREIGN KEY (`site_id`) 
        REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `chk_reviews_rating` CHECK (`rating` BETWEEN 1 AND 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Social proof reviews and testimonials per site';

-- ---------------------------------------------------------------------
-- Table 4: seo_audits
-- AI Search Engine & GEO (Generative Engine Optimization) readiness scores
-- along with recommendations for ChatGPT, Gemini, and Google search.
-- ---------------------------------------------------------------------
CREATE TABLE `seo_audits` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `site_id` BIGINT UNSIGNED NOT NULL,
    `page_url` VARCHAR(2048) NOT NULL,
    `seo_score` TINYINT UNSIGNED NOT NULL COMMENT 'Traditional Technical SEO Score (0-100)',
    `geo_ai_score` TINYINT UNSIGNED NOT NULL COMMENT 'Generative AI Engine Readiness Score (0-100)',
    `recommendations_json` JSON NOT NULL COMMENT 'Structured actionable remediation checklist',
    `audited_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_seo_audits_site_id` (`site_id`),
    KEY `idx_seo_audits_audited_at` (`audited_at`),
    CONSTRAINT `fk_seo_audits_site` FOREIGN KEY (`site_id`) 
        REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `chk_seo_score` CHECK (`seo_score` BETWEEN 0 AND 100),
    CONSTRAINT `chk_geo_ai_score` CHECK (`geo_ai_score` BETWEEN 0 AND 100)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Automated SEO and Generative AI search audit records';

-- ---------------------------------------------------------------------
-- Table 5: dunning_logs
-- Tracks automated recovery alerts for failed Stripe / subscription payments.
-- ---------------------------------------------------------------------
CREATE TABLE `dunning_logs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `site_id` BIGINT UNSIGNED NOT NULL,
    `customer_email` VARCHAR(191) NOT NULL,
    `amount` DECIMAL(10,2) NOT NULL,
    `currency` VARCHAR(3) NOT NULL DEFAULT 'USD',
    `status` ENUM('pending', 'recovered', 'failed') NOT NULL DEFAULT 'pending',
    `sent_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `idx_dunning_site_id` (`site_id`),
    KEY `idx_dunning_status` (`status`),
    KEY `idx_dunning_customer` (`customer_email`),
    CONSTRAINT `fk_dunning_site` FOREIGN KEY (`site_id`) 
        REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Failed subscription payment dunning attempts and recovery status';

-- ---------------------------------------------------------------------
-- Table 6: daily_usage_logs
-- Tracks daily task usage for free trial users (5 tasks/day limit).
-- ---------------------------------------------------------------------
CREATE TABLE `daily_usage_logs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` BIGINT UNSIGNED NOT NULL,
    `task_type` ENUM('seo_audit', 'dunning_recovery', 'review_sync', 'accessibility_scan') NOT NULL DEFAULT 'seo_audit',
    `usage_date` DATE NOT NULL,
    `task_count` INT NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_user_usage_date` (`user_id`, `usage_date`),
    KEY `idx_usage_user_id` (`user_id`),
    KEY `idx_usage_date` (`usage_date`),
    CONSTRAINT `fk_daily_usage_user` FOREIGN KEY (`user_id`) 
        REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Daily task usage tracking for 15-day free trial limits';

-- ---------------------------------------------------------------------
-- Sample Demo Seed Data (Optional for testing & local development)
-- ---------------------------------------------------------------------
INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `plan_type`, `stripe_customer_id`, `created_at`) 
VALUES
(1, 'Alex Rivera', 'alex@techfounder.io', '$2y$12$e8Y1xP/Rsm8Zf7Vd9gU5qO4mD9XqE5J1hZ0sV9nN4Y8V3sW9X1z2a', 'pro', 'cus_N8yV10Pq9kL2aZ', NOW()),
(2, 'Sophia Schmidt', 'sophia@berlinagencies.de', '$2y$12$K8j1vP/Rsm8Zf7Vd9gU5qO4mD9XqE5J1hZ0sV9nN4Y8V3sW9X1z2b', 'agency', 'cus_K4xM99Za3bC8eD', NOW());

INSERT INTO `sites` (`id`, `user_id`, `domain`, `site_key`, `module_accessibility`, `module_reviews`, `module_seo`, `module_dunning`, `created_at`) 
VALUES
(1, 1, 'techfounder.io', 'so_9f81a7b2e4c6', 1, 1, 1, 1, NOW()),
(2, 2, 'nordicstore.eu', 'so_a1b2c3d4e5f6', 1, 1, 1, 0, NOW());

INSERT INTO `reviews` (`site_id`, `reviewer_name`, `role_or_company`, `rating`, `review_text`, `source`, `is_active`) 
VALUES
(1, 'Marcus Lindqvist', 'CTO at CloudStack Stockholm', 5, 'SiteOps replaced our $49/mo accessibility widget and bloated review plugin with a single 12KB script. Our Core Web Vitals jumped by 19 points.', 'trustpilot', 1),
(1, 'Elena Rostova', 'Growth Lead at SaaSFlow UK', 5, 'The Dunning module alone recovered $3,400 in failed Stripe subscriptions in our first 30 days. Unbelievable ROI.', 'google', 1),
(1, 'David Miller', 'Head of E-Commerce, Austin TX', 5, 'Full EAA 2025 and ADA compliance in 2 minutes. The live contrast and reader controls are flawless.', 'custom', 1);

INSERT INTO `seo_audits` (`site_id`, `page_url`, `seo_score`, `geo_ai_score`, `recommendations_json`, `audited_at`) 
VALUES
(1, 'https://techfounder.io', 94, 91, JSON_ARRAY(
    JSON_OBJECT('type', 'geo_ai', 'severity', 'info', 'title', 'Perplexity/ChatGPT Citation Optimization', 'description', 'Schema.org WebPage structured data is fully annotated with author credentials and high semantic relevance.'),
    JSON_OBJECT('type', 'performance', 'severity', 'pass', 'title', 'Core Web Vitals LCP', 'description', 'LCP measured at 0.8s on 4G fast mobile (Zero render blocking JS).'),
    JSON_OBJECT('type', 'accessibility', 'severity', 'pass', 'title', 'WCAG 2.1 AA Color Contrast', 'description', '100% compliant contrast ratios detected across all button targets.')
), NOW());

INSERT INTO `dunning_logs` (`site_id`, `customer_email`, `amount`, `currency`, `status`, `sent_at`) 
VALUES
(1, 'billing@nordicmedia.se', 149.00, 'USD', 'recovered', NOW() - INTERVAL 2 DAY),
(1, 'finance@apexstudios.com', 89.00, 'USD', 'recovered', NOW() - INTERVAL 1 DAY),
(1, 'accounts@devscale.co', 299.00, 'USD', 'pending', NOW() - INTERVAL 3 HOUR);
