<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Book
 */
class Author extends Model
{
    use HasFactory;
    public function authors() {
        return $this->BelongsTo(Author::class);
    }
}
