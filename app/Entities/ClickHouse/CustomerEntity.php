<?php

namespace App\Entities\ClickHouse;

final class CustomerEntity extends BaseEntity
{
    /**
     * @var int
     */
    private int $version;

    /**
     * @param  int  $version
     * @return void
     */
    public function setVersion(int $version): void
    {
        $this->version = $version;
    }

    /**
     * @return array<string, mixed>
     */
    public function toRecord(): array
    {
        return array_merge(parent::toRecord(), [
            'version' => $this->version,
        ]);
    }
}
