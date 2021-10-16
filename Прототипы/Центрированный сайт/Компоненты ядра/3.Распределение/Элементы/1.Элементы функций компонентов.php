<?php

return [

    'Conditions'   => [

        'initiation' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'check_request_legality' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'check_request_destructive' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'check_changes_schema_data_base' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'check_request_access' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'check_correct_taking_schema_experience' => [
            'Входящие переменные'  => [
                'Наработка' => null,
                'Цель'      => null,
                'Деталь'    => null,
                'Заглушка'  => 'error',
            ],
            'Выходящие переменные' => [],
        ],
        'check_correct_taking_schema_data_base' => [
            'Входящие переменные'  => [
                'Таблица'   => null,
                'Колонка'   => null,
                'Деталь'    => null,
                'Заглушка'  => 'error',
            ],
            'Выходящие переменные' => [],
        ],
        'position_time' => [
            'Входящие переменные'  => [
                'Формат'  => 'Y-m-d H:i:s',
            ],
            'Выходящие переменные' => [],
        ],
        'mark_start_execution_experience' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'mark_stop_execution_experience' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'detect_error' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'detect_operating_system' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'detect_path_executable_php' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'check_answer_correct' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'stop_core' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'parse_request' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'parse_parameters_request' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'parse_authorized' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'formation_user_session' => [
            'Входящие переменные'  => [
                'Идентификатор пользователя' => null,
            ],
            'Выходящие переменные' => [],
        ],
        'formation_user_password' => [
            'Входящие переменные'  => [
                'Пароль пользователя' => null,
            ],
            'Выходящие переменные' => [],
        ],
        'formation_result_executed_to_interface' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'definition_user_ip' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'formation_template' => [
            'Входящие переменные'  => [
                'Шаблон'    => null,
                'Параметры' => null,
            ],
            'Выходящие переменные' => [],
        ],
        'formation_url_project' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'formation_console_command_call_experience' => [
            'Входящие переменные'  => [
                'Наработка'                            => null,
                'Цель'                                 => null,
                'Идентификатор сохранённых параметров' => null,
            ],
            'Выходящие переменные' => [],
        ],
        'matching_schema_data_base' => [
            'Входящие переменные'  => [
                'Реализованная схема' => null,
                'Текущая схема'       => null,
            ],
            'Выходящие переменные' => [],
        ],
    ],
    'Space'        => [

        'initiation' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'set_mission' => [
            'Входящие переменные'  => [
                'Ключ'     => null,
                'Значение' => null,
            ],
            'Выходящие переменные' => [],
        ],
        'get_mission' => [
            'Входящие переменные'  => [
                'Ключ' => null,
            ],
            'Выходящие переменные' => [],
        ],
        'delete_mission' => [
            'Входящие переменные'  => [
                'Ключ' => null,
            ],
            'Выходящие переменные' => [],
        ],
        'delete_all_missions' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'result_executed_to_interface' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'message_to_mail' => [
            'Входящие переменные'  => [
                'Электронный адрес получателя' => null,
                'Заголовок'                    => null,
                'Текст'                        => null,
                'Шаблон'                       => null,
            ],
            'Выходящие переменные' => [],
        ],

    ],
    'Distribution' => [

        'initiation' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'schema_experience' => [
            'Входящие переменные'  => [
                'Наработка' => null,
                'Цель'      => null,
                'Деталь'    => null,
            ],
            'Выходящие переменные' => [],
        ],
        'schema_data_base' => [
            'Входящие переменные'  => [
                'Показать данные определенной таблицы' => null,
                'Показать данные определенной колонки' => null,
                'Деталь'                               => null,
            ],
            'Выходящие переменные' => [],
        ],
        'save_realized_schema_data_base' => [
            'Входящие переменные'  => [
                'Реализованная схема' => null,
            ],
            'Выходящие переменные' => [],
        ],
        'get_information_realized_schema_data_base' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'create_communication_with_data_base' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'complete_communication_with_data_base' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'create_communication_with_memory' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'complete_communication_with_memory' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'create_communication_with_mail' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'complete_communication_with_mail' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'write_information_in_file' => [
            'Входящие переменные'  => [
                'Папка'          => null,
                'Название файла' => null,
                'Тип файла'      => null,
                'Текст'          => null,
            ],
            'Выходящие переменные' => [],
        ],
        'include_information_from_file' => [
            'Входящие переменные'  => [
                'Папка'          => null,
                'Название файла' => null,
                'Тип файла'      => null,
            ],
            'Выходящие переменные' => [],
        ],
        'delete_file' => [
            'Входящие переменные'  => [
                'Папка'          => null,
                'Название файла' => null,
                'Тип файла'      => null,
            ],
            'Выходящие переменные' => [],
        ],
        'interchange_information_with_data_base' => [
            'Входящие переменные'  => [
                'Направление' => null,
                'Чего'        => null,
                'Значение'    => null,
            ],
            'Выходящие переменные' => [],
        ],
        'reconstruction_data_base' => [
            'Входящие переменные'  => [
                'Изменения' => null,
            ],
            'Выходящие переменные' => [],
        ],

    ],
    'Realization'  => [

        'initiation' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'execute_request_experience_goal' => [
            'Входящие переменные'  => [],
            'Выходящие переменные' => [],
        ],
        'fix_error' => [
            'Входящие переменные'  => [
                'Претензия'             => null,
                'Файл'                  => __FILE__,
                'Номер строчки в файле' => __LINE__,
                'Заглушка страницы'     => 'error',
            ],
            'Выходящие переменные' => [],
        ],
        'fix_reassembly_data_base' => [
            'Входящие переменные'  => [
                'Информация' => null,
                'Завершение' => false,
            ],
            'Выходящие переменные' => [],
        ],
        'call_experience' => [
            'Входящие переменные'  => [
                'Наработка'         => null,
                'Наработанная цель' => null,
                'Параметры'         => null,
            ],
            'Выходящие переменные' => [],
        ],
        'call_console_experience' => [
            'Входящие переменные'  => [
                'Наработка'         => null,
                'Наработанная цель' => null,
                'Параметры'         => null,
            ],
            'Выходящие переменные' => [],
        ],
        'work_with_memory_data' => [
            'Входящие переменные'  => [
                'Обозначение ячейки памяти' => null,
                'Значение для записи'       => false,
                'Время хранения в сек.'     => false,
                'Очистка ячейки'            => false,
            ],
            'Выходящие переменные' => [],
        ],
        'data_authorized_user' => [
            'Входящие переменные'  => [
                'Показать определенную часть данных' => null,
            ],
            'Выходящие переменные' => [],
        ],

    ],

];


?>
