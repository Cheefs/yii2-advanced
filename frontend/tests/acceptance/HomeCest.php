<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->seeLink('My Application');
        $I->click('My Application');
        $I->pause(); // wait for page to be opened

        $I->see('Congratulations!');
    }
}
