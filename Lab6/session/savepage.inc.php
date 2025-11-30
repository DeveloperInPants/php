<?php
declare(strict_types=1);

/**
 * Task 1: Save page tracking
 * This file handles session initialization and page tracking.
 * It saves the current page in the session visited pages list.
 */

// Start session
session_start();

/**
 * Initialize the visited pages array in session if it doesn't exist.
 * 
 * @return void
 */
function initializeVisitedPages(): void {
    if (!isset($_SESSION['visited_pages'])) {
        $_SESSION['visited_pages'] = [];
    }
}

/**
 * Add the current page to the visited pages list in the session.
 * 
 * @param string $pagePath The path or identifier of the current page
 * @return void
 */
function saveCurrentPage(string $pagePath): void {
    initializeVisitedPages();
    $_SESSION['visited_pages'][] = $pagePath;
}
