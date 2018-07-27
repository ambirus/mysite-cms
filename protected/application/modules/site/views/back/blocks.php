<?php
$title = '{{%Site%}}';
$active = 'site';
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a></li>
            <li><a href="/site/back">{{%Edit module%}} &laquo;<?=$title?>&raquo;</a></li>
            <li class="active">{{%Site text blocks%}}</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$title?></h1>

            <div class="panel-body">

                <div class="bloq_descr">{{%show description%}}</div>

                <blockquote>
                    {{%Here you can change texts and content of the text blocks%}}
                </blockquote>
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

                <form role="form" action="/site/back/blocks" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label><?=$model->labels('header')?></label> | <span class="showMore">&#9650;</span>
                            <div>
                                <textarea id="header" rows="10" cols="80" class="form-control" name="<?=$model->names('header')?>">
                                    <?=$model->values('header')?>
                                </textarea>
                            </div>
                            <script>
                                CKEDITOR.replace( 'header' );
                            </script>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('logo')?></label> | <span class="showMore">&#9660;</span>
                            <div class="hidden">
                                <textarea id="logo" rows="10" cols="80" class="form-control" name="<?=$model->names('logo')?>">
                                    <?=$model->values('logo')?>
                                </textarea>
                            </div>
                            <script>
                                CKEDITOR.replace( 'logo' );
                            </script>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('google')?></label> | <span class="showMore">&#9660;</span>
                            <div class="hidden">
                                <textarea id="google" rows="10" cols="80" class="form-control" name="<?=$model->names('google')?>">
                                    <?=$model->values('google')?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('links')?></label> | <span class="showMore">&#9660;</span>
                            <div class="hidden">
                                <textarea id="links" rows="10" cols="80" class="form-control" name="<?=$model->names('links')?>">
                                    <?=$model->values('links')?>
                                </textarea>
                            </div>
                            <script>
                                CKEDITOR.replace( 'links' );
                            </script>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('yandex')?></label> | <span class="showMore">&#9660;</span>
                            <div class="hidden">
                                <textarea id="yandex" rows="10" cols="80" class="form-control" name="<?=$model->names('yandex')?>">
                                    <?=$model->values('yandex')?>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label><?=$model->labels('footer')?></label> | <span class="showMore">&#9660;</span>
                            <div class="hidden">
                                <textarea id="footer" rows="10" cols="80" class="form-control" name="<?=$model->names('footer')?>">
                                    <?=$model->values('footer')?>
                                </textarea>
                            </div>
                            <script>
                                CKEDITOR.replace( 'footer' );
                            </script>
                        </div>

                        <button class="btn btn-primary" name="submit">{{%Save%}}</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->
