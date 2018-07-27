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
            <li class="active">{{%Edit short addresses%}}</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?=$title?></h1>


            <div class="panel-body">

                <div class="bloq_descr">{{%show description%}}</div>

                <blockquote>
                    {{%Here you can assign short names for links of items in navigation menu%}}
                </blockquote>

                <h3>{{%Edit short addresses%}}</h3>

                <div>
                    <div class="action_create_block">
                        <a href="/navigation/pretty/create" title="{{%create short address%}}">
                            <div class="actions action_create"></div>
                        </a>
                        <a href="/navigation/pretty/create">{{%create short address%}}</a>
                        <div class="clear"></div>
                    </div>
                </div>

                <table data-toggle="table" class="table table-hover">
                    <thead>
                    <tr>
                        <th style="">
                            <div class="th-inner ">{{%Model%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner ">{{%Full address%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner ">{{%Short address%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner "></div>
                            <div class="fht-cell"></div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($model['total'] > 0) : ?>
                        <?php foreach ($model['items'] as $id => $item) : ?>
                            <tr>
                                <td><?=$modules[$item['model']]['name']?></td>
                                <td>
                                    <?=$item['fullUrl']?>
                                </td>
                                <td>
                                    <?=$item['shortUrl']?>
                                </td>
                                <td>
                                    <div class="actions_block">
                                        <a href="/navigation/pretty/update/id=<?=$id?>" title="{{%edit%}}"><div class="actions action_update"></div></a>
                                        <a class="delete-item" href="/navigation/pretty/delete/id=<?=$id?>" title="{{%delete%}}"><div class="actions action_delete"></div></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->
