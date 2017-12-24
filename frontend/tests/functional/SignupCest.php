<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class SignupCest
{
    protected $formId = '#form-signup';


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    public function signupWithEmptyFields(FunctionalTester $I)
    {
        $I->see('Signup', 'h1');
        $I->see('Please fill out the following fields to signup:');
        $I->submitForm($this->formId, []);
        $I->seeValidationError('Username cannot be blank.');
        $I->seeValidationError('Email cannot be blank.');
        $I->seeValidationError('Password cannot be blank.');

    }

    public function signupWithWrongEmail(FunctionalTester $I)
    {
        $I->submitForm(
            $this->formId, [
                'SignupForm[username]' => 'tester',
                'SignupForm[email]' => 'ttttt',
                'SignupForm[password]' => 'tester_password',
                'SignupForm[phone]' => '123',
                'SignupForm[born]' => '1996-01-01',
                'SignupForm[address]' => 'hanoi',
            ]
        );
        $I->dontSee('Username cannot be blank.', '.help-block');
        $I->dontSee('Password cannot be blank.', '.help-block');
        $I->see('Email is not a valid email address.', '.help-block');
    }

    public function signupSuccessfully(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'daiproxomhoa',
            'SignupForm[email]' => 'dai@gmail.com',
            'SignupForm[password]' => 'dsadsa',
            'SignupForm[phone]' => '123',
            'SignupForm[born]' => '1996-01-01',
            'SignupForm[address]' => 'hanoi',
        ]);

        $I->seeRecord('common\models\User', [
            'username' => 'daiproxomhoa',
            'email' => 'dai@gmail.com',
        ]);

        $I->see('Logout (daiproxomhoa)', 'form button[type=submit]');
    }
}
