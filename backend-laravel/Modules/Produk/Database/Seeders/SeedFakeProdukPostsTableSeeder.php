<?php

namespace Modules\Produk\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedFakeProdukPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('produk')->delete();


        DB::table('produk')->insert(array (
            0 =>
            array (
                'nama' => 'buku',
                'keterangan' => 'Buku Tulis',
                'harga' => 5000,
                'persediaan' => 2,
            ),
            1 =>
            array (
                'nama' => 'penghapus',
                'keterangan' => 'penghapus papan',
                'harga' => 9000,
                'persediaan' => 4,
            ),
            2 =>
            array (
                'nama' => 'pengaris',
                'keterangan' => 'pengaris buku',
                'harga' => 6000,
                'persediaan' => 32,
            ),
            3 =>
            array (
                'nama' => 'pensil',
                'keterangan' => 'pensil 2B',
                'harga' => 2000,
                'persediaan' => 11,
            ),
        ));

        // $this->call("OthersTableSeeder");
    }
}
