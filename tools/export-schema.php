<?php
// Read structure only: never export account records or connection credentials.
require (getenv('ACADEMY_APP_ROOT') ?: __DIR__.'/../src').'/vendor/autoload.php';
$app = require (getenv('ACADEMY_APP_ROOT') ?: __DIR__.'/../src').'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$schema = Illuminate\Support\Facades\Schema::getFacadeRoot();
$tables = [];
foreach ($schema->getTables() as $table) {
    $name = $table['schema_qualified_name'] ?? $table['name'];
    $tables[$name] = ['columns'=>$schema->getColumns($name), 'indexes'=>$schema->getIndexes($name), 'foreign_keys'=>$schema->getForeignKeys($name)];
}
echo json_encode(['driver'=>Illuminate\Support\Facades\DB::connection()->getDriverName(), 'tables'=>$tables, 'migrations'=>Illuminate\Support\Facades\DB::table('migrations')->orderBy('id')->pluck('migration')->all()], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
