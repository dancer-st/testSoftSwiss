<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetBalanceRequest;
use App\Http\Requests\DepositBalanceRequest;
use App\Http\Requests\TransferBalanceRequest;
use App\Http\Requests\WidthrowBalanceRequest;
use App\Models\User;
use App\Services\Balance\BalanceService;

class BalanceController extends Controller
{
    public function balance(GetBalanceRequest $getBalanceRequest)
    {
         return response()->json(User::find($getBalanceRequest->get('user')));
    }

    public function deposit(DepositBalanceRequest $depositBalanceRequestt, BalanceService $balanceService)
    {
        $balanceService->depositUserBalance(
            $depositBalanceRequestt->get('user'),
            $depositBalanceRequestt->get('amount')
        );

        return response()->json();
    }

    public function withdraw(WidthrowBalanceRequest $widthrowBalanceRequest, BalanceService $balanceService)
    {
        $balanceService->withdrawUserBalance(
            $widthrowBalanceRequest->get('user'),
            $widthrowBalanceRequest->get('amount')
        );

        return response()->json();
    }

    public function transfer(TransferBalanceRequest $transferBalanceRequest, BalanceService $balanceService)
    {
        $balanceService->transfer(
            $transferBalanceRequest->get('from'),
            $transferBalanceRequest->get('to'),
            $transferBalanceRequest->get('amount')
        );

        return response()->json();
    }
}