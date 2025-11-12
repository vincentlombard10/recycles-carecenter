<?php

namespace App\Services;

use App\Models\Item;

class ItemService
{
    public function createItem(array $data): Item
    {
        return Item::create($data);
    }

    public function updateItem(Item $item, array $data): Item
    {
        $item->update($data);
        return $item;
    }
}
