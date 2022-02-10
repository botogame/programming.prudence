# Благополучный код

Бизнес это практичный язык дела не ограничивающий себя рамками одной системы и что главное, сохраняет интерес к деятельности "из поколения к поколению". Возьмём это как лучший вариант подхода в построении кода. 

Для виртуализации бизнеса применим:
- от мастерства упорядочивания ```типизацию```
- от искусства самовыражения ```domain driven design``` 

> Domain driven design (DDD) — это концепция, согласно которой структура и язык программного кода (имена классов, методы классов, переменные классов) должны соответствовать бизнес-домену.

![](./Картинки/ddd.jpg)

Чтобы не ограничивать проект <a href="./Картинки/Классовые измены.jpg">классовыми изменами</a> (ооп), будем реализовывать код в виде ```многомерного массива```:

```diff
1. Виртуальный проект - текущее состояние:
  1.1. План - чем занимаемся:
      1.1.1. Процессы - принцип работы: 
        1.1.1.1. Стиль программирования
        1.1.1.2. Системные функции
      1.1.2. Логика - этап адаптации: 
        1.1.2.1. Условия 
        1.1.2.2. Циклы
  1.2. Перспектива - что имеем:
      1.2.1. Конструкции - составляющие:
        1.2.1.1. Названия классов и пользовательских функций 
        1.2.1.2. Приватность и публичность
      1.2.2. Ресурсы - этап согласования:
        1.2.2.1. Переменные
        1.2.2.2. Информация
```

> Вариативность не должна уничтожать связанность кода.

Мы будем процессы и конструкции создавать вне зависимости друг от друга (зона известности), а за их стыковку (зона неизвестности) будет отвечать логика и ресурсы. План и перспектика станут презентабельной частью кода (и одновременно сводными данными проекта).

### *МАССИВЫ:*

Переведём DDD:

1. Domain у нас будет планами,
2. Design у нас будет версиями,
3. Driven же у DDD как интеграция. 

Интеграция здесь проявила себя как компот из логики, ресурсов и ещё чего то ужасного в виде фич. Причина в принятых правил ООП, который располагает только тремя слоями. Массив же у нас многомерен, а это значит что мы можем логику и ресурсы разместить в отдельных слоях. 

![](./Картинки/layers.jpg)

Поэтому заберём всё самое лучшее у DDD и перейдём к массивам.

### *СБОРКА:*

Последовательность сборки массива будет такой:
1. В планах ставятся ```задачи```
2. В версиях подбираются готовые ```модули```

![](./Картинки/stages.jpg)

И если готовых модулей нет (или же нужна корректировка), то начинается работа над модулем:
1. Подготовка процессов
2. Подготовка конструкций
3. Подготовка ресурсов
4. Подготовка логики


### *ПРОЦЕССЫ:*

Обозначим, что виртуальные процессы это список системных функций и формат работы над проектом:

-----------

- Инструкции (у процессов):

> уровень системных функций языка программирования, за счёт:
>
> - названия
> - системная функция
> - параметров, где определяется список с информацией для функционала по секторам с:
>   - названием, где определяется идентификатор
>   - описанием, где определяется назначение
>   - рекомендациями, где определяется значение по умолчанию для авто-проставки (если нужна)
> - результата, где определяется информация о результате функционала
> - кода операции, где функционал (если нужен)
> - зависимость, где определяется вышестоящая системная функция

-----------

- Наследие (у конструкций):

> возможность интеграции в виде дополнительного подсоединения, за счёт:
>
> - названия
>
> - платформы, где определяется список для местовложений по секторам с:
>      - названием конструкции
> - экземпляра, где определяется количество: один, множество
> - логики, где определяется допустимость логики

-----------

- Значения (у ресурсов):


> предположение возможного объёма информации, за счёт:
>
> - названия
>
> - фильтра, где определяются рамки с помощью "регулярного выражения"

-----------

- Сопоставление (у логики): 

> диапазон допустимых вариантов информации, за счёт:
>
> - названия
> - варианта [ПЛАН: найти 150 тыс. руб. для доработки предопределенности]

![](./Картинки/movement.jpg)

