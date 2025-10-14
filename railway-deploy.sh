#!/bin/bash
# Railway.app deployment script for VIDYAZEN

echo "🚀 Starting VIDYAZEN deployment on Railway..."

# Install dependencies if composer.json exists
if [ -f "composer.json" ]; then
    echo "📦 Installing PHP dependencies..."
    composer install --no-dev --optimize-autoloader
fi

# Check if database exists and create tables if needed
php -r "
try {
    \$pdo = new PDO(
        'mysql:host=' . getenv('MYSQLHOST') . ';port=' . getenv('MYSQLPORT') . ';dbname=' . getenv('MYSQLDATABASE'),
        getenv('MYSQLUSER'),
        getenv('MYSQLPASSWORD')
    );
    
    // Check if users table exists
    \$result = \$pdo->query('SHOW TABLES LIKE \"users\"');
    if (\$result->rowCount() == 0) {
        echo '🗄️  Setting up database tables...' . PHP_EOL;
        \$sql = file_get_contents('vidyazen_database.sql');
        \$pdo->exec(\$sql);
        echo '✅ Database setup complete!' . PHP_EOL;
    } else {
        echo '✅ Database already exists!' . PHP_EOL;
    }
} catch (Exception \$e) {
    echo '❌ Database setup failed: ' . \$e->getMessage() . PHP_EOL;
}
"

echo "🎉 VIDYAZEN deployment complete!"
echo "🌐 Your school management system is ready!"