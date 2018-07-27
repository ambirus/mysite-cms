<?php
$title = '{{%Common information%}}';
$active = 'dashboard';

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a></li>
            <li class="active"><?=$title?></li>
</ol>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?=$title?></h1>
        <h3>{{%Installed modules%}}</h3>

        <div class="panel-body">
            <?php if ($success !== null) : ?>
                <div>
                    <?php if ($success === false) : ?>
                        <div class="error">{{%Errors appeared while saving!%}}</div>
                        <?php if ($model->errors('success')) : ?>
                            <div class="alert bg-danger">
                                <svg class="glyph stroked cancel"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-cancel"></use></svg>
                                <?=($model->errors('success'))?>
                            </div>
                        <?php endif; ?>
                    <?php else : ?>
                        <div class="alert bg-success">
                            <svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg>
                            {{%Changes was performed successfully!%}}
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (sizeof($modules) > 0) : ?>
            <form action="/admin/index" method="post">

                <div class="pull-left">
                    <p class="bg-danger">{{%Caution! All data of the module will be deleted while installing!%}}</p>
                </div>
                <div class="pull-right">
                    <p>
                        <button class="btn btn-primary" name="submit">{{%Save%}}</button>
                    </p>
                </div>

                <table data-toggle="table" class="table table-hover">
                    <thead>
                    <tr>
                        <th style="">
                            <div class="th-inner ">{{%Module%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner ">{{%Description%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner ">{{%Installed%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner ">{{%Active%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($modules as $alias => $module) : ?>
                                <?php
                                    $config = $module->config();
                                ?>
                                <tr>
                                    <td><?=$alias?></td>
                                    <td><?=$config['name']?></td>
                                    <td><input type="checkbox" value="<?=$alias?>" name="<?=$model->names('installed')?>[]" <?=$config['installed'] == 1 ? 'checked' : ''?>  <?=isset($config['disabled']) && $config['disabled'] == 1 ? 'disabled' : ''?>/></td>
                                    <td><input type="checkbox" value="<?=$alias?>" name="<?=$model->names('state')?>[]" <?=$config['state'] == 1 ? 'checked' : ''?> <?=isset($config['disabled']) && $config['disabled'] == 1 ? 'disabled' : ''?>/></td>
                                    <td>
                                        <?php if ($config['installed'] == 1) : ?>
                                        <a href="/<?=$alias?>/back" title="{{%edit%}}"><div class="actions action_update"></div></a>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>

            </form>
            <?php else : ?>
                <p>{{%No module installed!%}}</p>
            <?php endif; ?>
        </div>

    </div>
</div><!--/.row-->
</div>	<!--/.main-->