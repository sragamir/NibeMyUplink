<?php
// Simple OAuth2 callback display with basic HTML wrapper
// Keep output minimal and escape any user-supplied values
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nibe MyUplink Callback</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; line-height: 1.5; padding: 20px; }
        header, footer { margin-bottom: 1rem; }
        .container { max-width: 800px; margin: 0 auto; }
        pre { background:#f7f7f7; padding:10px; border-radius:4px; }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>www.sraga.cz</h1>
            <p>Nibe MyUplink OAuth2 Callback Script</p>
        </header>

        <main>
            <?php
            // Helper to safely output a label + value
            function show_param(string $label, $value): void {
                if ($value === null || $value === '') {
                    echo "<p>Parameter '{$label}' not found</p>\n";
                    return;
                }
                // escape for HTML
                $safe = htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                echo "<p><code>Parameter '{$label}' found, value is: <strong>" . $safe . "</strong></code></p>\n";
            }

            $code = $_GET['code'] ?? null;
            $state = $_GET['state'] ?? null;
            $error = $_GET['error'] ?? null;

            show_param('code', $code);
            show_param('state', $state);

            if ($error !== null && $error !== '') {
                echo "<p><strong>Error:</strong> " . htmlspecialchars((string)$error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . "</p>\n";
            }
            ?>
        </main>

        <footer>
            <p>&copy; <?php echo date('Y'); ?> <a href="https://www.sraga.cz" target="_blank">www.sraga.cz</a></p>
        </footer>
    </div>
</body>
</html>

