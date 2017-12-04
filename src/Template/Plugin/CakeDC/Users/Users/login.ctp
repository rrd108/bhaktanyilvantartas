<?php
/**
 * Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2017, Cake Development Corporation (https://www.cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

use Cake\Core\Configure;
echo $this->Html->script('users.login.min.js', ['block' => true]);
?>
<div class="column entrance">
    <div class="row align-center">
        <div class="column small-3 align-self-middle" id="logo"><?= $this->Html->image('logo.png') ?></div>
        <div class="column small-5 users form login">
            <?= $this->Flash->render('auth') ?>
            <?= $this->Form->create() ?>
            <fieldset class="fieldset">
                <legend><?= __d('CakeDC/Users', 'Please enter your username and password') ?></legend>
                <?= $this->Form->control('email', ['required' => true]) ?>
                <?= $this->Form->control('password', ['required' => true]) ?>
                <?php
                if (Configure::read('Users.reCaptcha.login')) {
                    echo $this->User->addReCaptcha();
                }
                if (Configure::read('Users.RememberMe.active')) {
                    echo $this->Form->control(Configure::read('Users.Key.Data.rememberMe'), [
                        'type' => 'checkbox',
                        'label' => __d('CakeDC/Users', 'Remember me'),
                        'checked' => Configure::read('Users.RememberMe.checked')
                    ]);
                }
                ?>
                <?php
                $registrationActive = Configure::read('Users.Registration.active');
                if ($registrationActive) {
                    echo $this->Html->link(__d('CakeDC/Users', 'Register'), ['action' => 'register']);
                }
                if (Configure::read('Users.Email.required')) {
                    if ($registrationActive) {
                        echo ' | ';
                    }
                    echo $this->Html->link(__d('CakeDC/Users', 'Reset Password'), ['action' => 'requestResetPassword']);
                }
                ?>
            </fieldset>
            <?= implode(' ', $this->User->socialLoginList()); ?>
            <?= $this->Form->button(__d('CakeDC/Users', 'Login'), ['class' => 'button']); ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
