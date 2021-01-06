<?php 
include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 

$vanila_mode = false;

        #Вернём значение title для страниц
        function tm_optTitlePage($arr){
            switch($arr[1]){
                case 'news':
                        return 'Новости ветклиники ЮнаВет — свежая информация о нововведениях и питомцах📰';
                    break;
                case 'useful':
                        return 'Полезная информация для заботы о питомцах от специалистов ветклиники ЮнаВет🐈';
                    break;
                default:
                        return null;
                    break;
            }
        }
        
        #Вернём значение title для постов 
        function tm_optTitlePost($arr){
              switch($arr[1]){
                case 'news':
                        return 'H1 📰 новости ветклиники ЮнаВет🐈';
                    break;
                case 'useful':
                        return 'H1— полезные советы от специалистов ветклиники ЮнаВет🐈';
                    break;
                default:
                       return null;
                    break;
            }
        }
        
        #Функция для замены title страницы, $arr = Array
        function tm_setTitlePage($arr){
            $tmp = $arr;
            
            #Разбиваем входящий uri и приводим к массиву.
            $uri = array_filter(preg_split('/[\/]+/',$_SERVER['REQUEST_URI']));
            
            #если главная страница выходим из функции с исходными параметрами
            if(count($uri) === 0) 
                    return $arr;
            
            #сравниваем глубину uri кол-вом значейний в массиве. 1 = страница, 2 = пост ...
             switch(count($uri)){
                case 1:
                            $arr = tm_optTitlePage($uri) ?? $tmp; // для yoast.SEO
                    break;
                case 2:
                            $arr = tm_optTitlePost($uri) ?? $tmp; // для yoast.SEO
                    break;
                default:
                       
                    break;
            }
            
            return $arr;
        }

        #проверка на активность плагина yoast.SEO
        if(is_plugin_active('wordpress-seo/wp-seo.php'))
            add_filter( 'wpseo_title', 'tm_setTitlePage'); // для yoast.SEO
      