<?php include("includes/header.php");
if (isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location: index.php");
}

$album = new Album($con, $albumId);
$artist = $album->getArtist();
?>

<div class="entityInfo">
    <div class="leftSection">
        <img src="<?= $album->getArtworkPath(); ?>" alt="" class="">
    </div>
    <div class="rightSection">
        <h2><?= $album->getTitle(); ?></h2>
        <p>By <?= $artist->getName(); ?></p>
        <p><?= $album->getNumberOfSongs(); ?> songs</p>
    </div>
</div>

<div class="tracklistContainer">
    <ul class="tracklist">
        <?php
        $songIdArray = $album->getSongIds();

        $i = 1;
        foreach ($songIdArray as $songId) {

            $albumSong = new Song($con, $songId);
            $albumArtist = $albumSong->getArtist();
            echo "<li class='tracklistRow'>
                <div class='trackCount'>
                    <img src='assets/images/icons/play-white.png' alt='Play' class='play'>
                    <span class='trackNumber'>$i</span>
                </div>
                <div class='trackInfo'>
                    <span class='trackName'>" . $albumSong->getTitle() . "
                    </span>
                    <span class='artistName'>" . $albumArtist->getName() . "</span>
                </div>

                <div class='trackOptions'>
                    <img class='optionsButton' src='assets/images/icons/more.png' alt='More options'>
                </div>

                <div class='trackDuration'>
                    <span class='duration'>" . $albumSong->getDuration() . "</span>
                </div>
            </li>
            ";

            $i++;
        }
        ?>
    </ul>
</div>

<?php include("includes/footer.php"); ?>