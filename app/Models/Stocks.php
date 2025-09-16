<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    protected $fillable =
        [
            "date",
            "last_change_date",
            "supplier_article",
            "tech_size",
            "barcode",
            "quantity",
            "is_supply",
            "is_realization",
            "in_way_to_client",
            "in_way_from_client",
            "nm_id",
            "subject",
            "category",
            "brand",
            "sc_code",
            "price",
            "discount"
        ];
}
