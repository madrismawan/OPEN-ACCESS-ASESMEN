<?php

namespace Modules\Produk\Http\Interfaces;

interface ProdukRepositoryInterface
{
    public function getAll();
    public function getProdukById($id);
    public function deleteProduk($id);
    public function createProduk(array $produk);
    public function updateProduk($id, array $produk);

    public function updateOrCreate($id, array $produk);
}
