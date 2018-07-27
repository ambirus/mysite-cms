<?php

use application\helpers\ModuleHelper;

$title = '{{%Navigation%}}';
$active = 'navigation';
$modules = ModuleHelper::get();

?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a></li>
            <li><a href="/navigation/back/index"><?=$title?></a></li>
            <li><a href="/navigation/pretty/index">{{%Edit short addresses%}}</a></li>
            <li class="active">{{%Create a new short address%}}</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header"><?=$title?></h1>
            <h3>{{%Create a new short address%}}</h3>
            <div class="panel-body">

                <?php if ($success !== null) : ?>
                    <div>
                        <?php if ($success === false) : ?>
                            <div class="alert bg-danger">{{%Errors appeared while saving!%}}</div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <form action="/navigation/pretty/create" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label><?=$model->labels('model')?></label>
                            <select name="<?=$model->names('model')?>" class="form-control">
                                <option value="">{{%choose an option%}}</option>
                                <?php foreach ($modules as $class => $module) : ?>
                                    <option id="model_<?=$module['alias']?>" <?=$model->values('model') == $class ? 'selected' : ''?> value="<?=$class?>"><?=$module['name']?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="color-red"><?=($model->errors('model'))?></div>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('modelItem')?></label>
                            <select name="<?=$model->names('modelItem')?>" class="form-control">
                                <option value="">{{%choose an option%}}</option>
                            </select>
                            <div class="color-red"></div>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('fullUrl')?></label>
                            <input class="form-control" type="text" name="<?=$model->names('fullUrl')?>" value="<?=$model->values('fullUrl')?>">
                            <div class="color-red"><?=($model->errors('fullUrl'))?></div>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('shortUrl')?></label>
                            <input class="form-control" type="text" name="<?=$model->names('shortUrl')?>" value="<?=$model->values('shortUrl')?>">
                            <div class="color-red"><?=($model->errors('shortUrl'))?></div>
                        </div>

                        <button class="btn btn-primary" name="submit">{{%Save%}}</button>
                    </fieldset>
                </form>
            </div>

        </div>
    </div><!--/.row-->
</div>	<!--/.main-->
