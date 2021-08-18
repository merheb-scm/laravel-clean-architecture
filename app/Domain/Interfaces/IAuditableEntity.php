<?php

namespace App\Domain\Interfaces;

interface IAuditableEntity
{
    public function getId(): ?int;
    public function setId(int $id): void;

    public function getCreatedBy(): ?int;
    public function setCreatedBy(?int $createdBy): void;

    public function getUpdatedBy(): ?int;
    public function setUpdatedBy(?int $updatedBy): void;

    public function getCreatedAt(): ?\DateTime;
    public function setCreatedAt(?\DateTime $createdAt): void;

    public function getUpdatedAt(): ?\DateTime;
    public function setUpdatedAt(?\DateTime $updatedAt): void;
}
