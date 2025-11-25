<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarkMigrationsAsRunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $migrations = [
            '2025_11_25_044308_create_tipo_documento_table',
            '2025_11_25_044334_create_regionales_table',
            '2025_11_25_044502_create_programas_tabe',
            '2025_11_25_045416_create_grupos_table',
            '2025_11_25_045429_create_roles_table',
            '2025_11_25_045445_create_roles_especiales_table',
            '2025_11_25_045515_create_estado_carnet_table',
            '2025_11_25_045545_create_huellas_digitales_table',
            '2025_11_25_051933_create_registros_equipos_table',
            '2025_11_25_052041_create_registros_acceso_table',
            '2025_11_25_052103_create_configuracion_sistema_table',
            '2025_11_25_052434_create_centros_table',
            '2025_11_25_052533_create_usuarios_table',
            '2025_11_25_142709_add_validation_fields_to_usuarios_table',
            '2025_11_25_181329_create_usuario_roles_especiles_table',
        ];

        foreach ($migrations as $migration) {
            DB::table('migrations')->insert([
                'migration' => $migration,
                'batch' => 1,
            ]);
        }
    }
}