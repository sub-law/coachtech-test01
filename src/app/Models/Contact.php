<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'gender', 'email', 'tel', 'address', 'building', 'detail', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name}";
    }

    public function getGenderLabelAttribute()
    {
        return match ($this->gender) 
        {
            1 => '男性',
            2 => '女性',
            3 => 'その他',
            default => '不明',
        };
    }

    public function getCategoryNameAttribute()
    {
        return $this->category->content ?? '未分類';
    }

    public static function genderOptions()
    {
        return 
        [
            '' => '性別',
            'all' => '全て',
            '1' => '男性',
            '2' => '女性',
            '3' => 'その他',
        ];
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword))
        {
            $query->where(function ($q) use ($keyword)
                            {
                                $q->where('first_name', 'like', "%{$keyword}%")
                                ->orWhere('last_name', 'like', "%{$keyword}%")
                                ->orWhere('email', 'like', "%{$keyword}%");
                            }
                        );
        }
    }

    public function scopeGenderSearch($query, $gender)
    {
        if (!empty($gender) && $gender !== 'all') {
            $query->where('gender', $gender);
        }
    }

    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
            $query->where('category_id', $category_id);
        }
    }

    public function scopeDateSearch($query, $date)
    {
        if (!empty($date)) {
            $query->whereDate('created_at', $date);
        }
    }
}
