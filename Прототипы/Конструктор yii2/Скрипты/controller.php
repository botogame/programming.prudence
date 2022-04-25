<?php

$controller_list = [];

$patch = '...';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($patch));
$regex    = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);
foreach ($regex as $file => $value) {

    $file_php_data = file_get_contents($file);
    $file_php_tokens = token_get_all($file_php_data);

    $namespaces_array = parser_class_in_php_tokens($file_php_tokens, T_NAMESPACE);
    $class_array = parser_class_in_php_tokens($file_php_tokens, T_CLASS);

    if ($class_array !== false) {
        $class_name = $class_array[0];
        $namespaces_name = '';

        if($namespaces_array !== false and is_array($namespaces_array)){
            foreach($namespaces_array as $namespace){
                $namespaces_name.= $namespace.'\\';
            }
        }

        $controller_list[] = $namespaces_name.$class_name;
    }
}

var_dump($controller_list);

function parser_class_in_php_tokens($tokens, $search){

    if(!in_array($search,[T_NAMESPACE, T_CLASS])){
        return false;
    }

    $ns = false;
    $result  = false;

    foreach ($tokens as $token) {

        $key = $token[0];

        if ($key === $search) {
            $ns = true;
        }
        elseif($ns && $key === ';') {
            $ns = false;
        }
        elseif($ns && $key === T_STRING) {
            $result[] = $token[1];
        }
    }

    return $result;
}


?>