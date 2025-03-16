<?php

use Illuminate\Support\Facades\Route;

Route::namespace('User\Auth')->name('user.')->middleware('guest')->group(function () {
    Route::controller('LoginController')->group(function () {
        Route::get('/login', 'showLoginForm')->name('login');
        Route::post('/login', 'login');
        Route::get('logout', 'logout')->middleware('auth')->withoutMiddleware('guest')->name('logout');
    });

    Route::controller('RegisterController')->group(function () {
        Route::get('register', 'showRegistrationForm')->name('register');
        Route::post('register', 'register');
        Route::post('check-user', 'checkUser')->name('checkUser')->withoutMiddleware('guest');
    });

    Route::controller('ForgotPasswordController')->prefix('password')->name('password.')->group(function () {
        Route::get('reset', 'showLinkRequestForm')->name('request');
        Route::post('email', 'sendResetCodeEmail')->name('email');
        Route::get('code-verify', 'codeVerify')->name('code.verify');
        Route::post('verify-code', 'verifyCode')->name('verify.code');
    });

    Route::controller('ResetPasswordController')->group(function () {
        Route::post('password/reset', 'reset')->name('password.update');
        Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    });

    Route::controller('SocialiteController')->group(function () {
        Route::get('social-login/{provider}', 'socialLogin')->name('social.login');
        Route::get('social-login/callback/{provider}', 'callback')->name('social.login.callback');
    });
});

