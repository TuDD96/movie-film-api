<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\League;

class CheckPreliminaryDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $league = League::select('end_datetime')->orderBy('end_datetime','desc')->where('event_id', $this->eventId)->first();
        if ($league) {
            if ($value <= $league->end_datetime) return false;
            return true;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'エントリー開始日時には、前回の予選ブロックの対戦終了日時より後の日付を指定してください。';
    }
}
