<?php

namespace App\Domain\Entities;

use App\Domain\Interfaces\IAuditableEntity;
use Illuminate\Support\Str;

abstract class AuditableEntity implements IAuditableEntity
{
    protected ?int $id = null;

    protected ?int $createdBy = null;

    protected ?int $updatedBy = null;

    protected ?\DateTime $createdAt = null;

    protected ?\DateTime $updatedAt = null;

    public function __construct(protected array $attributes = [])
    {
        /*
        foreach ($attributes as $key => $value){
            $setMethod = 'set'. Str::studly($key);
            if (method_exists($this, $setMethod)){
                $this->{$setMethod}($value);
            }
        }
        */
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getCreatedBy(): ?int
    {
        return $this->createdBy;
    }

    /**
     * @param int|null $createdBy
     */
    public function setCreatedBy(?int $createdBy): void
    {
        $this->createdBy = $createdBy;
    }

    /**
     * @return int|null
     */
    public function getUpdatedBy(): ?int
    {
        return $this->updatedBy;
    }

    /**
     * @param int|null $updatedBy
     */
    public function setUpdatedBy(?int $updatedBy): void
    {
        $this->updatedBy = $updatedBy;
    }

    /**
     * @return \DateTime|null
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime|null $createdAt
     */
    public function setCreatedAt(?\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime|null $updatedAt
     */
    public function setUpdatedAt(?\DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
