<?php
$title = '{{%Pages%}}';
$active = 'page';
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
                    {{%Here you can create, edit and delete static pages. Pages can be assigned as links in the navigation menu%}}
                </blockquote>

                <div>
                    <div class="action_create_block">
                        <a href="/page/back/create" title="{{%create a page%}}">
                            <div class="actions action_create"></div>
                        </a>
                        <a href="/page/back/create">{{%create a page%}}</a>
                        <div class="clear"></div>
                    </div>
                </div>

                <?=$pager?>

                <table data-toggle="table" class="table table-hover">
                    <thead>
                    <tr>
                        <th style="">
                            <div class="th-inner ">{{%Page title%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner ">{{%Created at%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner ">{{%Updated at%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner ">{{%Activity%}}</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th style="">
                            <div class="th-inner "></div>
                            <div class="fht-cell"></div>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($pages['total'] > 0 && isset($pages['items'])) : ?>
                        <?php foreach ($pages['items'] as $id => $page) : ?>
                            <tr>
                                <td><?=($page['title'])?></td>
                                <td><?=date('d-m-Y H:i:s', $page['created_at'])?></td>
                                <td><?=is_null($page['updated_at']) ? '' : date('d-m-Y H:i:s', $page['updated_at'])?></td>
                                <td>
                                    <?=$page['state'] == 1 ? '{{%yes%}}' : '{{%no%}}'?>
                                </td>
                                <td>
                                    <div class="actions_block">
                                        <a target="_blank" href="/page/front/index/id=<?=$id?>" title="{{%open%}}"><div class="actions action_view"></div></a>
                                        <a href="/page/back/update/id=<?=$id?>" title="{{%edit%}}"><div class="actions action_update"></div></a>
                                        <a class="delete-item" href="/page/back/delete/id=<?=$id?>" title="{{%delete%}}"><div class="actions action_delete"></div></a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>

                <?=$pager?>

            </div>
        </div>
    </div><!--/.row-->
</div>	<!--/.main-->
