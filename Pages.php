<?php
require_once 'Source/Models/Article.php';
require_once 'Source/Models/Author.php';
$obj_article = new Article();

$num_page = $_GET["num"] != 0 ? $_GET["num"] : die("Erro!");
$category_name = null;
foreach ($_GET as $key => $value) {
    is_int((int) $value) or die("Erro! $value");

    if ($key == "category") {

        if ($value == 0) {
            $category_num = $value;
            $article = $obj_article->pagination($num_page, null, null, null, true);
        } else {
            $category_num = $value;
            $category_name = $obj_article->findNameCategory($value, null, null);
            $article = $obj_article->pagination($num_page, $value, null, null, false);
        }
    } else if ($key == "subcategory") {
        $category_num = $value;
        $category_name = $obj_article->findNameCategory(null, $value, null);
        $article = $obj_article->pagination($num_page, null, $value, null, false);
    } else if ($key == "subsubcategory") {
        $category_num = $value;
        $category_name = $obj_article->findNameCategory(null, null, $value);
        $article = $obj_article->pagination($num_page, null, null, $value, false);
    }
}

?>

<?php
require_once 'Source/Layout/part1.php';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/layout.css">';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/index.css">';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/pages.css">';
require_once 'Source/Layout/part2.php';
?>

<section class="pages" onmousemove="closeMenu()">

    <section class="fifth-content">
        <div class="content-line">
            <h2 class="title-content red"><?php echo $category_name == null ? "LATEST" : $category_name ?></h2>
            <div class="first-line backred"></div>
            <hr class="second-line">
        </div>

        <?php foreach ($article as $item) : ?>

        <div class="long-content">
            <a href="Read.php?num_news=<?php print $item["id"]; ?>">
                <div class="long-notice">
                    <img class="long-image" alt="<?php print $item["title"] ?>"
                        src="Source\Images\Article\Small\<?php print $item["image"] ?>">
                    <h4 class="long-title"><?php print $item["title"] ?></h4>
                    <span class="long-resume">
                        <?php print $item["text"] ?>
                    </span>
                    <br>
                    <div class="long-news-author">
                        <div class="long-news-container">
                            <a href="" class="a-name">
                                <span class="long-news-name"><?php print $item["name"] ?></span>
                            </a>
                            <span class="long-news-date"><?php print $item["date"] ?></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <hr class="second-line">

        <?php endforeach; ?>

    </section>

    <?php
    if (isset($_GET["category"])) {
        if ($category_num == 0) {
            $obj_article->paginationCss($num_page, null, null, null, true);
        } else {
            $obj_article->paginationCss($num_page, $category_num, null, null, false);
        }
    } else if (isset($_GET["subcategory"])) {
        $obj_article->paginationCss($num_page, null, $category_num, null, false);
    } else if (isset($_GET["subsubcategory"])) {
        $obj_article->paginationCss($num_page, null, null, $category_num, false);
    }
    ?>
</section>

<?php require_once 'Source/Layout/part3.php'; ?>