<?php
/**
 * Created by PhpStorm.
 * User: smuravjev
 * Date: 8/4/15
 * Time: 21:21
 */
if (isset($_FILES["fileToUpload"])) {
    /**
     * Created by PhpStorm.
     * User: smuravjev
     * Date: 7/15/15
     * Time: 08:50
     */
    $target_dir = dirname(__FILE__) . "/upload/";
    $target_dir_orig = dirname(__FILE__) . "/orig/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["tmp_name"]) . ".bin";
    $offset_file = dirname(__FILE__) . "/bin/offset.bin";
    $pInfo = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
    if (strtolower($pInfo) !== "bin") {
        echo "<h5>Ваш файл имеет расширение отличное от '.BIN'</h5>";
        exit();
    }
    if ($_FILES["fileToUpload"]["size"] > 65536) {
        echo "<h5>Файл слишком больщой</h5>";
        exit();
    }

    if (isset($_POST["submit"])) {
        $fileSize = filesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($fileSize == 65536) {
            echo "<h5>Размер файла ОК</h5>";
        } else {
            echo "<h5>Размер файла не соответствует 65536 байт</h5>";
            exit();
        }
        $handle = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
        fclose($handle);
        ?>
        <h5>Патчим...</h5>
        <?php
        $handle = fopen($target_file, "w+");
        $handle_read = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
        $idx = 0;
        $content = '';
        $read_count = 1;
        while (true) {
            if ($idx > $fileSize)
                break;
            fseek($handle_read, $idx);
            $content = fread($handle_read, 1);
            if ($idx == hexdec("8045") || $idx == hexdec("8049") || $idx == hexdec("804D")) {
                $content = chr(0);
            }

            fwrite($handle, $content);
            $idx += $read_count;
        }
        fclose($handle);
        fclose($handle_read);
        copy($_FILES["fileToUpload"]["tmp_name"], $target_dir_orig . basename($_FILES["fileToUpload"]["tmp_name"]) . ".bin")
        ?>
        <h5>Готово...</h5>

        <ff><a href="upload/<?php echo basename($_FILES["fileToUpload"]["tmp_name"]) . ".bin" ?>"><i
                    class="tt"></i><span>Скачать</span></a>
        </ff>
        <?php
    }
}