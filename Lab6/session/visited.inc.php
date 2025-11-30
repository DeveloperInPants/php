<?php
declare(strict_types=1);

/**
 * Task 2: Display visited pages list
 * This file displays the list of visited pages from the session.
 */

/**
 * Get all visited pages from the session
 * 
 * @return array Array of visited page paths/identifiers
 */
function getVisitedPages(): array {
    if (isset($_SESSION['visited_pages'])) {
        return $_SESSION['visited_pages'];
    }
    return [];
}

/**
 * Display the visited pages list as HTML
 * 
 * @return void
 */
function displayVisitedPages(): void {
    $visitedPages = getVisitedPages();
    echo '<h3>Список посещённых страниц</h3>';
    echo '<ol>';
    foreach ($visitedPages as $index => $page) {
        echo '<li>' . htmlspecialchars((string)$page) . '</li>';
    }
    echo '</ol>';
}
