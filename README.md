Документация по установке и использованию веб-движка для сайтов MySite CMS

Введение

Веб-движок MySite CMS представляет собой набор скриптов, написанных на языке программирования PHP, который позволяет в кратчайшие сроки развернуть готовый сайт в сети Интернет. Имеется панель управления содержимым сайта, к которой реализован доступ по логину и паролю пользователя.

Требования к установке

Минимальная конфигурация веб-окружения  для корректной работы скриптов следующая:
Интерпретатор PHP версии не ниже 5.4
Веб-сервер nginx, либо apache с настроенной домашней директорией на папку web
Движок MySQL, который используется для хранения данных

Установка

Установка крайне проста: нужно распаковать архив на сервере и открыть сайт в веб браузере.
Например, доменное имя вашего сайта mysite-cms.ru — вы пробуете открыть его в браузере и при правильной настройке виртуальных хостов (nginx: root /var/www/mysitecms/web, apache: DocumentRoot /var/www/mysitecms/web) вы должны увидеть следующий экран:
Для выбора языка интерфейса установки щелкните по нужному флажку страны. На данный момент реализованы 2 языка: английский и русский, однако, я был бы очень признателен за перевод файла protected/application/i18n/ru.php на другие языки.

Рассмотрим все параметры установки:

Название базы данных — имя вашей базы данных
Флаг «выберите эту опцию если у вас нет возможности создать новую базу данных» — если хостер не позволяет создание новой базы данных, то поставьте этот флаг и укажите существующую базу данных.
Имя пользователя базы данных — имя пользователя вашей базы данных
Пароль пользователя базы данных	— пароль пользователя базы данных
Сервер базы данных — сервер базы данных (обычно localhost)
Логин администратора — логин администратора сайта
Пароль — пароль администратора сайта
Имя сайта — имя вашего сайта (будет отображаться в заголовках страниц)
Тема сайта — цветовая тема вашего сайта (голубая, зеленая, оранжевая)
Язык сайта — язык вашего сайта
Почта для контактов — контактная почта, на которую будут приходить сообщения со страницы контактов
После ввода всех параметров и нажатия на кнопку установки следуйте инструкциям на экране. После успешной установки сайт должен будет открываться без ошибок.

Эксплуатация

Сайт готов к эксплуатации. Для наполнения, создания, редактирования ваших страниц, а так же настроек сайта и отдельных модулей необходимо перейти в раздел администрирования. Для этого перейдите по ссылке ВАШ-САЙТ/admin. Вы должны увидеть следующий экран:

ВАЖНО! 
Если вы при установке указали русский язык (либо любой другой, кроме английского), все надписи будут на выбранном языке.

Введите ваш логин и пароль администратора в указанные поля и нажмите кнопку входа. После успешного входа вам будут доступны все настройки сайта.

Пройдемся по разделам администраторской части.

Раздел «Общая информация»

Данный раздел содержит общую информацию об установленных модулях. Доступные для установки и уже установленные модули отображаются списком с галочками управления состоянием модуля. Напротив каждого модуля имеются 2 галочки: Установлен и Активен. Вы можете произвести нужные действия, отметив или сняв нужные галочки, и нажав на кнопку Сохранить. Галочка Установлен отвечает за установку модуля в системе, галочка Активен — за активность. Если вы хотите отключить какой-либо модуль, то рекомендую просто снять галочку Активен и нажать Сохранить. Я настоятельно рекомендую не снимать галочку Установлен, если модуль уже установлен, так как сохранение этого состояния удалит все данные этого модуля из базы данных. 

ВАЖНО! 
Будьте очень осторожны со снятием галочки Установлен, так как это может привести к потере данных конкретного модуля!

При установке нового модуля в системе напротив него появится надпись «редактировать». Перейдя по ней вы получите доступ к редактированию настроек выбранного модуля, а так же просмотра и управления данными модуля. Каждый модуль имеет свою инструкцию по эксплуатации, которая не входит в базовую версию веб движка. Вы можете скачать ее отдельно на сайте https://github.com/ambirus/mysite-cms/archive/master.zip

Раздел «Администрирование»

В этом разделе вы сможете сменить логин и пароль администратора сайта.

Раздел «Отправка писем»

Этот раздел предназначен для работы с отправкой электронных писем. На данный момент реализован спам-фильтр по IP. Если на ваш почтовый ящик, который вы указали в настройках при установке веб движка, начал приходить спам, то вы можете указать все нежелательные IP пользователей в соответствующее поле, разделяя их запятыми. IP пользователя можно узнать из текста письма, который будет приходить на ваш ящик.

Раздел «Сайт»

Здесь вы сможете изменить некоторые настройки вашего сайта. А именно:

Имя сайта — имя вашего сайта, которое будет отображаться в заголовках страниц
Тема сайта — цветовая тема оформления сайта
Почта для контактов — почтовый ящик, куда будут отправляться сообщения из контактной формы
Страница на главной — страница, которая будет отображаться на главной странице сайта

