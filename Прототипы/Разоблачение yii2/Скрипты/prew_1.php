<?php

/*
Инициация:
$parser = new dominic_of_russia\parser_www_site1_com\association();
$catalog_data = $parser->parse_catalog($catalog_url, $catalog_page);
*/

namespace dominic_of_russia\parser_www_site1_com;

/*обработка информации*/
class microservice{

    /*перевод названия на латиницу*/
    public function preparate_string_to_latin($string)
    {

        $list_es = array("ае","уе","ое","ые","ие","эе","яе","юе","ёе","ее","ье","ъе","ый","ий");
        $list_os = array("аё","уё","оё","ыё","иё","эё","яё","юё","ёё","её","ьё","ъё","ый","ий");
        $list_rs = array("а$","у$","о$","ы$","и$","э$","я$","ю$","ё$","е$","ь$","ъ$","@","@");

        $replace = array("А"=>"A","а"=>"a","Б"=>"B","б"=>"b","В"=>"V","в"=>"v","Г"=>"G","г"=>"g","Д"=>"D","д"=>"d",
            "Е"=>"Ye","е"=>"e","Ё"=>"Ye","ё"=>"e","Ж"=>"Zh","ж"=>"zh","З"=>"Z","з"=>"z","И"=>"I","и"=>"i",
            "Й"=>"Y","й"=>"y","К"=>"K","к"=>"k","Л"=>"L","л"=>"l","М"=>"M","м"=>"m","Н"=>"N","н"=>"n",
            "О"=>"O","о"=>"o","П"=>"P","п"=>"p","Р"=>"R","р"=>"r","С"=>"S","с"=>"s","Т"=>"T","т"=>"t",
            "У"=>"U","у"=>"u","Ф"=>"F","ф"=>"f","Х"=>"Kh","х"=>"kh","Ц"=>"Ts","ц"=>"ts","Ч"=>"Ch","ч"=>"ch",
            "Ш"=>"Sh","ш"=>"sh","Щ"=>"Shch","щ"=>"shch","Ъ"=>"","ъ"=>"","Ы"=>"Y","ы"=>"y","Ь"=>"","ь"=>"",
            "Э"=>"E","э"=>"e","Ю"=>"Yu","ю"=>"yu","Я"=>"Ya","я"=>"ya","@"=>"y","$"=>"ye");

        $string = str_replace($list_es, $list_rs, $string);
        $string = str_replace($list_os, $list_rs, $string);

        /*$string = strtr($string,$replace);*/
        foreach($replace as $replace_k => $replace_v){
            $string = str_replace($replace_k, $replace_v, $string);
        }


        $string = preg_replace('%[^A-Za-zа-яА-Я0-9\- ]%', '', $string);
        $string = str_replace(['   ','  ',' '], '-', $string);

        return $string;

    }

    /*создание папки*/
    public function construct_dir($patch,$parent_patch=''){

        if(!is_dir($parent_patch.$patch)){
            mkdir($parent_patch.$patch,0777,true);
        }

        return $patch;
    }

