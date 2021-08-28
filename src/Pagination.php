<?php
namespace Vudev\Page;

class Pagination {
    protected $current_page;
    protected $count;
    protected $page_count;
    protected $views_page;
    protected $route;
    protected $query_key;
    protected $temps;

    public function __construct($data)
    {
        $this->current_page = ($data['current_page']) ? (int)$data['current_page'] : 1;
        $this->count = (int)$data['count'];
        $this->page_count = ($data['page_count']) ? (int)$data['page_count'] : 25;
        $this->views_page = ($data['views_page']) ? (int)$data['views_page'] : 5;
        $this->query_key = (iconv_strlen($data['query_key'])) ? $data['query_key'] : 'page';
        $this->temps = (isset($data['temps']) && sizeof($data['temps'])) ? $data['temps'] : array();

        if (!isset($this->temps['start_text'])) $this->temps['start_text'] = 'В начало';

        if (!isset($this->temps['next_text'])) $this->temps['next_text'] = 'дальше';

        $this->temps['classes']['linkpage'] = 'pagination_linkpage';
        $this->temps['classes']['current'] = 'pagination_linkpage_current';
        $this->temps['classes']['start'] = 'pagination_start';
        $this->temps['classes']['next'] = 'pagination_next';

        if (isset($data['temps']['classes']) && sizeof($data['temps']['classes'])) {
            foreach ($data['temps']['classes'] as $key => $val) {
                if (iconv_strlen($val)) {
                    if (array_key_exists($key, $this->temps['classes'])) $this->temps['classes'][$key] = $val;
                }
            }
        }
    }

    protected function num_pages()
    {
        return ceil($this->count / $this->page_count);
    }

    protected function pg_handler()
    {
        $num_pages = (int)$this->num_pages();
        $mid_view_pages = (int)ceil($this->views_page / 2);
        $page_start = 0;
        $page_end = 0;
        $html = '';

        $request_uri = parse_url($_SERVER['REQUEST_URI']);
        $req_queries = '';

        if (isset($request_uri['query']) && iconv_strlen($request_uri['query'])) {
            parse_str($request_uri['query'], $output);

            if (array_key_exists($this->query_key, $output)) unset($output[$this->query_key]);

            $req_queries = http_build_query($output);
        }

        $this->route = (iconv_strlen($req_queries)) ? $request_uri['path'].'?'.$req_queries.'&' : $request_uri['path'].'?';
        
        // Проверяем существует ли более чем одной страницы
        if ($num_pages > 1) {            
            $html .='<style>';
            
            if ($this->temps['classes']['linkpage'] === 'pagination_linkpage') {
                $html .='.'.$this->temps['classes']['linkpage'].' {
                            color: #333;
                            text-decoration: none;
                            padding: 6px 12px;
                            margin-right:10px;
                            font-size: 16pt;
                        }';
                
                $html .='.'.$this->temps['classes']['linkpage'].':hover {
                            background: #eee;
                            border-radius: 50%;
                        }';
            }

            if ($this->temps['classes']['current'] === 'pagination_linkpage_current') {
                $html .='.'.$this->temps['classes']['current'].' {
                            font-weight: bold;
                            background: #ffeba0;
                            border-radius: 50%;
                            padding: 6px 14px;
                        }';
            }

            if ($this->temps['classes']['start'] === 'pagination_start') {
                $html .='.'.$this->temps['classes']['start'].' {
                            color: #333;
                            text-decoration: none;
                            padding: 6px 12px;
                            margin-right:10px;
                            font-size: 16pt;
                        }';
            }

            if ($this->temps['classes']['next'] === 'pagination_next') {
                $html .='.'.$this->temps['classes']['next'].' {
                            color: #333;
                            text-decoration: none;
                            padding: 6px 12px;
                            margin-right:10px;
                            font-size: 16pt;
                        }';
            }

            $html .='</style>';

            // Проверяем больше ли кол-во страниц, указанной видимой
            if ($num_pages > $this->views_page) {
                // Проверяем если текущея страница в необласти видимости
                if ($this->current_page > $mid_view_pages) {
                    $page_start = $this->current_page - 2; // Начинааем нумерация с небольшим смещением от текущей страницы
                    
                    // Проверяем если конец нумерации меньше области видимости, то увеличваем нумерация (также смещая)
                    $page_end = ($page_end < $num_pages && (($this->current_page + 2) < $num_pages)) ? $this->current_page + 2 : $num_pages;
                    
                    $html .= '<a href="'.$this->route.$this->query_key.'=1" class="'.$this->temps['classes']['start'].'">'.$this->temps['start_text'].'</a> ';
                } else {
                    $page_end = $this->views_page; // Конец нумерации приравниваем к области видимости
                    $page_start = 1; // начинаем нумерцию с 1 страницы
                }
            } else {
                $page_start = 1;
                $page_end = $num_pages;
            }
            
            for ($i = $page_start; $i <= $page_end; $i++) {
                $html .= '<a href="'.$this->route.$this->query_key.'='.$i.'" class="'.$this->temps['classes']['linkpage'].(($i === $this->current_page) ? ' '.$this->temps['classes']['current']: '').'">'.$i.'</a>';
            }
            
            if ($num_pages !== $page_end && $num_pages > $this->views_page) {
                if ($this->current_page < $num_pages) $next = $this->current_page + 1;

                $html .= ' <a href="'.$this->route.$this->query_key.'='.$next.'" class="'.$this->temps['classes']['next'].'">'.$this->temps['next_text'].'</a>';
            }
        }

        return $html;
    }

    public function pg_print()
    {
        echo $this->pg_handler();
    }

    public function pg_return()
    {
        return $this->pg_handler();
    }
}