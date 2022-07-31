<?php

namespace Modules\Produk\Providers;

use Illuminate\Support\ServiceProvider;

use Modules\Produk\Http\Interfaces\ProdukRepositoryInterface;
use Modules\Produk\Http\Repositories\ProdukRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProdukRepositoryInterface::class, ProdukRepository::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