    /*формирование размеров по алгоритму*/
    public function forming_dimensions_by_size_types($dimensions_string, $product_data){

        $file = './config/size_types.csv';
        $dimensions_preparate = [];

        /*типы размеров*/
        if(!is_array($this->size_types)){
            $this->size_types = [];
            if(file_exists($file)){
                $csv_text = file_get_contents($file);
                $this->size_types = call_user_func_array([$this->static_class_csv,'csv2array'],[$csv_text]);
            }
        }

        if(count($this->size_types)>0){

            /*разделяем размеры*/
            $dimensions_string = str_replace(['\' dia', '\'', 'ø'], ['Diameter', 'Diameter', 'Diameter'], $dimensions_string);
            $dimensions_list = explode('|', $dimensions_string);

            foreach($dimensions_list as $position => $dimension_value){

                $dimension_value = trim($dimension_value);

                /*получаем значение размера*/
                if(preg_match('/([0-9,-]{1,11})/', $dimension_value, $preg_size)){
                    $size = $preg_size[1];
                }
                else{
                    continue;
                }

                /*выявляем тип*/
                foreach($this->size_types as $check_type){

                    $check = true;

                    foreach($check_type as $check_name => $check_value){

                        if($check_value == Null){
                            continue;
                        }

                        /*сверяем*/
                        if($check_name == 'Size_position'){
                            if(($position + 1) != $check_value){
                                $check = false;
                            }
                        }
                        elseif($check_name == 'Size_diameter'){
                            if($check_value == '{True}'){
                                if(!substr_count($dimension_value, 'Diameter ')){
                                    $check = false;
                                }
                            }
                            elseif($check_value == '{False}'){
                                if(substr_count($dimension_value, 'Diameter ')){
                                    $check = false;
                                }
                            }
                        }
                        elseif($check_name == 'Size_cm'){
                            if($check_value == '{True}'){
                                if(!substr_count($dimension_value, ' cm')){
                                    $check = false;
                                }
                            }
                            elseif($check_value == '{False}'){
                                if(substr_count($dimension_value, ' cm')){
                                    $check = false;
                                }
                            }
                        }
                        elseif($check_name == 'Size_key'){
                            if($check_value == '{False}'){
                                if(preg_match('/([A-Z]{1})\. /', $dimension_value)){
                                    $check = false;
                                }
                            }
                            else{
                                if(!substr_count($dimension_value, $check_value . '. ')){
                                    $check = false;
                                }
                            }
                        }
                        elseif($check_name == 'Category_access'){
                            $cats_checks = explode(';', $check_value);
                            $check2 = false;
                            foreach($cats_checks as $cat){
                                if(substr_count(trim($product_data['Category'] . ' ' . $product_data['Type']), $cat)){
                                    $check2 = true;
                                    break;
                                }
                            }
                            if(!$check2){
                                $check = false;
                            }
                        }
                        elseif($check_name == 'Category_ignore'){
                            $cats_checks = explode(';', $check_value);
                            foreach($cats_checks as $cat){
                                if(substr_count(trim($product_data['Category'] . ' ' . $product_data['Type']), $cat)){
                                    $check = false;
                                    break;
                                }
                            }
                        }

                        /*не прошёл фильтр*/
                        if($check == false){
                            break;
                        }

                    }

                    /*сохраняем*/
                    if($check){
                        $dimensions_preparate[$check_type['Dimension']] = $size;
                        break;
                    }

                }

            }
        }

        return $dimensions_preparate;
    }

}


/*получение и отправка информации*/
class service extends microservice{
    public $size_types, $products_quantitys;

    /*запрос html у сайта*/
    public function get_html($url,$type){
        for($i=1;$i<=3;$i++){
            try {
                $response_answer = call_user_func_array([$this->static_class_jsoup,'connect'],[$url])
                    ->method("GET")
                    ->userAgent($this->user_agent)
                    ->timeout(6000)
                    ->ignoreContentType(true)
                    ->execute();

                $html = $response_answer->body();
            }
            catch (\Exception $ex){
                $html = false;
                $this->save_log_to_file($type,'ошибка "'.$ex->getMessage().'" для '.$url);
            }
            if($html){
                break;
            }
        }
        return $html;
    }

    /*запрос data у сайта*/
    public function get_data($url,$type){

        for($i=1;$i<=3;$i++){
            try {
                $response_answer = call_user_func_array([$this->static_class_jsoup,'connect'],[$url])
                    ->method("GET")
                    ->userAgent($this->user_agent)
                    ->timeout(15000)
                    ->maxBodySize(1000*1000*10)
                    ->ignoreContentType(true)
                    ->execute();
                $data = $response_answer->bodyAsBytes();
            }
            catch (\Exception $ex){
                $data = false;
                $this->save_log_to_file($type,'ошибка "'.$ex->getMessage().'" для '.$url);
            }
            if($data){
                break;
            }
            elseif($i!=3){
                sleep(3);
            }
        }
        return $data;
    }

    /*остатки на складе*/
    public function get_item_current_stock($json){

        $current_stock = false;


        $array_quantityes = json_decode($json,1);

        if(count($array_quantityes['atprows'])>0){

            foreach($array_quantityes['atprows'] as $array_quantity){

                if($array_quantity['quantity'] == 99999999999999999){
                    break;
                }

                $date = $this->class_time_format->parse($array_quantity['date']);

                if($date){
                    $time_quantity = $date->getTime() / 1000;
                }
                else{
                    $time_quantity = time();
                }

                $time_h_wait = ceil(($time_quantity - time()) / (3600 * 24));

                if($time_h_wait > 4){
                    $current_stock = '-'.$array_quantity['quantity'];
                }else{
                    $current_stock = $array_quantity['quantity'];
                }

                break;

            }

        }

        return $current_stock;

    }

