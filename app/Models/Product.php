<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model  {

	protected $fillable = [
        'code',
        'name',
        'price',
        'model',
        'description',
        'photo',
        'category_id',
        'grade_id',
        'is_active'
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            // Ensure category_id is set
            if (!$product->category_id) {
                $defaultCategory = \DB::table('categories')->first();
                if ($defaultCategory) {
                    $product->category_id = $defaultCategory->id;
                }
            }
            
            \Log::info('Product creating event:', [
                'attributes' => $product->getAttributes(),
                'original' => $product->getOriginal()
            ]);
        });

        // Create inventory record after product is created
        static::created(function ($product) {
            // Create a new inventory record for the product
            $product->inventory()->create([
                'quantity' => 0, // Start with 0 quantity
                'location' => 'warehouse', // Default location
                'notes' => 'Initial inventory record'
            ]);
        });
    }
    
    /**
     * Get the category that owns the product.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
    /**
     * Get the grade that owns the product.
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }
    
    /**
     * Get the product's inventory.
     */
    public function inventory()
    {
        return $this->hasOne(ProductInventory::class);
    }
    
    /**
     * Get the purchases for this product.
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    
    /**
     * Get the users who have favorited this product.
     */
    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'product_favorites');
    }
    
    /**
     * Check if product is in stock
     */
    public function isInStock()
    {
        // Load the inventory relationship if it's not already loaded
        if (!$this->relationLoaded('inventory')) {
            $this->load('inventory');
        }

        if ($this->inventory) {
            return $this->inventory->quantity > 0;
        }
        
        return false;
    }
    
    /**
     * Get the available quantity
     */
    public function getAvailableQuantity()
    {
        // Load the inventory relationship if it's not already loaded
        if (!$this->relationLoaded('inventory')) {
            $this->load('inventory');
        }

        if ($this->inventory) {
            return $this->inventory->quantity;
        }
        
        return 0;
    }
}