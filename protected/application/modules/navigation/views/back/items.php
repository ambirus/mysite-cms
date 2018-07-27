<?php

$title = '{{%Navigation%}}';
$active = 'navigation';
$items = $model->values();

?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a></li>
            <li><a href="/navigation/back/index"><?=$title?></a></li>
            <li class="active">{{%Edit menu elements%}}<?=' &laquo;' . $items['menu'] . '&raquo;'?></li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$title?></h1>
            <h3>{{%Edit menu elements%}} &laquo;<?=$items['menu']?>&raquo;</h3>
            <div class="panel-body">

                <?php if ($success !== null) : ?>
                    <div>
                        <?php if ($success === false) : ?>
                            <div class="alert bg-danger">{{%Errors appeared while saving!%}}</div>
                        <?php else : ?>
                            <div class="alert bg-success">
                                <svg class="glyph stroked checkmark"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-checkmark"></use></svg>
                                {{%Menu elements was saved successfully!%}}
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <form action="/navigation/back/items/menuid=<?=$menuid?>" method="post">

                    <input type="hidden" name="<?=$model->names('alias')?>" value="<?=$menuid?>">
                    <div class="pull-right">
                        <p>
                            <button class="btn btn-primary" name="submit">{{%Save%}}</button>
                        </p>
                    </div>
                    <?php if ($menuid == 'admin') : ?>
                        <table data-toggle="table" class="table table-hover">
                            <thead>
                            <tr>
                                <th style="">
                                    <div class="th-inner ">{{%Title%}}</div>
                                    <div class="fht-cell"></div>
                                </th>
                                <th style="">
                                    <div class="th-inner ">{{%Order%}}</div>
                                    <div class="fht-cell"></div>
                                </th>
                                <th style="">
                                    <div class="th-inner ">{{%Active%}}</div>
                                    <div class="fht-cell"></div>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($items['items'])) : ?>
                                <?php foreach ($items['items'] as $id => $item) : ?>
                                    <tr>
                                        <td><?=$item['title']?></td>
                                        <td>
                                            <div class="form-group">
                                                <select name="<?=$model->names('order_num')?>[<?=$id?>]" class="form-control">
                                                    <?php for ($i = 0; $i < 26; $i++) : ?>
                                                        <option value="<?=$i?>" <?=$item['order_num'] == $i ? 'selected' : ''?>><?=$i?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group" <?=($item['alias'] == 'dashboard') ? 'style="display: none"' : ''?>>
                                                <input type="checkbox" value="<?=$id?>" name="<?=$model->names('state')?>[]" <?=$item['state'] == 1 ? 'checked' : ''?>/>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    <?php else: ?>

                        <div>
                            <div class="action_create_block">
                                <a href="/navigation/back/itemsCreate" title="{{%create menu element%}}">
                                    <div class="actions action_create"></div>
                                </a>
                                <a href="/navigation/back/itemsCreate">{{%create menu element%}}</a>
                                <div class="clear"></div>
                            </div>
                        </div>

                        <table data-toggle="table" class="table table-hover">
                            <thead>
                            <tr>
                                <th style="">
                                    <div class="th-inner ">{{%Title%}}</div>
                                    <div class="fht-cell"></div>
                                </th>
                                <th style="">
                                    <div class="th-inner ">{{%Url%}}</div>
                                    <div class="fht-cell"></div>
                                </th>
                                <th style="">
                                    <div class="th-inner ">{{%Order%}}</div>
                                    <div class="fht-cell"></div>
                                </th>
                                <th style="">
                                    <div class="th-inner ">{{%Active%}}</div>
                                    <div class="fht-cell"></div>
                                </th>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($items['items'])) : ?>
                            <?php foreach ($items['items'] as $id => $item) : ?>
                                <tr>
                                    <td><?=$item['title']?></td>
                                    <td><?=$item['url']?></td>
                                    <td>
                                        <div class="form-group">
                                            <select name="<?=$model->names('order_num')?>[<?=$id?>]" class="form-control">
                                                <?php for ($i = 0; $i < 26; $i++) : ?>
                                                    <option value="<?=$i?>" <?=$item['order_num'] == $i ? 'selected' : ''?>><?=$i?></option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="checkbox" value="<?=$id?>" name="<?=$model->names('state')?>[]" <?=$item['state'] == 1 ? 'checked' : ''?>/>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="actions_block">
                                            <a href="/navigation/back/itemsUpdate/id=<?=$id?>" title="{{%edit%}}"><div class="actions action_update"></div></a>
                                            <a class="delete-item" href="/navigation/back/itemsDelete/id=<?=$id?>" title="{{%delete%}}"><div class="actions action_delete"></div></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>

                </form>

            </div>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->