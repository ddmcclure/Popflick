<?php
include_once "header.php";
?>

<h1><strong>Welcome to Popflick's Movie Catalog</strong></h1>
<h2>Please chose your browsing exprinces!</h2>
<br>

<img src="/img/popcorn.svg" class="center">
<br>
<a href="browseCat.php"><button>Browse by Catgory</button></a>

<br>

<img src="/img/popcorn.svg" class="center">
<br>
<a href="browseYear.php"><button>Browse by year</button></a>

<br>

<img src="/img/popcorn.svg" class="center">
<br>
<a href="browseAll.php"><button>Browse All</button></a>

<br>

<?php
	if (isset($_SESSION['emp_id'])) {
		<img src="/img/popcorn.svg" class="center">
		<br>
		<a href="EditCat.php"><button>Edit Catalog</button></a>
	}

include_once "footer.php";

