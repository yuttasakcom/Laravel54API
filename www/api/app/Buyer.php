<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\BuyerScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\BuyerTransformer;

class Buyer extends User
{
    use SoftDeletes;

    public $transformer = BuyerTransformer::class;
    protected $dates = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new BuyerScope);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
