<?php

namespace app\models;

use Yii;

class ModelCalendar extends \yii\base\Model
{
    public $id;
    public $title;
    public $start;
    public $end;
    public $color;
    public $allDay;


    public function __construct()
    {
    }


}
