<?php
$title = '{{%Admin area%}}';
$active = 'admin';
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a></li>
            <li class="active">{{%Edit module%}} &laquo;<?=$title?>&raquo;</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$title?></h1>

            <div class="panel-body">

                <div class="bloq_descr">{{%show description%}}</div>

                <blockquote>
                    {{%Here you can change username and password for the admin of your site%}}
                </blockquote>

                <p><?=$model->labels('last_login')?>: <?=$model->values('last_login') == '' ? '{{%no data%}}' : date('d-m-Y H:i:s', $model->values('last_login'))?></p>

                <?php if ($success !== null) : ?>
                    <div>
                        <?php if ($success === false) : ?>
                            <div class="alert bg-danger">{{%Errors appeared while saving!%}}</div>
                        <?php else : ?>
                            <div class="alert bg-success">
                                <svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg>
                                {{%Settings was saved successfully!%}}
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <form role="form" action="/admin/back" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label><?=$model->labels('login')?></label>
                            <input class="form-control" placeholder="<?=($model->labels('login'))?>" name="<?=$model->names('login')?>" type="text" value="<?=$model->values('login')?>">
                            <?php if ($model->errors('login')) : ?>
                                <div class="color-red"><?=($model->errors('login'))?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label><?=$model->labels('password')?></label>
                            <input class="form-control" placeholder="<?=($model->labels('password'))?>" name="<?=$model->names('password')?>" type="password" value="">
                            <?php if ($model->errors('password')) : ?>
                                <div class="color-red"><?=($model->errors('password'))?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label><?=$model->labels('password_repeat')?></label>
                            <input class="form-control" placeholder="<?=($model->labels('password_repeat'))?>" name="<?=$model->names('password_repeat')?>" type="password" value="">
                            <?php if ($model->errors('password_repeat')) : ?>
                                <div class="color-red"><?=($model->errors('password_repeat'))?></div>
                            <?php endif; ?>
                        </div>
                        <button class="btn btn-primary" name="submit">{{%Save%}}</button>
                    </fieldset>
                </form>
            </div>
        </div>

    </div><!--/.row-->
</div>	<!--/.main-->
