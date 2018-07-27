<?php
$title = '{{%Mailing%}}';
$active = 'mailing';
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a></li>
            <li class="active">{{%Edit module%}} &laquo;{{%Mailing%}}&raquo;</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$title?></h1>

            <div class="panel-body">

                <div class="bloq_descr">{{%show description%}}</div>

                <blockquote>
                    {{%Here you can choose a type for mailing%}}
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

                <form role="form" action="/mailing/back" method="post">
                    <fieldset>
                        <div class="form-group">
                            <label><?=$model->labels('mailType')?></label>
                            <select class="form-control" name="<?=$model->names('mailType')?>">
                                <option value="mail">mail</option>
                            </select>
                            <?php if ($model->errors('mailType')) : ?>
                                <div class="color-red"><?=($model->errors('mailType'))?></div>
                            <?php endif; ?>
                        </div>

                        <button class="btn btn-primary" name="submit">{{%Save%}}</button>
                    </fieldset>
                </form>
            </div>
        </div>

    </div><!--/.row-->
</div>	<!--/.main-->
