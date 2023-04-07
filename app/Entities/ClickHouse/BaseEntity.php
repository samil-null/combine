<?php

namespace App\Entities\ClickHouse;

abstract class BaseEntity
{
    /**
     * @var string
     */
    private string $customerId;

    /**
     * @var array
     */
    private array $int = [];

    /**
     * @var array
     */
    private array $str = [];

    /**
     * @var array
     */
    private array $arrStr = [];

    /**
     * @var array
     */
    private array $arrInt = [];

    /**
     * @param string $customerId
     */
    public function setCustomerId(string $customerId): void
    {
        $this->customerId = $customerId;
    }

    /**
     * @param string $key
     * @param int $value
     * @return void
     */
    public function addInt(string $key, int $value): void
    {
        $this->int[$key] = $value;
    }

    /**
     * @param string $key
     * @param string $value
     * @return void
     */
    public function addStr(string $key, string $value): void
    {
        $this->str[$key] = $value;
    }

    /**
     * @param string $key
     * @param array $value
     * @return void
     */
    public function addArrStr(string $key, array $value): void
    {
        $this->arrStr[$key] = $value;
    }

    /**
     * @param string $key
     * @param array $value
     * @return void
     */
    public function addArrInt(string $key, array $value): void
    {
        $this->arrInt[$key] = $value;
    }

    /**
     * @return array
     */
    public function toRecord(): array
    {
        return [
            'customer_id' => $this->customerId,
            'int_d.keys' => array_keys($this->int),
            'int_d.values' => array_values($this->int),
            'str_d.keys' => array_keys($this->str),
            'str_d.values' => array_values($this->str),
            'arr_str_d.keys' => array_keys($this->arrStr),
            'arr_str_d.values' => array_values($this->arrStr),
            'arr_int_d.keys' => array_keys($this->arrInt),
        ];
    }
}
