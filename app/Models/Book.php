<?php

namespace App\Models; // 1. Removido o \Model daqui

use Illuminate\Database\Eloquent\Factories\HasFactory; // 2. Corrigido o caminho
use Illuminate\Database\Eloquent\Model; // 3. ADICIONADO: O PHP precisa saber quem é o "Model"
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    // 4. CORREÇÃO: O nome correto é $fillable (com dois 'l' e um 'a', sem o 'i')
    protected $fillable = [
        'title', 
        'author', 
        'isbn', 
        'price', 
        'publication_date', 
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}