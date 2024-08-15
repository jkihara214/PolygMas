<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public static function forLanguage($languageCode)
    {
        return (new static)->setTable('diaries_' . $languageCode);
    }

    protected $fillable = [
        'user_id',
        'language_id',
        'jp_text',
        'trans_text',
    ];

    protected $hidden = [];

    protected $casts = [];
}