Пример инструкций:
```json
{
	"Название": "Отправить HTTP cookie",
	"Системная функция": "setcookie",
	"Описание": "Определяет cookie для отправки в браузер вместе с остальной header-информацией.",
	"Параметры": [
		{
			"Название": "Наименование",
			"Описание": "Значение string",
		},
		{
			"Название": "Значение",
			"Описание": "Значение string. Это значение будет сохранено на клиентском компьютере; не записывайте в cookie секретные данные.",
		},
		{
			"Название": "Срок действия",
			"Описание": "Значение int. Время, когда срок действия cookie истекает. Это метка времени Unix, то есть это количество секунд с начала эпохи. Если задать 0, то срок действия cookie истечёт с окончанием сессии (при закрытии браузера).",
		},
		{
			"Название": "Доступ",
			"Описание": "Значение string. Путь к директории на сервере, из которой будут доступны cookie",
			"Рекомендуется": "",
		},
		{
			"Название": "Привязка",
			"Описание": "Значение string. Домен, которому доступны cookie",
			"Рекомендуется": "",
		},
		{
			"Название": "HTTPS",
			"Описание": "Значение bool. Указывает на то, что значение cookie должно передаваться от клиента по защищенному HTTPS соединению. Если задано TRUE, cookie от клиента будет передано на сервер, только если установлено защищенное соединение",
			"Рекомендуется": false,
		},
		{
			"Название": "Только http",
			"Описание": "Значение bool. Если задано TRUE, cookie будут доступны только через HTTP протокол",
			"Рекомендуется": false,
		},
	],
	"Зависимость": "Получить заголовок HTTP",
	"Результат": "Значение bool. Если перед вызовом функции клиенту уже передавался какой-либо вывод (тэги, пустые строки, пробелы, текст и т.п.), setcookie() вызовет отказ и вернет FALSE. Если setcookie() успешно отработает, то вернет TRUE. Это, однако, не означает, что браузер правильно приняло и обработало cookie.",
}
```


Системная функция (выполняющая модуль) будет вызываться как ```modul``` у которой такие параметры:

1. $проект - весь массив
2. $идентификатор_конструкции - для выполнения определенного модуля (по умолчанию "система")
3. $идентификатор_логики - с какой позиции выполнять логику (по умолчанию "1")

Результат выполнения:
1. true - при удаче
2. false - при ошибке


### *КОНСТРУКЦИИ:*

Обозначим, что виртуальные конструкции это пространство имён и регулятор приватности.

```diff
 1. Распределение - определяем место человека по половому признаку
   1.1. $_get - получение информации от http запроса
   1.2. echo - вывод текста
```

![](./Картинки/staples2.jpg)

Чтобы понять наследие взглянем на DOM-модель html-а:

```diff
1. TABLE
1.1. TR
1.1.1. TD
```

Пример наследия:
```json
{
	"Название": "Таблица",
	"Описание": "Совокупность связанных данных, хранящихся в структурированном виде в базе данных. Она состоит из столбцов и строк. В реляционных базах данных и плоских файлах баз данных, таблица — это набор элементов данных (значений), использующий модель вертикальных столбцов (имеющих уникальное имя) и горизонтальных строк.",
	"Платформа": [
	    {"Название": "База данных"}
	],
	"Экземпляр": "Множество",
	"Логика": "Не допустима"
}
```

Пример применения наследия:

```diff
 1. [Ассоциация:] Распределение - определяем место человека по половому признаку
   1.1. [Сервис:] $_get - получение информации от http запроса
   1.2. [Сервис:] echo - вывод текста
```


Пример старого построения кода, из которого взяли конструкциии (и в дальнейшем ресурсы и логику):

```php
<?php 
/*определяем место человека по половому признаку*/
function распределение(){

  $запрос = $_get;

  if(isset($запрос['пол'])){

    if($запрос['пол'] == 'женский'){$сообщение = 'вам налево';}
    elseif($запрос['пол'] == 'мужской'){$сообщение = 'вам направо';}

    if(isset($сообщение)){echo $сообщение;$распределено = 'да';}

  }


  if(!isset($распределено)){$распределено = 'нет';}

  return $распределено;

} 
?>
```

### *РЕСУРСЫ:*

Обозначим, что виртуальный ресурс это переменные. Задача переменных состоит в транзите информации по конструкциям и в их ограничении свободы:
```diff
 1. [Сервис:] Распределение - определяем место человека по половому признаку
              • создать: $сообщение
              • отдать: $распределено
   1.1. [Процесс:] $_get - получение информации от http запроса
                   • отдать: $запрос
   1.2. [Процесс:] echo - вывод текста
                   • получить: $сообщение
```

![](./Картинки/telepathy.jpg)

