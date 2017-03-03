<?php
 create handle for new PDF document $pdf = pdf_new();

 open a file pdf_open_file($pdf, "letterhead.pdf");

 start a new page (A4) pdf_begin_page($pdf, 595, 842);

 get and use a font object $arial = pdf_findfont($pdf, "Arial", "host", 1); pdf_setfont($pdf, $arial, 12);

 set a colour for the line pdf_setcolor($pdf, "stroke", "rgb", 0, 0, 0);

 place a logo in the top left corner $image = pdf_open_image_file($pdf, "jpeg", "logo.jpg"); pdf_place_image($pdf, $image, 50, 785, 0.5);

 draw a line under the logo pdf_moveto($pdf, 20, 780);
pdf_lineto($pdf, 575, 780);
pdf_stroke($pdf);

 draw another line near the bottom of the page pdf_moveto($pdf, 20, 50); pdf_lineto($pdf, 575, 50); pdf_stroke($pdf);

 and write some text under it pdf_show_xy($pdf, "Confidential and proprietary", 200, 35);

 end page pdf_end_page($pdf);

 close and save file pdf_close($pdf);
?>