<?php

namespace App\Services;

use App\Models\Brand;

class BrandService
{
    public function createBrand(array $data): Brand
    {
        return Brand::create($data);
    }

    public function updateBrand(Brand $brand, array $data): Brand
    {
        $brand->update($data);
        return $brand;
    }

}
