<?php

namespace App\Http\Livewire\Traits;

trait TrimStrings
{
    /**
     * @var string[]
     */
    protected $convertEmptyStringsExcept = [
        //
    ];

    /**
     * @param string $name
     * @param mixed $value
     */
    public function convertEmptyToNull(string $name, $value): void
    {
        if (!is_string($value) || in_array($name, $this->convertEmptyStringsExcept)) {
            return;
        }

        $value = preg_replace('/(\r\n|\n)+(?=(\r\n|\n){2,})/u', '', $value);
        $value = trim($value);
        $value = $value === '' ? null : $value;

        data_set($this, $name, $value);
    }

}
