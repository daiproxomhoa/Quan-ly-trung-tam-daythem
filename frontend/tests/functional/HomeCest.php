<?php

namespace frontend\tests\functional;

use frontend\tests\FunctionalTester;

class HomeCest
{
    public function checkOpen(FunctionalTester $I)
    {
        $I->amOnPage(\Yii::$app->homeUrl);
        $I->see('My Company');
        $I->seeLink('Đăng kí');
        $I->click('Đăng kí');
        $I->see('Please fill out the following fields to signup:');
        $I->see('');
    }
}