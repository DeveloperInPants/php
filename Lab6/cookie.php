<?php
declare(strict_types=1);

/**
 * Task 1: Cookie Tracking
 * This script tracks user visits using cookies.
 * On the first visit, it displays "Welcome!"
 * On subsequent visits, it shows the number of visits and the last visit time.
 */

// Define cookie parameters
$cookieName = 'visit_tracker';
$cookieLifetime = 2592000; // 30 days in seconds

/**
 * Initialize and manage visit tracking cookie
 * 
 * This function initializes the visit tracker cookie if it doesn't exist,
 * or increments the visit count if it does. It also updates the timestamp
 * of the last visit.
 * 
 * @return array An associative array containing visit count and last visit time
 */
function initializeVisitTracker(): array {
    global $cookieName, $cookieLifetime;
    
    $currentTime = time();
    
    // Check if cookie exists
    if (!isset($_COOKIE[$cookieName])) {
        // First visit - initialize cookie
        $visitData = [
            'count' => 1,
            'lastVisit' => $currentTime
        ];
        $cookieValue = serialize($visitData);
        setcookie($cookieName, $cookieValue, $currentTime + $cookieLifetime, '/');
        return $visitData;
    } else {
        // Subsequent visit - update cookie
        $visitData = unserialize($_COOKIE[$cookieName]);
        $visitData['count']++;
        $visitData['lastVisit'] = $currentTime;
        $cookieValue = serialize($visitData);
        setcookie($cookieName, $cookieValue, $currentTime + $cookieLifetime, '/');
        return $visitData;
    }
}

// Initialize the visit tracker
$visitData = initializeVisitTracker();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookie Tracking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
        .message {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .welcome {
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .revisit {
            background-color: #d1ecf1;
            border-color: #bee5eb;
        }
    </style>
</head>
<body>
    <h1>Cookie Tracking Demo</h1>
    
    <?php if ($visitData['count'] == 1): ?>
        <div class="message welcome">
            <h2>Welcome!</h2>
            <p>This is your first visit to this page.</p>
        </div>
    <?php else: ?>
        <div class="message revisit">
            <h2>Welcome Back!</h2>
            <p>You have visited this page <strong><?php echo htmlspecialchars($visitData['count']); ?></strong> times.</p>
            <p>Your last visit was on <strong><?php echo htmlspecialchars(date('d-m-Y H:i:s', $visitData['lastVisit'])); ?></strong></p>
        </div>
    <?php endif; ?>
    
    <p>
        <a href="javascript:location.reload()">Refresh Page</a> | 
        <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">Visit Again</a>
    </p>
</body>
</html>
