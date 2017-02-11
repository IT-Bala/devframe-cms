
Theme Structure : [IPSSA]


index.php      ====> connect_theme(); must be

section  ====> section/ header.php and footer.php

page.php     ====> Normal php code and design for home page

sub_page.php ====> sub pages

$title, $content, $date, $link

function.php ====> auto running




Admin Control :


create admin folder,

/admin/index.php ====> 

i. class must be ==> theme_admin

ii. two methods needed ==> 

         i.left_menu ==> array format

         ii. and page ==> switch format
     
         iii. Must be return values


=====================================================================
=====================================================================



Plugin Structure : [ISA]


index.php      ====> Normal php code AND DESING
short_code.txt ====> set short code ######  ex: @@test@@      #####


Admin Control :

create admin folder,

/admin/index.php ====> 

i. class ==> can be any name 

ii. two methods needed ==> 

         i.  function left_menu() ==> array format Multi dimontional array

         ii. function  page() ==> switch format for set admin page
     
         iii.Must be return values


iii. $_Global['plugin_admin'][] = "class name"; end of the part
================================================================================================================================================







Module Struture:

index.php
config.xml

======== FTP ===========
