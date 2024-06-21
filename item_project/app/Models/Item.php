<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     title="Item",
 *     description="Item model",
 *     @OA\Xml(
 *         name="Item"
 *     )
 * )
 */
class Item extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = ['name', 'price'];

    /**
     * @OA\Property(
     *     title="Name",
     *     description="Name of the item",
     *     example="Item name"
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     title="Price",
     *     description="Price of the item",
     *     example=100
     * )
     *
     * @var integer
     */
    private $price;
}
