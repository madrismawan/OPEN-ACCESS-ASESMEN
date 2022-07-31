<?php

namespace Modules\Produk\Http\Repositories;

use Modules\Produk\Http\Interfaces\ProdukRepositoryInterface;
use Modules\Produk\Entities\Produk;

class ProdukRepository implements ProdukRepositoryInterface
{
    public function getAll()
    {
        return Produk::all();
    }

    public function getProdukById($id)
    {
        return Produk::findOrFail($id);
    }

    public function deleteProduk($id)
    {
        Produk::destroy($id);
    }

    public function createProduk(array $produk)
    {
        return Produk::create($produk);
    }

    public function updateProduk($id, array $produk)
    {
        return Produk::whereId($id)->update($produk);
    }

    public function updateOrCreate($id,array $produk)
    {
        return Produk::updateOrCreate(
            ['id' => $id],
            ['nama' => $produk['nama'],'keterangan' => $produk['keterangan'],'persediaan' => $produk['persediaan'],'harga' => $produk['harga']]
        );

    }


}
