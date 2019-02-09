<?php
$title = '{{%MySite CMS web engine installation%}}';
$langs = \src\I18n::get();
?>
<html>
<head>
    <title><?= $title ?></title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        div {
            margin: 0 auto;
            width: 50%;
            text-align: center;
            padding: 10px;
        }

        table {
            font-size: 13px;
            width: 500px;
        }

        th {
            padding: 10px;
            text-align: left;
        }

        input, select {
            width: 100%;
        }

        textarea {
            width: 50%;
            height: 300px;
            border: 0;
        }

        .error {
            background-color: red;
            color: white;
        }

        .success {
            background-color: green;
            color: white;
        }

        #flags {
            border: 0;
        }

        #flags ul li {
            display: inline;
        }
    </style>
</head>
<body>
<div id="flags">
    <ul>
        <?php foreach ($langs as $k => $v) : ?>
            <li>
                <a href="?lang=<?= $k ?>"><img src="/images/flags/<?= $v['icon'] ?>"
                                               alt="<?= $v['title'] ?>" <?= ($currLang == $k ? 'class="curr-lang"' : '') ?>></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<div>
    <h1><?= $title ?></h1>
    <?php if (isset($error)) : ?>
        <div>
            <div class="error"><?= $error ?></div>
        </div>
    <?php endif; ?>
    <?php if (!isset($success)) : ?>
        <form action="/" method="post">
            <table align="center">
                <tr>
                    <th>{{%Database name%}}</th>
                    <td><input type="text" name="Install[dbname]" value="<?= $values['dbname'] ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input style="width: 13px;" type="checkbox" name="Install[dbcurrent]" value="1">
                        <small>{{%check this option if you're not allowed to create a new database%}}</small>
                    </td>
                </tr>
                <tr>
                    <th>{{%Database username%}}</th>
                    <td><input type="text" name="Install[dbuser]" value="<?= $values['dbuser'] ?>"></td>
                </tr>
                <tr>
                    <th>{{%Database user password%}}</th>
                    <td><input type="text" name="Install[dbpass]" value="<?= $values['dbpass'] ?>"></td>
                </tr>
                <tr>
                    <th>{{%Database hostname%}}</th>
                    <td><input type="text" name="Install[dbhost]" value="<?= $values['dbhost'] ?>"></td>
                </tr>
                <tr>
                    <th>{{%Admin login%}}</th>
                    <td><input type="text" name="Install[adminLogin]" value="<?= $values['adminLogin'] ?>"></td>
                </tr>
                <tr>
                    <th>{{%Admin password%}}</th>
                    <td><input type="text" name="Install[adminPassword]" value="<?= $values['adminPassword'] ?>"></td>
                </tr>
                <tr>
                    <th>{{%Site name%}}</th>
                    <td><input type="text" name="Install[siteName]" value="<?= $values['siteName'] ?>"></td>
                </tr>
                <tr>
                    <th>{{%Site theme%}}</th>
                    <td>
                        <select name="Install[siteTheme]">
                            <option <?= $values['siteTheme'] == 'blue' ? 'selected' : '' ?> value="blue">{{%default
                                (blue)%}}
                            </option>
                            <option <?= $values['siteTheme'] == 'green' ? 'selected' : '' ?> value="green">{{%green%}}
                            </option>
                            <option <?= $values['siteTheme'] == 'red' ? 'selected' : '' ?> value="red">{{%orange%}}
                            </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>{{%Site language%}}</th>
                    <td>
                        <select name="Install[siteLanguage]">
                            <?php foreach ($langs as $k => $lang) : ?>
                                <option <?= $values['siteLanguage'] == $k ? 'selected' : '' ?>
                                        value="<?= $k ?>"><?= $lang['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>{{%Contact email%}}</th>
                    <td><input type="text" name="Install[email]" value="<?= $values['email'] ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <td align="right">
                        <button>{{%Install%}}</button>
                    </td>
                </tr>
            </table>
        </form>
    <?php endif; ?>
    <?php if (isset($success)) : ?>
    <p>
        <div class="success">
    <p><?= $success ?></p></div>
</p>
<?php endif; ?>
<?php if (isset($text)) : ?>
    <textarea><?= $text ?></textarea>
<?php endif; ?>
</div>
</body>
</html>