Чтобы понять уровень предопределенности посмотрим на параметры тэгов в html:

```diff
1. WIDTH = значение | Определяет длину линии в пикселях или процентах от ширины окна браузера
2. SIZE = значение | Определяет толщину линии в пикселях
3. ALIGN = значение | Определяет выравнивание горизонтальной линии. Параметр может принимать следующие значения: left - по левому краю, right - по правому краю, center - по центру (используется по умолчанию)
4. NOSHADE | Определяет способ закраски линии как сплошной. Параметр является флагом и не требует указания значения. Без данного параметра линия отображается объемной
5. COLOR = цвет | Определяет цвет линии (действует только в Internet Explorer)
```

Пример значения:
```json
{
	"Название": "Строка",
	"Описание": "Максимум 256 различных символов",
	"Фильтр": "(.*?){0,256}",
}
```

Пример применения значения:

```diff
 1. [Сервис:] Распределение - определяем место человека по половому признаку
              • создать: {$сообщение:строка}
              • отдать: {$распределено:строка}
   1.1. [Процесс:] $_get - получение информации от http запроса
                   • отдать: {$запрос:массив 1-го уровня}
   1.2. [Процесс:] echo - вывод текста
                   • получить: {$сообщение:строка}
```
При этом "$запрос" попадая из конструкции "$_get" в конструкцию распределения приобретает новое имя: "$_get.запрос". Запоминание родительских конструкций в названии применяется только при отдаче.

### *ЛОГИКА:*

Обозначим , что виртуальная логика это применение условий и зацикливание:
```diff
+ 1) активировать [применяя] {$_get}
    + 1.1) не равны [применяя] $_get.запрос['пол'], null
        + 1.1.1) равны [применяя] $_get.запрос['пол'], 'женский'
            + 1.1.1.1) совмещение [применяя] $сообщение, 'вам налево'
                + 1.1.1.1.1) активировать [применяя] {echo}
                    + 1.1.1.1.1.1) совмещение [применяя] $распределено, 'да'
                        + 1.1.1.1.1.1.1) отдать [применяя] $распределено
            - 1.1.1.0) равны [применяя] $_get.запрос['пол'], 'мужской'
                + 1.1.1.0.1) совмещение [применяя] $сообщение, 'вам направо'
                    + 1.1.1.0.1.1) активировать [применяя] {echo}
                        + 1.1.1.0.1.1.1) совмещение [применяя] $распределено, 'да'
                            + 1.1.1.0.1.1.1.1) отдать [применяя] $распределено
                - 1.1.1.0.0) перейти к пункту [применяя] 0
        - 1.1.0) перейти к пункту [применяя] 0
    - 1.0) перейти к пункту [применяя] 0
- 0) совмещение [применяя] $распределено, 'нет'
    + 0.1) отдать [применяя] $распределено
```

Проход вглубь команд возможен по двум путям: положительном или отрицательном (когда команда выдала false). При этом ответвление как положительное, так и отрицательное должно быть в одном экземпляре.

![](./Картинки/safety.jpg)

Отрицательное выполнение команд играет роль подушки безопасности.

[ПЛАН: найти 150 тыс. руб. для доработки предопределенности]

### *ПЕРСПЕКТИВА:*

1. бизнес как модуль
2. интерактивная работа с переменными
2. логика доступна человеческому пониманию
4. видение всей структуры базы данных и файлов
7. среда разработки на паттернах
8. понятные названия на всём процессе программирования
9. версионность модулей
10. сравнение версий модулей на различие
11. парная работа программистов
13. ресурсо-ориентированная бизнес модель
15. главные модули на виду
18. возможны готовые модули от профессионалов
20. лог каждого шага в программировании
24. программирование развивающее самовыражение
25. код без тягомотины (коррупции) в виде фич (нагромождений)

![](./Картинки/finish.jpg)

16. Код = документация

### *ПРОТОТИПЫ:*

Были апробированы такие прототипы:
1. <a href="./Прототипы/Центрированный сайт/">Центрированный сайт</a>
2. <a href="./Прототипы/Резонансный код/">Резонансный код</a>
3. <a href="./Прототипы/Внешний вид программы/">Программа разработки</a>

Текущие задачи:
1) ПЛАН: найти 150 тыс. руб. для доработки предопределенности
   - устранение многозначности
   - устранение fatal error
   - введение принципа доверия и недоверия
   - введение области инициатив
