<?php

namespace App\Http\Requests;

use App\Models\User;

class TransferBalanceRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currentBalance = 0;
        $fromUser = User::find($this->get('from'));
        if ($fromUser) {
            $currentBalance = $fromUser->balance;
        }

        return [
            'from' => 'required|exists:users,id',
            'to' => 'required|exists:users,id',
            'amount' => 'required|integer|min:0|max:'.$currentBalance,
        ];
    }
}