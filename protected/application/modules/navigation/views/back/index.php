<?php
$title = '{{%Navigation%}}';
$active = 'navigation';

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
                    {{%Here you can edit items of navigation menu%}}
                </blockquote>

                <p><a href="/navigation/pretty/index">{{%edit short addresses%}}</a></p>

                <table data-toggle="table" class="table table-hover">
                    <thead>
                    <tr>
                        <th style="">
                            <div class="th-inner ">{{%Title%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner ">{{%Count of elements%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner "></div>
                            <div class="fht-cell"></div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (sizeof($menus) > 0) : ?>
                        <?php foreach ($menus as $id => $menu) : ?>
                            <tr>
                                <td><?=$menu['name']?></td>
                                <td><?=$menu['c']?></td>
                                <td><a href="/navigation/back/items/menuid=<?=$menu['alias']?>" title="{{%view items%}}"><div class="actions action_view"></div></a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->
