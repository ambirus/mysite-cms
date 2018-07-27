<?php
$title = '{{%Navigation%}}';
$active = 'navigation';
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a></li>
            <li><a href="/navigation/back/index"><?=$title?></a></li>
            <li><a href="/navigation/back/items/menuid=main">{{%Edit menu elements%}}</a></li>
            <li class="active">{{%Create new menu element%}}</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header"><?=$title?></h1>
            <h3>{{%Create new menu element%}}</h3>
            <div class="panel-body">

                <?php if ($success !== null) : ?>
                    <div>
                        <?php if ($success === false) : ?>
                            <div class="alert bg-danger">{{%Errors appeared while saving!%}}</div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <form action="/navigation/back/itemsCreate" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label><?=$model->labels('title')?></label>
                            <input class="form-control" type="text" name="<?=$model->names('title')?>" autofocus="" value="<?=$model->values('title')?>">
                            <div class="color-red"><?=($model->errors('title'))?></div>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('url')?> <a href="/navigation/pretty/create">({{%create a short link%}})</a></label>
                            <input class="form-control" type="text" name="<?=$model->names('url')?>" value="<?=$model->values('url')?>">
                            <div class="color-red"><?=($model->errors('url'))?></div>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('order_num')?></label>
                            <select name="<?=$model->names('order_num')?>" class="form-control">
                                <?php for ($i = 0; $i < 26; $i++) : ?>
                                    <option value="<?=$i?>" <?=$model->values('order_num') == $i ? 'selected' : ''?>><?=$i?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('state')?></label>
                            <select class="form-control" name="<?=$model->names('state')?>">
                                <option value="0">{{%no%}}</option>
                                <option <?=$model->values('state') == 1 ? 'selected' : ''?> value="1">{{%yes%}}</option>
                            </select>
                        </div>

                        <button class="btn btn-primary" name="submit">{{%Save%}}</button>
                    </fieldset>
                </form>
            </div>

        </div>
    </div><!--/.row-->
</div>	<!--/.main-->
