<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;

class Abc extends Component
{
    public $letters;

    public function mount()
    {
        $this->letters = 'АБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЫЭЮЯ';
    }

    public function render()
    {
        return view('livewire.company.abc');
    }
}


/**



    2. с карты элементы управления лучше убрать совсем
    3. текст на фоне карты лучше сделать не выделяемым на мой взгляд - я вообще стараюсь
    всегда сам и своих ребят учил элементы интерфейсные типа кнопок, надписей вот таких
    как поверх карты делать user-select: none;
    4. моменты мелочные по выравниванию есть, сейчас скрины пришлю
    5. такие вещи на JS типа переключателей табов, инпутмаск  и тд тоже было бы круто уже
    с версткой получать, тоже на скринах

 *
 */
