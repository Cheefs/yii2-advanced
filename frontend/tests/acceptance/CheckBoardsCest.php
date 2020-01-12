<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class CheckBoardsCest
{
    // tests
    public function checkBoards(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));
        $I->see('My Application');

        $I->seeLink('Boards');
        $I->click('Boards');
        $I->pause(); // wait for page to be opened

        $I->see('Create New Board');
    }

    public function checkBoardsCreate(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/boards'));

        $I->seeLink('Create New Board');
        $I->click('Create New Board');
        $I->pause(); // wait for page to be opened

        $I->see('Create Board Form');
    }
}
