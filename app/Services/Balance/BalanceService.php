<?php

namespace App\Services\Balance;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class BalanceService
{
    /** deposit money
     * @param int $userId
     * @param int $amount
     */
    public function depositUserBalance(int $userId, int $amount)
    {
        DB::transaction(function () use ($userId, $amount) {

            try {
                User::firstOrCreate(array('id' =>$userId));
            } catch (QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if($errorCode != 1062){ // 1062 - Duplicate Entry
                    throw $e;
                }
            }

            $user = User::find($userId);
            if (!$user) {
                throw new BalanceException('Can not crate user');
            }

            $user->increment('balance', $amount);
            if (!$user->save()) {
                throw new BalanceException("Can not save user");
            }
        });
    }

    /**
     * withdraw money
     * @param int $userId
     * @param int $amount
     * @throws BalanceException
     */
    public function withdrawUserBalance(int $userId, int $amount)
    {
        $user = User::find($userId);
        if (!$user) {
            throw new BalanceException("Can not find user with id $userId");
        }

        $user->decrement('balance', $amount);

        if (!$user->save()) {
            throw new BalanceException("Can not save user");
        }
    }

    /**
     * transfer money
     * @param int $fromId
     * @param int $toId
     * @param int $amount
     */
    public function transfer(int $fromId, int $toId, int $amount)
    {
        DB::transaction(function () use ($fromId, $toId, $amount) {
            $from = User::find($fromId);
            $to = User::find($toId);
            if (!$from || !$to) {
                throw new BalanceException("Can not find from user $fromId or to user $toId");
            }
            $from->decrement('balance', $amount);
            $to->increment('balance', $amount);

            if (!$from->save()) {
                throw new BalanceException("Can not save from user");
            }
            if (!$to->save()) {
                throw new BalanceException("Can not save to user");
            }
        });
    }
}