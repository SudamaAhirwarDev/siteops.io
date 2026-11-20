<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public Landing Page & Loader
$routes->get('/', 'Home::index');
$routes->get('loader.js', 'ApiController::loaderScript');

// SEO, AEO & AI Bot Directives (Sitemap, Robots, LLMs.txt for Perplexity & ChatGPT)
$routes->get('sitemap.xml', 'SeoController::sitemap');
$routes->get('robots.txt', 'SeoController::robots');
$routes->get('llms.txt', 'SeoController::llms');

// Live Public Diagnostic Scanner (SEO, Keywords, Security, Bugs)
$routes->match(['get', 'post'], 'api/scan/public', 'DiagnosticController::scan');
$routes->options('api/scan/public', 'DiagnosticController::scan');

// Public Site Configuration Endpoint (CORS Enabled)
$routes->get('api/config/(:segment)', 'ApiController::config/$1');
$routes->options('api/config/(:segment)', 'ApiController::config/$1');

// Authentication Routes
$routes->get('login', 'AuthController::getLogin');
$routes->post('login', 'AuthController::postLogin');
$routes->get('register', 'AuthController::getRegister');
$routes->post('register', 'AuthController::postRegister');
$routes->get('logout', 'AuthController::getLogout');

// Stripe Webhook Receiver (Exempt from CSRF)
$routes->post('api/webhook/stripe/(:segment)', 'ApiController::stripeWebhook/$1');
// Also support GET simulation for quick testing in browser/Postman
$routes->get('api/webhook/stripe/(:segment)', 'ApiController::stripeWebhook/$1');

// Billing Webhook Receiver (Lemon Squeezy / Dodo Payments / Stripe) (Exempt from CSRF)
$routes->post('api/webhook/billing', 'ApiController::billingWebhook');
$routes->get('api/webhook/billing', 'ApiController::billingWebhook');

// Authenticated Dashboard Routes (Protected by AuthFilter)
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    // Main Dashboard
    $routes->get('dashboard', 'DashboardController::index');
    $routes->post('dashboard/site/create', 'DashboardController::createSite');
    $routes->post('dashboard/module/toggle', 'DashboardController::toggleModule');

    // Module 02: Social Proof & Reviews Manager
    $routes->get('modules/reviews', 'ReviewsController::index');
    $routes->get('modules/reviews/(:num)', 'ReviewsController::index/$1');
    $routes->post('modules/reviews/create/(:num)', 'ReviewsController::create/$1');
    $routes->get('modules/reviews/toggle/(:num)', 'ReviewsController::toggle/$1');
    $routes->post('modules/reviews/delete/(:num)', 'ReviewsController::delete/$1');

    // Module 03: AI SEO & GEO Page Auditor
    $routes->get('modules/seo', 'SeoController::index');
    $routes->get('modules/seo/(:num)', 'SeoController::index/$1');
    $routes->post('modules/seo/analyze', 'SeoController::analyze');

    // Module 04: Failed Payment Recovery (Stripe Dunning)
    $routes->get('modules/dunning', 'DunningController::index');
    $routes->get('modules/dunning/(:num)', 'DunningController::index/$1');
});