    /*товары каталога*/
    public function get_catalog_products($html){

        $products = [];

        if(preg_match_all('/<div class ="product-sku-value">([a-zA-Z0-9-_]{0,})<\/div><strong class="product name product-item-name"><a class="product-item-link" href="(.*?)">/is',$html,$preg_articles_id)){
            foreach($preg_articles_id[1] as $key=>$article_id){
                $url = $preg_articles_id[2][$key];
                $products[$url] = [
                    'Id' => $article_id,
                    'Url' => $url,
                ];
            }
        }

        return $products;

    }

    /*категория каталога*/
    public function get_catalog_category($html){

        $category = 'unknown';

        /*<span class="base" data-ui-id="page-title-wrapper" >Mirrors</span>*/
        if(preg_match('/<span class="base" data-ui-id="page-title-wrapper" >(.*?)<\/span>/', $html,$preg_category)){
            $category = trim($preg_category[1]);
        }

        return $category;
    }

    /*кол-во страниц у каталога*/
    public function get_catalog_count_pages($html){

        $count_pages = 1;

        if(preg_match('/<span class="toolbar-number">([0-9]{0,})<\/span> of <span class="toolbar-number">([0-9]{0,})<\/span>/', $html,$preg_count_pages)){
            $count_pages = ceil($preg_count_pages[2] / $preg_count_pages[1]);
        }

        return $count_pages;

    }

    /*название товара на английском*/
    public function get_item_name_eng($html){

        $name = '';

        //<span class="base" data-ui-id="page-title-wrapper" itemprop="name">Picture Frame Obliquity L set of 2</span>
        if(preg_match('/<span class="base" data-ui-id="page-title-wrapper" itemprop="name">(.*?)<\/span>/',$html,$preg_title)){
            $name = $preg_title[1];
        }

        return $name;

    }

    /*описание товара*/
    public function get_item_description($html){

        $description = '';

        /*<div class="value" itemprop="description">The Rubautelli Chair comprises a wooden frame with walnut veneer and features a Loki natural upholstery and cushion.<*/
        if(preg_match('/<div class="value" itemprop="description">(.*?)<span/',$html,$preg_description)){
            $description = trim($preg_description[1]);
        }

        return $description;

    }

    /*картинки товара*/
    public function get_item_images($html){

        $images_urls = [];

        if(preg_match_all('/"full":"([^"]*)","caption"/',$html,$preg_images)){

            foreach($preg_images[1] as $image_url){
                $image_url = str_replace('\/', '/', $image_url);
                if(!in_array($image_url, $images_urls)){
                    $images_urls[] = $image_url;
                }
            }
        }

        return $images_urls;

    }

    /*атрибуты товара*/
    public function get_item_atributes($html){

        $atributes = [];

        if(preg_match_all('/<tr><th class="col label" scope="row">(.*?)<\/th><td class="col data" data-th=".*?">(.*?)<\/td><\/tr>/',$html,$preg_match_atributes)){
            foreach($preg_match_atributes[1] as $key=>$atribute_name){
                $atributes[trim($atribute_name)] = $preg_match_atributes[2][$key];
            }
        }

        if(preg_match('/<div class="product-item-info finish"> <p>(.*?)<\/p><\/div>/',$html,$preg_match_atribute_color)){
            $atributes['Colour'] = $preg_match_atribute_color[1];
        }

        if(preg_match('/<div class="portal-dimensions measurement-cm">(.*?)<\/div>/',$html,$preg_match_dimensions_cm)){
            $atributes['Dimensions cm'] = $preg_match_dimensions_cm[1];
        }

        if(preg_match('/<div class="portal-dimensions measurement-inch">(.*?)<\/div>/',$html,$preg_match_dimensions_inch)){
            $atributes['Dimensions inch'] = $preg_match_dimensions_inch[1];
        }

        return $atributes;

    }

