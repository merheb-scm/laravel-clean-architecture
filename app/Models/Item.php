<?php

namespace App\Models;

use App\Domain\Interfaces\Items\IItem;
use App\Domain\Entities\Item as ItemEntity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string title
 * @property string description
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Item extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'title',
        'description',
    ];

    public function toEntity(): IItem
    {
        $entity = new ItemEntity();
        $entity->setId($this->id);
        $entity->setTitle($this->title);
        $entity->setDescription($this->description);
        $entity->setCreatedAt($this->created_at);
        $entity->setUpdatedAt($this->updated_at);

        return $entity;
    }

    public static function fromEntity(IItem $entity): static
    {
        return Item::firstOrNew(
            [
                'id' => $entity->getId() ?? 0,
            ],
            ['title' => $entity->getTitle(), 'description' => $entity->getDescription()]
        );
    }
}
