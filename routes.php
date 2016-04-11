<?php

Route::get('ledger/{account_id}', function($account_id){

	$account = Wzulfikar\EloquentSimpleLedger\Account::findOrFail($account_id);

	if(\Request::ajax()){
		return $account->ledger()->get();
	}

	view()->addLocation(__DIR__ . '/views');

	return view('eloquent-simple-ledger.index', compact('account'));
});

Route::post('ledger/{account_id}', function($account_id){

	$account = Wzulfikar\EloquentSimpleLedger\Account::findOrFail($account_id);

	$amount = \Request::get('amount');
	$desc   = \Request::get('desc');
	$action = \Request::get('action'); // debit or credit

	return ['success'=>$account->$action($amount, $desc), 'msg'=>'debit success'];
});