Route::middleware('auth')->name('user.')->group(function () {

    Route::get('user-data', 'User\UserController@userData')->name('data');
    Route::post('user-data-submit', 'User\UserController@userDataSubmit')->name('data.submit');

    //authorization
    Route::middleware('registration.complete')->namespace('User')->controller('AuthorizationController')->group(function () {
        Route::get('authorization', 'authorizeForm')->name('authorization');
        Route::get('resend-verify/{type}', 'sendVerifyCode')->name('send.verify.code');
        Route::post('verify-email', 'emailVerification')->name('verify.email');
        Route::post('verify-mobile', 'mobileVerification')->name('verify.mobile');
        Route::post('verify-g2fa', 'g2faVerification')->name('2fa.verify');
    });

    Route::middleware(['check.status', 'registration.complete'])->group(function () {

        Route::namespace('User')->group(function () {

            Route::controller('UserController')->group(function () {
                Route::get('dashboard', 'home')->name('home');
                Route::get('download-attachments/{file_hash}', 'downloadAttachment')->name('download.attachment');

                //2FA
                Route::get('twofactor', 'show2faForm')->name('twofactor');
                Route::post('twofactor/enable', 'create2fa')->name('twofactor.enable');
                Route::post('twofactor/disable', 'disable2fa')->name('twofactor.disable');

                //KYC
                Route::get('kyc-form', 'kycForm')->name('kyc.form');
                Route::get('kyc-data', 'kycData')->name('kyc.data');
                Route::post('kyc-submit', 'kycSubmit')->name('kyc.submit');

                //Report
                Route::any('deposit/history', 'depositHistory')->name('deposit.history');
                Route::get('transactions', 'transactions')->name('transactions');

                Route::post('add-device-token', 'addDeviceToken')->name('add.device.token');
            });

            //Profile setting
            Route::controller('ProfileController')->group(function () {
                Route::get('profile-setting', 'profile')->name('profile.setting');
                Route::post('profile-setting', 'submitProfile');
                Route::get('change-password', 'changePassword')->name('change.password');
                Route::post('change-password', 'submitPassword');
            });

            // Withdraw
            Route::controller('WithdrawController')->prefix('withdraw')->name('withdraw')->group(function () {
                Route::middleware('kyc')->group(function () {
                    Route::get('/', 'withdrawMoney')->name('.index');
                    Route::post('/', 'withdrawStore')->name('.money');
                    Route::get('preview', 'withdrawPreview')->name('.preview');
                    Route::post('preview', 'withdrawSubmit')->name('.submit');
                });
                Route::get('history', 'withdrawLog')->name('.history');
            });

            Route::controller('UserPlanController')->group(function () {
                Route::get('/insurance-info/{id?}', 'showInsuranceInfo')->name('insurance.info');
                Route::post('/store-insurance-info/{id?}', 'storeInsuranceInfo')->name('store.insurance.info');
                Route::get('/user-info/{id?}', 'showUserInfo')->name('info');
                Route::post('/store-user-info/{id?}', 'storeUserInfo')->name('store.info');
                Route::get('/spouse-info/{id?}', 'showSpouseInfo')->name('spouse.info');
                Route::post('/store-spouse-info/{id?}', 'storeSpouseInfo')->name('store.spouse.info');
                Route::get('/nominee-info/{id?}', 'showNomineeInfo')->name('nominee.info');
                Route::post('/store-nominee-info/{id?}', 'storeNomineeInfo')->name('store.nominee.info');
                Route::get('/declaration/{id?}', 'showDeclaration')->name('declaration');
                Route::get('/payment-info/{id}', 'showPaymentInfo')->name('payment.info');
                Route::post('/store-payment-info', 'storePaymentInfo')->name('store.payment.info');
                Route::get('/payment-success/{id}', 'paymentSuccess')->name('payment.success');
                Route::get('insurance-download/{id}', 'insuranceDownload')->name('insurance.download');
            });

            Route::controller('UserPolicyController')->group(function () {
                Route::get('policy-list', 'policyList')->name('policy.list');
                Route::get('policy-details/{id}', 'policyDetails')->name('policy.details');
                Route::get('policy-download/{id}', 'policyDownload')->name('policy.download');
                Route::get('claim-list', 'claimList')->name('claim.list');
                Route::get('claim-details/{id}', 'claimDetails')->name('claim.details');
                Route::get('claim-download/{id}', 'claimDownload')->name('claim.download');
            });

            Route::controller('UserPolicyClaimController')->name('claim.insurance.')->prefix('claim-insurance')->group(function () {

                Route::get('request/{id?}', 'claimInsuranceRequest')->name('request');
                Route::post('request-submit/{id?}', 'claimRequestSubmit')->name('request.submit');
                Route::get('accident-details/{id?}', 'accidentDetails')->name('accident.details');
                Route::post('accident-details-submit/{id}', 'accidentDetailsSubmit')->name('accident.details.submit');

                Route::get('details-review/{id?}', 'detailsReview')->name('details.review');
                Route::post('confirm-submit/{id?}', 'confirmSubmit')->name('confirm.submit');
                Route::get('submit-successfull/{id}', 'submitSuccessfull')->name('submit.successfull');
                Route::get('download-file/{id}', 'downloadFile')->name('download.file');
                Route::get('claim-download/{id}', 'claimDownload')->name('pdf.download');
                Route::get('history', 'history')->name('history');
            });

            Route::controller('UserSettingController')->group(function () {
                Route::get('setting', 'setting')->name('setting');
                Route::post('setting', 'submitSetting');
                Route::get('notification', 'notificationSetting')->name('notification.setting');
                Route::post('notification', 'submitNotification');
                Route::get('privacy', 'privacy')->name('privacy.setting');
                Route::post('privacy', 'submitPrivacy');
                Route::get('support', 'support')->name('support.setting');
            });
        });

        // Payment
        Route::prefix('deposit')->name('deposit.')->controller('Gateway\PaymentController')->group(function () {
            Route::any('/', 'deposit')->name('index');
            Route::post('insert/{id?}', 'depositInsert')->name('insert');
            Route::get('confirm', 'depositConfirm')->name('confirm');
            Route::get('manual', 'manualDepositConfirm')->name('manual.confirm');
            Route::post('manual', 'manualDepositUpdate')->name('manual.update');
        });
    });
});
