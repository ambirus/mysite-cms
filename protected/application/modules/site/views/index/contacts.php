<?php
$title = '{{%Contacts%}}';
$keywords = '';
$description = '';
?>

<div class="docs-content-full">
    <h2><?= $title ?></h2>
    <div>
        <?php if ($success !== null) : ?>
            <div class="alert">
                <?php if ($success === false) : ?>
                    <div class="error">
                        {{%Errors appeared while sending your message!%}}
                        <?php if ($model->errors('success') !== null) : ?>
                            <p><i>{{%Cannot send your message! Try it again later!%}}</i></p>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <div class="success">{{%Your message was sent successfully!%}}</div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <blockquote>{{%To communicate with us please fill up the form below and press "Send" button%}}</blockquote>

        <form id="contactsForm" method="post">
            <table id="contacts">
                <tr>
                    <td><?= ($model->labels('name')) ?></td>
                    <td>
                        <input type="text" name="<?= $model->names('name') ?>" value="<?= $model->values('name') ?>">
                        <div class="error"><?= ($model->errors('name')) ?></div>
                    </td>
                </tr>
                <tr>
                    <td><?= ($model->labels('email')) ?></td>
                    <td>
                        <input type="text" name="<?= $model->names('email') ?>" value="<?= $model->values('email') ?>">
                        <div class="error"><?= ($model->errors('email')) ?></div>
                    </td>
                </tr>
                <tr>
                    <td><?= ($model->labels('message')) ?></td>
                    <td>
                        <textarea name="<?= $model->names('message') ?>"
                                  rows="10"><?= $model->values('message') ?></textarea>
                        <div class="error"><?= ($model->errors('message')) ?></div>
                    </td>
                </tr>
                <tr>
                    <td><?= ($model->labels('captcha')) ?></td>
                    <td>
                        <input type="text" name="<?= $model->names('captcha') ?>"
                               value="<?= $model->values('captcha') ?>">
                        <div class="error"><?= ($model->errors('captcha')) ?></div>
                        <div id="captcha"><img src="/site/index/captcha" alt=""></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <table class="agree">
                            <tr>
                                <td><input type="checkbox" name="<?= $model->names('agreed') ?>" value="1"></td>
                                <td>
                                    <small><?= ($model->labels('agreed')) ?></small>
                                </td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td>
                                    <div class="error"><?= ($model->errors('agreed')) ?></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="send" value="{{%Send%}}"></td>
                </tr>
            </table>
        </form>

    </div>
</div>