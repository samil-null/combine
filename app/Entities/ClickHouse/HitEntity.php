<?php

namespace App\Entities\ClickHouse;

final class HitEntity extends BaseEntity
{
    /**
     * @var int
     */
    private int $eventId;

    /**
     * @param int $eventId
     */
    public function setEventId(int $eventId): void
    {
        $this->eventId = $eventId;
    }

    /**
     * @return array
     */
    public function toRecord(): array
    {
        return array_merge(parent::toRecord(), [
            'event_id' => $this->eventId,
        ]);
    }
}
