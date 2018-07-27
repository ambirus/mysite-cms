<?php
use src\managers\AssetManager;

$title = '{{%Site%}}';
$active = 'site';
$langs = \src\I18n::get();
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
                    {{%Here you can change some settings of your site%}}
                </blockquote>

                <div>
                    <div class="action_create_block">
                        <a href="/site/back/blocks" title="{{%edit site text blocks%}}">
                            <div class="actions action_update"></div>
                        </a>
                        <a href="/site/back/blocks">{{%edit site text blocks%}}</a>
                        <div class="clear"></div>
                    </div>
                </div>

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

                <form role="form" action="/site/back" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label><?=$model->labels('appName')?></label>
                            <input class="form-control" placeholder="<?=$model->labels('appName')?>" name="<?=$model->names('appName')?>" value="<?=$model->values('appName')?>">
                            <?php if ($model->errors('appName')) : ?>
                                <div class="color-red"><?=$model->errors('appName')?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('theme')?></label>
                            <select name="<?=$model->names('theme')?>" class="form-control">
                                <optgroup label="{{%By default%}}">
                                    <option value="blue" <?=$model->values('theme') == 'blue' ? 'selected'  : ''?>>{{%Blue%}}</option>
                                    <option value="green" <?=$model->values('theme') == 'green' ? 'selected'  : ''?>>{{%Green%}}</option>
                                    <option value="orange" <?=$model->values('theme') == 'orange' ? 'selected'  : ''?>>{{%Orange%}}</option>
                                </optgroup>
                                <?php if ($themes = AssetManager::getThemes()) : ?>
                                <optgroup label="{{%Others%}}">
                                    <?php foreach ($themes as $k => $theme) : ?>
                                    <option value="<?=$k?>" <?=$model->values('theme') == $k ? 'selected'  : ''?>><?=$theme?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('mail')?></label>
                            <input class="form-control" placeholder="<?=$model->labels('mail')?>" name="<?=$model->names('mail')?>" value="<?=$model->values('mail')?>">
                            <?php if ($model->errors('mail')) : ?>
                                <div class="color-red"><?=$model->errors('mail')?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('mainPage')?></label>
                            <select name="<?=$model->names('mainPage')?>" class="form-control">
                                <option value="0">{{%choose an option%}}</option>
                                <?php foreach ($pages['items'] as $k => $page) : ?>
                                    <option value="<?=$k?>" <?=$model->values('mainPage') == $k ? 'selected' : ''?>><?=$page['title']?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ($model->errors('mainPage')) : ?>
                                <div class="color-red"><?=$model->errors('mainPage')?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('captcha')?></label>
                            <select name="<?=$model->names('captcha')?>" class="form-control">
                                <option value="0" <?=$model->values('captcha') == '0' ? 'selected'  : ''?>>{{%no%}}</option>
                                <option value="1" <?=$model->values('captcha') == '1' ? 'selected'  : ''?>>{{%yes%}}</option>
                            </select>
                        </div>

                        <button class="btn btn-primary" name="submit">{{%Save%}}</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->