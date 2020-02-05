<?php


namespace frontend\common\behaviors;

use yii\base\Behavior;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\Controller;
use common\helpers\HistoryHelper;

/**
 * @property string $key
 * @property array $actions
 * @property int $rememberCount
 *
 * @property array $history
*/
class HistoryBehavior extends Behavior
{
    public $key;
    public $actions;
    public $rememberCount;

    private $history;

    public function events() {
        return [
            Controller::EVENT_AFTER_ACTION => 'setHistory'
        ];
    }

    /**
     * Сохраняем последнюю просмотренную страницу
    */
     public function setHistory() {
         /** @var $owner Controller */
         $owner = $this->owner;
         $action = $owner->action->id;


         if ( ArrayHelper::isIn($action, $this->actions) ) {
             $paramId = $owner->actionParams['id'];

             $this->history = HistoryHelper::getHistory( $this->key );
             if ( ArrayHelper::isTraversable( $this->history ) && count ( $this->history ) > $this->rememberCount ) {
                 $paramId = $owner->actionParams['id'];

                 array_shift(  $this->history  );
             }

             if ( !$this->isLastPageIsSame( $paramId, $this->history ?? [] ) ) {
                 $this->history[] = [
                     'id' => $paramId,
                     'url' => Url::to( $owner->actionParams )
                 ];
             }
             HistoryHelper::saveHistory( $this->key, $this->history );
         }
     }

     /**
      * Проверка что пред идущая страница не была такой же ( сперва хотел хранить уникальные страници, но подумал что для истории такой подход лучше)
      * @param array $array
      * @param int $id
      * @return bool
      */
     private function isLastPageIsSame(int $id, array $array ) {
        return $array[ count( $array ) - 1] ['id'] == $id;
     }
}