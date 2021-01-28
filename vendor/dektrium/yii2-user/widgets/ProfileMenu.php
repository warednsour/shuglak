<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace dektrium\user\widgets;

use yii\widgets\Menu;
use Yii;
use yii\base\Widget;
use dektrium\user\controllers\ProfileController;
/**
 * User menu widget.
 */
class ProfileMenu extends Widget
{

    /** @array \dektrium\user\models\RegistrationForm */
    public $items;

    public function init()
    {
        parent::init();
        

        $this->items = [
            ['label' => Yii::t('user', 'Jobs by user'), 'url' => ['/user/profile/jobs']],
            ['label' => Yii::t('user', 'Bid the user made' . $data['bidOfUser']), 'url' => ['/user/profile/bids'.'?id=']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => $this->items,
        ]);
    }
   
}
