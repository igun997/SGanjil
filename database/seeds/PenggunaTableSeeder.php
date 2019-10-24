<?php

use Illuminate\Database\Seeder;

class PenggunaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pengguna')->delete();
        
        \DB::table('pengguna')->insert(array (
            0 => 
            array (
                'id_pengguna' => 1,
                'username' => 'rendalumum',
                'password' => 'rendalumum',
                'level' => 'admin_toko',
            ),
            1 => 
            array (
                'id_pengguna' => 2,
                'username' => 'rendalmaterial',
                'password' => 'rendalmaterial',
                'level' => 'admin_gudang',
            ),
            2 => 
            array (
                'id_pengguna' => 3,
                'username' => 'manajer',
                'password' => 'manajer',
                'level' => 'kepala_gudang',
            ),
            3 => 
            array (
                'id_pengguna' => 4,
                'username' => 'juniormanajer',
                'password' => 'juniormanajer',
                'level' => 'keuangan',
            ),
        ));
        
        
    }
}