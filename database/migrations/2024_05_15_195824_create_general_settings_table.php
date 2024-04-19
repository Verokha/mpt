<?php

use App\Models\GeneralSettings;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('name', 509);
            $table->string('tech_name', 509);
            $table->jsonb('content')->nullable();
            $table->timestamps();
        });
        DB::table('general_settings')
            ->insert([
                [
                    'name' => 'Главяная страница',
                    'tech_name' => GeneralSettings::HOME_TECH,
                ],
                [
                    'name' => 'Страница "Справка об обучении"',
                    'tech_name' => GeneralSettings::CERT_STUDY_TECH,
                ],
                [
                    'name' => 'Страница "Заказ характеристики"',
                    'tech_name' => GeneralSettings::CERT_CHARACTERISTIC_TECH,
                ],
                [
                    'name' => 'Страница "Загрузка платежки"',
                    'tech_name' => GeneralSettings::CERT_PO_TECH,
                ],

            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
