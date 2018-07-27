<?php
$title = '{{%Pages%}}';
$active = 'page';
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a></li>
            <li><a href="/page/back">{{%Edit module%}} &laquo;<?=$title?>&raquo;</a></li>
            <li class="active">{{%Creating a page%}}</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">

            <h1 class="page-header">{{%Creating a page%}}</h1>

            <div class="panel-body">

                <?php if ($success !== null) : ?>
                    <div>
                        <?php if ($success === false) : ?>
                            <div class="alert bg-danger">{{%Errors appeared while saving!%}}</div>
                            <?php if ($model->errors('success')) : ?>
                                <div class="alert bg-danger">
                                    <svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg>
                                    <?=($model->errors('success'))?>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="alert bg-success">
                                <svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg>
                                {{%Page was saved successfully!%}}
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <form role="form" action="/page/back/create" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label><?=$model->labels('title')?></label>
                            <input class="form-control" type="text" name="<?=$model->names('title')?>" autofocus="" value="<?=$model->values('title')?>">
                            <div class="color-red"><?=($model->errors('title'))?></div>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('body')?></label>
                            <textarea id="body" rows="10" cols="80" class="form-control" name="<?=$model->names('body')?>">
                                <?=$model->values('body')?>
                            </textarea>
                            <script>
                                CKEDITOR.replace( 'body' );
                            </script>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('keywords')?></label>
                            <textarea class="form-control" rows="3" name="<?=$model->names('keywords')?>"><?=$model->values('keywords')?></textarea>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('description')?></label>
                            <textarea class="form-control" rows="3" name="<?=$model->names('description')?>"><?=$model->values('description')?></textarea>
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