    /*ранее спарсенные продукты*/
    public function get_products_loaded(){

        $products_loaded = [];

        $file = $this->construct_dir('./results/'.$this->site).'/items.csv';

        if(file_exists($file)){
            $csv_text = file_get_contents($file);
            if($csv_text!=''){
                $products_loaded = call_user_func_array([$this->static_class_csv,'csv2array'],[$csv_text]);
            }
        }

        if(count($products_loaded)>0){

            $products_loaded_by_id = [];

            /*индексируем на настоящий id*/
            foreach($products_loaded as $product){
                $products_loaded_by_id[$product['Id']] = [
                    'Id'         => $product['Id'],
                    'Name (Eng)' => $product['Name (Eng)'],
                    'Category'   => $product['Category'],
                    'Url'        => $product['Url'],
                ];
            }

            return $products_loaded_by_id;

        }
        else{
            return [];
        }

    }

    /*сохраняем остаток*/
    public function save_product_quantitys($product, $quantitys){

        $file = $this->construct_dir('./results/'.$this->site).'/quantitys.csv';

        /*прошлые данные*/
        if(!is_array($this->products_quantitys)){
            $this->products_quantitys = [];
            if(file_exists($file)){
                $csv_text = file_get_contents($file);
                if($csv_text!=''){
                    $this->products_quantitys = call_user_func_array([$this->static_class_csv,'csv2array'],[$csv_text]);
                }
            }
        }

        /*ищем прошлые данные*/
        $product_key = false;
        if(count($this->products_quantitys)>0){
            foreach($this->products_quantitys as $key=>$product_quantitys){
                if($product_quantitys['Id'] == $product['Id']){
                    $product_key = $key;
                    break;
                }
            }
        }

        /*сохраняем*/
        if($product_key!==false){
            $this->products_quantitys[$product_key][$this->get_time('dd.MM.YY')] = $quantitys;
        }
        else{
            /*новая запись*/
            $product[$this->get_time('dd.MM.YY')] = $quantitys;
            $this->products_quantitys[] = $product;
        }

        $csv_text = call_user_func_array([$this->static_class_csv,'array2csv'],[$this->products_quantitys]);

        file_put_contents($file,$csv_text);

    }

    /*получение времени*/
    public function get_time($format){
        return $this->class_time->toString($format);
    }

    /*запись лога в файл*/
    public function save_log_to_file($type,$message){

        $dir = $this->construct_dir('./results/'.$this->site);
        $file = $dir.'/log_'.$type.'_'.$this->get_time('dd.MM.YYYY').'.txt';
        $text = $this->get_time('HH:mm').' '.$message.PHP_EOL;

        file_put_contents($file,$text,FILE_APPEND | LOCK_EX);

    }

}


/*команды*/
class association extends service{
    public $site, $user_agent,$products_loaded, $static_class_csv, $static_class_jsoup, $class_time, $class_locale, $class_time_format;

    /*формирование общих данных*/
    public function __construct(){
        $this->site = 'www.site1.com';
        $this->user_agent = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.132 YaBrowser/20.3.1.197 Yowser/2.5 Safari/537.36';
        $this->static_class_csv = 'app\modules\CSV';
        $this->static_class_jsoup = 'php\jsoup\Jsoup';
        $this->class_locale = new \php\util\Locale('En', 'En');
        $this->class_time = new \php\time\Time();
        $this->class_time_format = new \php\time\TimeFormat('dd MMMM yyyy', $this->class_locale);
        $this->products_loaded = $this->get_products_loaded();
    }

    /*парсинг каталога*/
    public function parse_catalog($url_category, $page = 1){

        $url = $url_category . '?p=' . $page;

        $html = $this->get_html($url,'parse_catalog');

        if($html){

            /*товары*/
            $products = $this->get_catalog_products($html);

            if(count($products)>0){
                /*выставляем категорию*/
                $category = $this->get_catalog_category($html);
                foreach($products as $product_url=>$product_data){
                    $products[$product_url]['Category'] = $category;
                }
                /*парсим остаток*/
                foreach($products as $product_url=>$product_data){
                    if(isset($this->products_loaded[$product_data['Id']])){
                        $quantitys = $this->parse_quantitys($product_data['Id']);
                        if($quantitys!=false){
                            $this->save_product_quantitys($this->products_loaded[$product_data['Id']],$quantitys);
                        }
                    }
                }
            }
            else{
                $this->save_log_to_file('parse_catalog','не найдено "products" для '.$url);
            }

            /*кол-во страниц*/
            $count_pages = $this->get_catalog_count_pages($html);

            return [
                'products'    => $products,
                'count_pages' => $count_pages
            ];
        }
        else{
            return false;
        }

    }