В подразделе Текстовые блоки вы сможете изменить содержимое некоторых статичных текстовых блоков на сайте.

Шапка сайта — текст в шапке сайта, который идет сразу под навигационным меню
Лого сайта — текст слева от навигационного меню
Блок Google — вставьте сюда текст скрипта Google Analytics
Ссылки сайта — укажите ссылки на ваши другие контактные данные
Блок Яндекс Метрики — вставьте сюда текст скрипта Яндекс Метрики
Подвал сайта — текст в подвале сайта: копирайт, название сайта и текущий год

Раздел «Навигация»

Этот раздел является самым большим и сложным в настройке, однако, я приложу все усилия в описании настроек дабы вам удалось разобраться в нем с минимальными усилиями.
Раздел нужен для организации работы с навигационным меню и маршрутизацией на вашем сайте. На картинке ниже вы видите главное навигационное меню сайта с указанием количества элементов пунктов в меню.

При переходе по ссылке «просмотр элементов» вы увидите список пунктов меню. Каждый пункт меню имеет следующие свойства:

Название — текст ссылки
Путь — путь, куда ведет эта ссылка
Порядок следования — порядковый номер следования в навигационном меню слева направо. Отчет начинается с нуля.
Активен — если галочка снята, то пункт меню не отображается на сайте.

При нажатии на ссылку «редактировать» справа от пункта меню вы попадете в подраздел редактирования выбранного пункта меню.

Теперь самое сложное: короткие ссылки. Короткие ссылки задумывались как средство сокращения длинных ссылок на сайте до нормальных человекочитаемых. В системе может быть только одна уникальная короткая ссылка, это было сделано для того чтобы не было двух и более одинаковых ссылок для разных страниц. Внизу вы видите список коротких ссылок сайта.
Свойства:
Модель — какой-либо модуль, элемент которого может быть открыт по ссылке
Полный путь — полный путь к элементу в системе
Короткая ссылка — короткий путь к элементу, который соотносится с полным путем

По идее работа с навигационным меню задумывалась следующим образом:

1. Сначала вы создаете короткую ссылку для какого-то элемента модуля. Например, страницу. Выбираете модель «Страницы»
2. Система сгенерирует полный путь: /page/front/index
3. Вам остается придумать уникальную короткую ссылку для этого элемента, например: /pages. Не забудьте сохранить создаваемую ссылку.

ВАЖНО! 
Обязательно ставьте косую черту в короткой ссылке! То есть /pages, а не просто pages!

После успешного создания короткой ссылки на страницу она будет доступна и по полному пути, и по короткому. Теперь можно создать пункт навигационного меню, в свойстве «Путь» которого можете указать либо полную, либо короткую ссылку на страницу.

Есть еще один момент, при проведении манипуляций выше вы получите ссылку на список страниц. Если вы хотите создать пункт меню, который должен вести на одну конкретную страницу, то вам нужно повторить предыдущие шаги до второго пункта. Затем выбрать элемент модели. Элемент модели — это отдельная конкретная страница модуля. Допустим, вы выбрали элемент «Главная». Система автоматически построит для него полный путь в свойстве «Полный адрес». Затем вас остается только придумать уникальную короткую ссылку и нажать кнопку «Сохранить».

Если вас не устраивает созданная короткая ссылка, то вы можете ее отредактировать. 

Раздел «Страницы»

Этот раздел используется для создания и редактирования статических страниц.
Каждая статическая страница имеет следующие свойства:

Заголовок страницы — текст заголовка страницы
Текст страницы — основной текст страницы. Для удобства вставки и редактирования текста из других источников используется широко известный редактор ckeditor
Ключевые слова — ключевые слова страницы, которые могут использоваться для SEO
Описание — описание страницы для SEO
Активность — флаг активности страницы, если страница не активна, то она не будет открываться на сайте

ВАЖНО! 
Если вы хотите разместить фотографии в тексте страницы, которые должны будут открываться в отдельном окне для повышения читабельности, то не забудьте указать класс fancy для тэга img и опишите фотографию в аттрибуте alt — он используется для заголовка фотографии, которая будет открываться в отдельном окне. Для этого щелкните правой кнопкой мыши по фотографии в редакторе, в появившемся меню выберите пункт «Свойства изображения». В свойстве «Альтернативный текст» укажите название фотографии, а во вкладке «Дополнительно» в свойстве «Класс CSS» укажите слово fancy. Нажмите ОК и сохраните страницу. Если все было сделано правильно, то фотография на странице будет открываться в отдельном окне.

Установка новых тем оформления

Скачанную новую тему нужно распаковать в папку «protected/application/modules/site/views/themes». В этой папке уже присутствует тема по умолчанию «default». После этого новую тему можно будет применить перейдя в админку в раздел «Сайт» и выбрав ее в выпадающем списке «Тема сайта». Далее нужно нажать кнопку «Сохранить».
