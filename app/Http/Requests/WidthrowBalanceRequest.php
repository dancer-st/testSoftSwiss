<?php

namespace App\Http\Requests;

use App\Models\User;

class WidthrowBalanceRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currentBalance = 0;
        $user = User::find($this->get('user'));
        if ($user) {
            $currentBalance = $user->balance;
        }

        return [
            'user' => 'required|exists:users,id',
            'amount' => 'required|integer|min:0|max:'.$currentBalance,
        ];
    }
}