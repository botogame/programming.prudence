# Благоразумное программирование

Среда в которой мы находимся может как помогать нам эволюционировать, так и наоборот - убивать всё ценное. Я к сожалению, опиравшись на популярные framework'и (копролиты), подножек и ловушек хорошо понаполучал. И понял, что текущее программирование пошло в сторону конфликта, и работает против новичков, то есть губит самое ценное и важное -> любознательность.

![](./Картинки/Тупая%20пила.jpg)

Это мне не понравилось, и я решил со всех реализованных framework сбросить лишнее (всю уёбищность и вредительство), дабы из ценного и нужного собрать стиль програмирования.
 
![](./Картинки/Заточка%20пилы.jpg)

--------------------------------------------
### Проект "Конструктор бизнес кода"

Создавая оболочку для <a href="./Прототипы/Бизнес код/README.md">бизнес кода</a> я буду придержится анти-принципа грандиозности "заменимых не существует": 

1. никаких bild-версий / каждый файл меняется отдельно (в последовательности) наживую
2. меню будет и статичным и динамичным одновременно
3. новые файлы будут частью конструктора / картинки и pdf только через конструктор
4. права доступа / разработку можно залочить для паралельного участника

![](./Картинки/wiew-3.png)

Задача перед средой разработки поставлю так: ресурсы как продолжение логики, процессы как продолжение конструкции.

Выделим их главные функции:

- упрощение в виде ресурсов продолжающие логику (практиковался на <a href="https://github.com/botogame/programming.prudence/blob/main/%D0%9F%D1%80%D0%BE%D1%82%D0%BE%D1%82%D0%B8%D0%BF%D1%8B/%D0%A6%D0%B5%D0%BD%D1%82%D1%80%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%BD%D1%8B%D0%B9%20%D1%81%D0%B0%D0%B9%D1%82/README.md">центрированном сайте</a>, есть прототипы)
- сбережение в виде процессов продолжающие конструкции (практиковался на <a href="https://github.com/botogame/programming.prudence/blob/main/%D0%9F%D1%80%D0%BE%D1%82%D0%BE%D1%82%D0%B8%D0%BF%D1%8B/%D0%A0%D0%B5%D0%B7%D0%BE%D0%BD%D0%B0%D0%BD%D1%81%D0%BD%D1%8B%D0%B9%20%D0%BA%D0%BE%D0%B4/README.md">резонансном коде</a>, есть прототипы)

Итогом должна образоваться среда разработки: ассертивный редактор (assertive_editor.exe).

Энергетику ассертивности хорошо показал Julien Doré в клипе <a href="https://www.youtube.com/watch?v=PtLPKvK4jv8&list=RDEMarcVqr-c-Xn4Wqnoz88aVw&index=2">Chou wasabi</a>: 

![](./Картинки/75044-1537879262.webp)

Ассертивность выстраивается на понимании. И в интернете про ассертивность иногда написано что нужно избавляться от паранойи, отнюдь не надо, а наоборот, эта необычная часть человеческого понимания о мире хорошо будет дополнять <a href="https://www.youtube.com/watch?v=KDXOzr0GoA4&list=RDEMarcVqr-c-Xn4Wqnoz88aVw&index=4">общую картину</a> редактора. Как и другие качества, которые вы не смогли проявить в других средах разработки.

Сделаем расположение на главной редактора кода только таких корневых конструкций:

- файловое хранилище
- html {5.3}
- php {7.2}
- javascript {1.8.5}
- css {3}
- mysql {5.7}

Здесь "файловое хранилище" как старый способ разработки, и туда, помимо картинок, будем объявлять выгрузку сформированных данных с "html", "php" в указанные файлы index.php, /shablons/main.html, style.css и т.п. Таким образом будут реально <a href="https://youtu.be/0J1fKBxK9Wc?t=101">скованные одной цепью</a>.

Изучаю Carrier Rider Mapper... 

![](./Картинки/1675430645_bogatyr-club-p-nebesnii-korabl-krasivii-fon-49.jpg)

Наверно буду первым кто грамотно это спроектирует на редактировании код: заходишь в редактор и видишь структуру файлов, а внутри каждого файла подкатегории php, html, js, css, mysql:

```
- 🗅index.php
		- /📁index.php/🗅main.tpl
				- /📁index.php/📁index.tpl/🗅style.css
				- /📁index.php/📁index.tpl/🗅favicon.png
				- /📁index.php/📁index.tpl/🗅logotype.png
		- /📁index.php/🗅about.php
				- /📁index.php/📁about.php/🗅body.tpl
		- /📁index.php/news.php
				- /📁index.php/📁news.php/🗅body.tpl
				- /📁index.php/📁news.php/🗅table.tpl
				- /📁index.php/📁news.php/🗅table_td.tpl
				- /📁index.php/📁news.php/🗅script.js
				- /📁index.php/📁news.php/🗅data.sql
```

> Далее думаю....
