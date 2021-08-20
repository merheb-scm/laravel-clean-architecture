<?php

namespace App\Repositories;

use App\Domain\Interfaces\Items\IItem;
use App\Domain\Interfaces\Items\IItemRepository;
use App\Models\Item;
use Illuminate\Support\Collection;

class ItemRepository implements IItemRepository
{
    /**
     * @param IItem $itemEntity
     *
     * @return IItem
     */
    public function create(IItem $itemEntity): IItem
    {
        $item = Item::fromEntity($itemEntity);

        $item->save();

        return $item->toEntity();
    }

    /**
     * @param int $id
     *
     * @return IItem|null
     */
    public function find(int $id): ?IItem
    {
        $item = Item::find($id);

        return $item?->toEntity();
    }

    /**
     * ATT. this return a collection of Laravel Model
     *
     * @param string|null $keywords
     *
     * @return Collection<IItem>
     */
    public function findByKeywords(?string $keywords): Collection
    {
        $items = (!$keywords)
            ? Item::all()
            : Item::where('title', 'like', "%{$keywords}%")
                ->orWhere('description', 'like', "%{$keywords}%")
                ->get();

        return $items->map(function (Item $item) {
            return $item->toEntity();
        });
    }

    /**
     * @param IItem $itemEntity
     *
     * @return bool
     */
    public function exists(IItem $itemEntity): bool
    {
        $item = Item::whereTitle($itemEntity->getTitle())->first();

        return $item !== null;
    }

    /**
     * @param IItem $itemEntity
     *
     * @return IItem
     */
    public function update(IItem $itemEntity): IItem
    {
        $item = Item::find($itemEntity->getId() ?? 0);
        $item?->update([
                           'title' => $itemEntity->getTitle(),
                           'description' => $itemEntity->getDescription(),
                       ]);

        return $item?->toEntity();
    }

    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        $item = Item::find($id);
        $item?->delete();
    }
}
