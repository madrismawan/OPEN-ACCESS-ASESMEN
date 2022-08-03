<?php

namespace Modules\Produk\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Modules\Produk\Entities\Produk;

class ProdukControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */


    public function test_get_all_data()
    {
        $this->get(route('produk.all'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => []
            ]);
    }

    public function test_store_data()
    {
        $data = [
            'nama' => 'buku',
            'keterangan' => 'Buku Tulis',
            'harga' => 5000,
            'persediaan' => 2,
        ];

        $this->post(route('produk.store'), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status' ,
                'message' ,
                'data' => []
            ]);
    }

    public function test_required_store_data()
    {
        $data = [];

        $this->post(route('produk.store'), $data)
            ->assertStatus(400)
            ->assertJsonStructure([
                'status' ,
                'message' ,
                'data' => []
            ]);
    }

    public function test_store_diff_type_data()
    {
        $data = [
            'nama' => 'buku',
            'keterangan' => 'Buku Tulis',
            // string type data
            'harga' => 'test',
            'persediaan' => 'test',
        ];

        $this->post(route('produk.store'), $data)
            ->assertStatus(400)
            ->assertJsonStructure([
                'status' ,
                'message' ,
                'data' => []
            ]);
    }


    public function test_show_data()
    {
        $data = [
            'nama' => 'testing_delete',
            'keterangan' => 'Buku Tulis',
            'harga' => 5000,
            'persediaan' => 2,
        ];
        $produk = Produk::create($data);
        $this->get(route('produk.show',$produk->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'status' ,
                'message' ,
                'data' => []
            ]);
    }

    public function test_validation_show()
    {
        $this->get(route('produk.show',-1))
            ->assertStatus(400)
            ->assertJsonStructure([
                'status' ,
                'message' ,
                'data' => []
            ]);
    }

    public function test_delete_data()
    {
        $data = [
            'nama' => 'testing_delete',
            'keterangan' => 'Buku Tulis',
            'harga' => 5000,
            'persediaan' => 2,
        ];
        $produk = Produk::create($data);
        $this->delete(route('produk.delete',$produk->id))
            ->assertStatus(200)
            ->assertJsonStructure([
                'status' ,
                'message' ,
            ]);
    }

    public function test_validation_delete_data()
    {
        $this->delete(route('produk.delete',-1))
            ->assertStatus(400)
            ->assertJsonStructure([
                'status' ,
                'message' ,
                'data' => []
            ]);
    }


    public function test_create_update_data()
    {
        $data = array(
            'nama' => 'buku',
            'keterangan' => 'Buku Tulis',
            'harga' => 5000,
            'persediaan' => 2
        );

        $this->post(route('produk.update-or-create'), $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'status' ,
                'message' ,
                'payload' => []
            ]);
    }







}
