<?php    
    use src\managers\ModuleManager;

    $title = '{{%Entering admin area%}} &mdash; ' . ModuleManager::get('site')->config()['appName'];

?>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading"><?='{{%Entering admin area%}}'?></div>
            <div class="panel-body">

                <?php if ($success !== null) : ?>
                    <div>
                        <?php if ($success === false) : ?>
                            <div class="alert bg-danger"><?='{{%Errors appeared while login%}}'?></div>
                            <?php if ($model->errors('success')) : ?>
                                <div class="color-red"><?=$model->errors('success')?></div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <form role="form" action="/admin/login" method="post">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="<?=($model->labels('login'))?>" name="<?=$model->names('login')?>" autofocus="" value="<?=$model->values('login')?>">
                            <?php if ($model->errors('login')) : ?>
                            <div class="color-red"><?=($model->errors('login'))?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="<?=$model->labels('password')?>" name="<?=$model->names('password')?>" type="password" value="">
                            <?php if ($model->errors('password')) : ?>
                            <div class="color-red"><?=$model->errors('password')?></div>
                            <?php endif; ?>
                        </div>
                        <?php if (ModuleManager::get('site')->config()['captcha'] == 1) : ?>
                        <div class="form-group">
                            <input class="form-control" placeholder="<?=$model->labels('captcha')?>" type="text" name="<?=$model->names('captcha')?>" value="">
                            <?php if ($model->errors('captcha')) : ?>
                                <div class="color-red"><?=$model->errors('captcha')?></div>
                            <?php endif; ?>
                            <br>
                            <div id="captcha"><img src="/site/index/captcha" alt=""></div>
                        </div>
                        <?php endif; ?>
                        <button class="btn btn-primary" name="submit"><?='{{%Enter%}}'?></button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div><!-- /.col-->
</div><!-- /.row -->