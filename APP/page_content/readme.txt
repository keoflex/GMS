PAGE_CONTENT INFO

This section is how pages are called.  You Call FOLDER-file ie
USER-list

.php is then  appended to the name so dashboard.php knows what file needs to be accessed

if USER-list is called the system will 
include "./page_content/USER/list.php";

All pages in these sections will act as if they are in the root directory in regards to js and CSS

All pages can have custom header items by simply creating a new php file with header_ in front of the name.
ie...
header_list.php will be the header file for list.php