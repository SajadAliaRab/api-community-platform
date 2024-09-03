<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
* Run the migrations.
*/
public function up(): void
{
Schema::table('articles', function (Blueprint $table) {
$table->unsignedDecimal('rate', 2, 1)->after('content')->default(4);
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::table('articles', function (Blueprint $table) {
$table->dropColumn('rate');
});
}
};
