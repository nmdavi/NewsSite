<?php
require_once 'Source/Models/Article.php';
require_once 'Source/Models/Author.php';

$obj_article = new Article();
$obj_author = new Author();
$article_id = $_GET["num_news"] or die('Erro!');

$article = $obj_article->findById($article_id);
$article_author = $obj_author->findById($article["fk_author"]);
$articles_preview = $obj_article->findPreview(3);

?>

<?php
require_once 'Source/Layout/part1.php';
print '<link rel="stylesheet" type="text/css" href="Source/Styles/read.css">';
require_once 'Source/Layout/part2.php';
?>

<div onmousemove="closeMenu()">
    <main class="article">
        <header class="article-title"><?php print $article["title"]; ?></header>
        <div class="info-author">
            <a href="#" class="link_img_author">
                <img class="author-image" alt="author"
                    src="Source/Images/Author/<?php print $article_author["image"] ?>">
            </a>
            <div class="info-container">
                <a href="#" class="a-name">
                    <span
                        class="author-name"><?php print $article_author["first_name"] . " " . $article_author["last_name"]; ?>
                    </span>
                </a>
                <br>
                <span class="info-date"><?php print $article["date"]; ?></span>
            </div>
        </div>
        <article class="article-text">
            <?php print $article["text"]; ?>
        </article>
        <footer class="article-footer">
            <a href="#"><img class="author-image" alt="author"
                    src="Source/Images/Author/<?php print $article_author["image"] ?>"></a>
            <div class="author-container">
                <a href="#" class="a-name"><span
                        class="author-name"><?php print $article_author["first_name"] . " " . $article_author["last_name"]; ?></span></a>
                <p class="author-description">
                    <?php print $article_author["description"]; ?>
                </p>
            </div>
        </footer>
    </main>
    <section class="article-content">
        <?php foreach ($articles_preview as $article_p) : ?>
        <?php $author_p = $obj_author->findById($article_p["fk_author"]); ?>
        <a href="Read.php?num_news=<?php print $article_p["id"]; ?>">
            <div class="arpreview arfirst">
                <img class="arimg" alt="Imagem" src="Source/Images/Article/Big/<?php print $article_p["image"]; ?>">
                <h3 class="artitle"><?php print $article_p["title"]; ?></h3>

                <a href="#"><img class="auimg" src="Source/Images/Author/<?php print $author_p["image"]; ?>"></a>
                <div class="aucontainer">
                    <a href="#" class="a-name">
                        <span
                            class="auname"><?php print $author_p["first_name"] . " " . $author_p["last_name"]; ?></span>
                        <br>
                    </a>
                    <span class="audate"><?php print $article_p["date"]; ?></span>
                </div>
            </div>
        </a>
        <?php endforeach; ?>
    </section>
</div>

<?php require_once 'Source/Layout/part3.php'; ?>
</div>
</body>

</html>