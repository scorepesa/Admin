<?php

namespace frontend\rbac;

use yii\rbac\Rule;

class CreateMpesaDeposit extends Rule {

    public $name = 'isMpesaDepositor';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params) {
        return true; //isset($params['post']) ? $params['post']->createdBy == $user : false;
    }

}
