<?php
$output .= '<div class="d-flex flex-row"><div class="p-1"><ul class="pagination pagination-sm">';
// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $output .= '<li p="1" class="page-item active"><a p="1" class="page-link" href="#">В начало</a></li>';
} else if ($first_btn) {
    $output .= '<li p="1" class="page-item disabled"><a p="1" class="page-link" href="#">В начало</a></li>';
}
// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $output .= '<li p='.$pre.' class="page-item active"><a p='.$pre.' class="page-link" href="#">Предыдущая</a></li>';
} else if ($previous_btn) {
    $output .= '<li p='.$cur_page.' class="page-item disabled"><a p='.$cur_page.' class="page-link" href="#">Предыдущая</a></li>';
}

for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $output .= '<li p='.$i.'  class="page-item active"><a p='.$i.' class="page-link" href="#">'.$i.'</a></li>';
    else
        $output .= '<li p='.$i.' class="page-item"><a p='.$i.' class="page-link" href="#">'.$i.'<span class="sr-only">(current)</span></a></li>';

}
// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $output .= '<li p='.$nex.' class="page-item active"><a p='.$nex.' class="page-link" href="#">Следующая</a></li>';
} else if ($next_btn) {
    $output .= '<li class="page-item disabled"><a p='.$cur_page.' class="page-link" href="#">Следующая</a></li>';
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $output .= '<li p='.$no_of_paginations.' class="page-item active"><a p='.$no_of_paginations.' class="page-link" href="#">Последняя</a></li>';
} else if ($last_btn) {
    $output .= '<li p='.$no_of_paginations.' class="page-item disabled"><a p='.$no_of_paginations.' class="page-link" href="#">Последняя</a></li>';
}
$output .= '</ul></div>';
$total_string = '<div class="p-1"><span class="total" a='.$no_of_paginations.'>Страница <b>' . $cur_page . '</b> из <b>'.$no_of_paginations.'</b></span></div></div>';

$output .=$total_string;  // Content for pagination
// ?>