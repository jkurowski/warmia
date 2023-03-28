<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use NodeTrait, HasTranslations;

    public $translatable = ['title', 'content', 'content_header', 'meta_title', 'meta_description'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active',
        'parent_id',
        'title',
        'content',
        'content_header',
        'meta_title',
        'meta_description',
        'meta_robots'
    ];

    protected $casts = ['parent_id' => 'integer'];

    public static function mainmenu()
    {
        return view('layouts.partials.menu', [
            'pages' => self::withDepth()->defaultOrder()->get()->toTree()
        ]);
    }

    public static function sidemenu(int $id)
    {
        return view('layouts.partials.sidemenu', [
            'pages' => self::descendantsOf($id)->toTree()
        ]);
    }

    protected function setParent($value)
    {
        $this->setParentId($value ? $value->getKey() : 0)
            ->setRelation('parent', $value);

        return $this;
    }
}