    /*парсинг товара*/
    public function parse_item($url,$data){

        $html = $this->get_html($url,'parse_item');

        if($html){
            /*название на английском*/
            $data['Name (Eng)'] = $this->get_item_name_eng($html);

            if($data['Name (Eng)'] == ''){
                $this->save_log_to_file('parse_item','не найден "name (eng)" для '.$url);
            }

            /*описание*/
            $data['Description'] = $this->get_item_description($html);

            if($data['Description'] == ''){
                $this->save_log_to_file('parse_item','не найден "description" для '.$url);
            }

            /* атрибуты*/
            $atributes = $this->get_item_atributes($html);

            if(count($atributes)>0){
                foreach($atributes as $atribute_name=>$atribute_data){

                    $atribute_datas = explode('|',$atribute_data);

                    if(count($atribute_datas)>1){
                        foreach($atribute_datas as $key=>$atribute_data_in){
                            $data['Atribute ('.$atribute_name.') ('.($key+1).')'] = trim($atribute_data_in);
                        }
                    }
                    else{
                        $data['Atribute ('.$atribute_name.') (1)'] = $atribute_data;
                    }

                    if($atribute_name == 'Dimensions cm'){
                        $dimensions = $this->forming_dimensions_by_size_types($atribute_data,$data);
                        if(count($dimensions)>0){
                            foreach($dimensions as $dimension_name=>$dimension_value){
                                $data['Size ('.$dimension_name.')'] = trim($dimension_value);
                            }
                        }
                    }

                }

            }
            else{
                $this->save_log_to_file('parse_item','не найдены "atributes" для '.$url);
            }

            /*картинки*/
            $images = $this->get_item_images($html);

            if(count($images)>0){
                foreach($images as $image_key=>$image_url){

                    $image_key = $image_key + 1;

                    $data['Images (Url) ('.$image_key.')'] = $image_url;

                    $image_url_local = $this->parse_image($data['Id'],$image_url);

                    if($image_url_local){
                        $data['Images (Preload) ('.$image_key.')'] = $image_url_local;
                    }
                    else{
                        $data['Images (Preload) ('.$image_key.')'] = '';
                        $this->save_log_to_file('parse_item','не загружена "image preload" для '.$image_url);
                    }
                }
            }
            else{
                $this->save_log_to_file('parse_item','не найдены "Images (Preload)" для '.$url);
            }

            return $data;
        }
        else{
            return false;
        }

    }

    /*парсинг картинки*/
    public function parse_image($item_id,$image_url){

        /*готовим папки*/
        $dir = $this->construct_dir('./results/'.$this->site);
        $dir_image = $this->construct_dir('/images_preload/' . $this->preparate_string_to_latin($item_id),$dir);

        /*готовим название*/
        $ext = explode(".", $image_url)[(count(explode(".", $image_url)) - 1)];
        $url_local = $dir_image . '/' . md5($image_url).'.'.$ext;

        /*если такой уже есть*/
        if(file_exists($url_local)){
            return $url_local;
        }
        else{

            /*загружаем картинку*/
            $image_data = $this->get_data($image_url,'parse_image');

            if($image_data!=false){
                file_put_contents($dir.$url_local,$image_data);
                return $url_local;
            }
            else{
                return false;
            }
        }

    }

    /*парсинг количества*/
    public function parse_quantitys($product_id){

        /*загружаем данные*/
        $json = $this->get_html('https://www.site1.com/en/site1_catalog/ajax/atpinventory/?sku='.$product_id.'&quantity=99999999999999999','parse_quantitys');

        if($json){
            if(!preg_match('atprows',$json)){
                $this->save_log_to_file('parse_quantitys','no search atprows on product '.$product_id);
            }
            else{
                /*получение остатков*/
                $current_stock = $this->get_item_current_stock($json);

                return $current_stock;
            }
        }
        else{
            return false;
        }

    }

}

?>
    
  
