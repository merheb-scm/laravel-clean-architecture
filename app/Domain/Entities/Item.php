<?php

namespace App\Domain\Entities;

use App\Domain\Interfaces\Items\IItem;

class Item extends AuditableEntity implements IItem
{
    protected string|null $title;

    protected string|null $description;

    public function __construct(protected array $attributes = []){
        parent::__construct($attributes);
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
