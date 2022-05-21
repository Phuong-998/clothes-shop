<?php

namespace app\coment;

class Pagination
{
    public function createLink($dataLink = [])
    {
        $link = '';
        foreach ($dataLink as $key => $value) {
            $link .= empty($link) ? 'index.php?' . $key . '=' . $value . '' : '&' . $key . '=' . $value . '';
        }

        return $link;
    }

    public function creatPagination($link, $totalProduct, $page, $limit)
    {
        $totalPage = ceil($totalProduct / $limit);

        if ($page < 1) {
            $page = 1;
        } elseif ($page > $totalPage) {
            $page = $totalPage;
        }

        $start = ($page - 1) * $limit;

        $htmlPage = '';
        $htmlPage .= '<nav>';
        $htmlPage .= '<ul class="pagination">';

        if ($page > 1 && $page <= $totalPage) {
            $htmlPage .= '<li class="page-item">';
            $htmlPage .= '<a class="page-link" href="' . str_replace('{trang}', ($page - 1), $link) . '"><i class="fa-solid fa-arrow-left-long"></i></a>';
            $htmlPage .= '</li>';
        }

        for ($i = 1; $i <= $totalPage; $i++) {
            if ($page == $i) {
                // dang o trang active - hien tai
                $htmlPage .= '<li class="page-item active" aria-current="page">';
                $htmlPage .= '<a class="page-link">' . $page . '</a>';
                $htmlPage .= '</li>';
            } else {
                if ($i <= $page + 2 && $i >= $page - 2) {
                    $htmlPage .= '<li class="page-item"><a class="page-link" href="' . str_replace('{trang}', $i, $link) . '">' . $i . '</a></li>';
                }
            }
        }

        if ($page < $totalPage && $page >= 1) {
            $htmlPage .= '<li class="page-item">';
            $htmlPage .= '<a class="page-link" href="' . str_replace('{trang}', ($page + 1), $link) . '"><i class="fa-solid fa-arrow-right-long"></i></a>';
            $htmlPage .= '</li>';
        }
        $htmlPage .= '</ul>';
        $htmlPage .= '</nav>';

        return [
            'start' => $start,
            'totalPage' => $totalPage,
            'html' => $htmlPage
        ];
    }
}
