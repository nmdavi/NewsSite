<?php
require_once 'Source/Models/Article.php';
require_once 'Source/Models/Author.php';
$obj_article = new Article();

$grand_article = $obj_article->findAll(null, 2);
$medium_article = $obj_article->findAll(null, 3);
$tech_article = $obj_article->findAll("fk_category = '2'", 8);
$sport_article = $obj_article->findAll("fk_category = '3'", 8);
$culture_article = $obj_article->findPreviewResume(5);
$last_article = $obj_article->findPreviewResume(7);
$all_article = $obj_article->findPreviewResume(6);
?>

<?php
require_once 'Source/Layout/part1.php';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/index.css">';
echo '<link rel="stylesheet" type="text/css" href="Source/Styles/slideshow.css">';
require_once 'Source/Layout/part2.php';
?>

<div class="content" onmousemove="closeMenu()">

    <section class="news">

        <section class="first-content">
            <?php foreach ($grand_article as $item) : ?>

            <div class="first-padding">
                <a href="Read.php?num_news=<?php print $item["id"] ?>">
                    <div class="grand-notice">
                        <img class="grand-image" alt="<?php print $item["title"] ?>"
                            src="Source\Images\Article\Big\<?php print $item['image'] ?>">
                        <a href="Read.php?num_news=<?php print $item["id"] ?>">
                            <h2 class="grand-title"><?php print $item["title"] ?></h2>
                        </a>
                        <div class="news-author">
                            <a href="#">
                                <img class="news-image" alt=""
                                    src="Source\Images\Article\Medium\<?php print $item['image'] ?>">
                            </a>
                            <div class="news-container">
                                <a href="#" class="a-name">
                                    <span class="news-name"><?php print $item['name'] ?></span>
                                </a>
                                <br>
                                <span class="news-date"><?php print $item['date'] ?></span>
                            </div>
                        </div>

                    </div>
                </a>
            </div>

            <?php endforeach; ?>

        </section>
        <section class="second-content">
            <?php foreach ($medium_article as $item) : ?>
            <div class="second-padding">
                <a href="Read.php?num_news=<?php print $item["id"] ?>">
                    <div class="medium-notice">
                        <img class="medium-image" alt="<?php print $item["title"] ?>"
                            src="Source\Images\Article\Medium\<?php print $item['image'] ?>">
                        <h4 class="medium-title"><?php print $item["title"] ?></h4>
                        <div class="news-author">
                            <a href="#">
                                <img class="news-image" alt=""
                                    src="Source\Images\Author\<?php print $item['au_img'] ?>">
                            </a>
                            <div class="news-container">
                                <a href="#" class="a-name">
                                    <span class="news-name"><?php print $item['name'] ?></span>
                                </a>
                                <br>
                                <span class="news-date"><?php print $item['date'] ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </section>
    </section>

    <hr class="divider">

    <section class="news">
        <section class="third-content">
            <div class="content-line">
                <h2 class="title-content black">TECH</h2>
                <div class="first-line backblack"></div>
                <hr class="second-line">
            </div>
            <br>
            <section class="slideshow">
                <button class="left-button" onclick="move( '#slide1')">&#10094;</button>
                <?php foreach ($tech_article as $item => $value) : ?>
                <?php $item === 0 || $item === 4 ? print '<div class="slide" id="slide1">' : ''; ?>

                <div class="third-padding">
                    <a href="Read.php?num_news=<?php print $value["id"]; ?>">
                        <div class="small-notice">
                            <img class="small-image" alt="<?php print $item["title"] ?>"
                                src="Source\Images\Article\Small\<?php print $value['image'] ?>">
                            <h5 class="small-title"><?php print $value['title'] ?></h5>
                            <div class="news-author">
                                <a href="#">
                                    <img class="news-image" alt="<?php print $value['name'] ?>"
                                        src="Source\Images\Article\Medium\<?php print $value['image'] ?>">
                                </a>
                                <div class="news-container">
                                    <a href="#" class="a-name">
                                        <span class="news-name"><?php print $value['name'] ?></span>
                                    </a>
                                    <br>
                                    <span class="news-date"><?php print $value['date'] ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <?php $item === 3 || $item === 7 ? print '</div>' : ''; ?>
                <?php endforeach; ?>

                <button class="right-button" onclick="move( '#slide1')">&#10095;</button>
            </section>
        </section>
    </section>

    <hr class="divider">

    <section class="news">

        <aside class="fourth-content">
            <div class="content-line">
                <h2 class="title-content red">CULTURE</h2>
                <div class="first-line backred"></div>
                <hr class="second-line">
            </div>
            <br>

            <?php foreach ($culture_article as $item) : ?>

            <div class="small-padding">
                <a href="Read.php?num_news=<?php print $item["id"] ?>">
                    <div class="small-notice">
                        <img class="small-image" alt="<?php print $item["title"] ?>"
                            src="Source\Images\Article\Small\<?php print $item["image"] ?>">
                        <h5 class="small-title"><?php print $item["title"] ?></h5>
                        <div class="news-author">
                            <a href="#">
                                <img class="news-image" alt="<?php print $item["name"] ?>"
                                    src="Source\Images\Article\Small\<?php print $item["au_img"] ?>">
                            </a>
                            <div class="news-container">
                                <a href="#" class="a-name">
                                    <span class="news-name"><?php print $item["name"] ?></span>
                                </a>
                                <br>
                                <span class="news-date"><?php print $item["date"] ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <br>

            <?php endforeach; ?>
        </aside>

        <section class="fifth-content">
            <div class="content-line">
                <h2 class="title-content red">LATEST NEWS</h2>
                <div class="first-line backred"></div>
                <hr class="second-line">
            </div>


            <?php foreach ($last_article as $item) : ?>

            <div class="long-content">
                <a href="Read.php?num_news=<?php print $item["id"] ?>">
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

            <div class="button-content clear-none">
                <a href="Pages.php?category=0&num=1">
                    <button class="more-button">MORE NEWS</button>
                </a>
            </div>

        </section>
    </section>

    <hr class="divider">

    <section class="news">
        <section class="third-content">
            <div class="content-line">
                <h2 class="title-content black">SPORT</h2>
                <div class="first-line backblack"></div>
                <hr class="second-line">
            </div>
            <br>
            <section class="slideshow">
                <button class="left-button" onclick="move( '#slide2')">&#10094;</button>

                <?php foreach ($sport_article as $item => $value) : ?>
                <?php $item === 0 || $item === 4 ? print '<div class="slide" id="slide2">' : ''; ?>

                <div class="third-padding">
                    <a href="Read.php?num_news=<?php print $value["id"]; ?>">
                        <div class="small-notice">
                            <img class="small-image" alt="<?php print $value['name'] ?>"
                                src="Source\Images\Article\Small\<?php print $value['image'] ?>">
                            <h5 class="small-title"><?php print $value['title'] ?></h5>
                            <div class="news-author">
                                <a href="#">
                                    <img class="news-image" alt="<?php print $value['name'] ?>"
                                        src="Source\Images\Author\<?php print $value['au_img'] ?>">
                                </a>
                                <div class="news-container">
                                    <a href="#" class="a-name">
                                        <span class="news-name"><?php print $value['name'] ?></span>
                                    </a>
                                    <br>
                                    <span class="news-date"><?php print $value['date'] ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <?php $item === 3 || $item === 7 ? print '</div>' : ''; ?>
                <?php endforeach; ?>

                <button class="right-button" onclick="move( '#slide2')">&#10095;</button>
            </section>
        </section>
    </section>

    <hr class="divider">

    <section class="news">
        <section class="seventh-content">
            <div class="content-line">
                <h2 class="title-content red">MORE NEWS</h2>
                <div class="first-line backred"></div>
                <hr class="second-line">
            </div>
            <br>

            <?php foreach ($all_article as $item) : ?>

            <div class="seventh-padding">
                <a href="Read.php?num_news=<?php print $item["id"] ?>">
                    <div class="last-notice">
                        <img class="last-image" src="Source\Images\Article\Medium\<?php print $item['image'] ?>"
                            alt="<?php print $item['title'] ?>">
                        <h4 class="last-title"><?php print $item['title'] ?></h4>
                        <div class="last-resume">
                            <?php print $item['text'] ?>
                        </div>
                        <div class="last-content">
                            <div class="news-author">
                                <a href="#">
                                    <img class="long-news-image"
                                        src="Source\Images\Author\<?php print $item['au_img'] ?>"
                                        alt="<?php print $item['name'] ?>">
                                </a>
                                <div class="long-news-container">
                                    <a href="#" class="a-name">
                                        <span class="long-news-name"><?php print $item['name'] ?></span>
                                    </a>
                                    <br>
                                    <span class="long-news-date"><?php print $item['date'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <?php endforeach; ?>


            <div class="button-content">
                <a href="Pages.php?category=0&num=1">
                    <button class="more-button">MORE NEWS</button>
                </a>
            </div>
        </section>
    </section>

    <script src="Source/Scripts/slideshow.js"></script>
    <?php require_once 'Source/Layout/part3.php'; ?>