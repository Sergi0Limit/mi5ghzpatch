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
    //var_dump($_FILES["fileToUpload"]);
    $target_dir = dirname(__FILE__) . "/upload/";
    $target_dir_orig = dirname(__FILE__) . "/orig/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["tmp_name"]) . ".bin";
    $offset_file = dirname(__FILE__) . "/bin/offset.bin";
    $pInfo = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
//        $uploadOk = 1;
//        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
//        var_dump($pInfo);
    if (strtolower($pInfo) !== "bin") {
        echo "<h5>Ваш файл имеет расширение отличное от '.BIN'</h5>";
        exit();
    }
    if ($_FILES["fileToUpload"]["size"] > 65536) {
        echo "<h5>Файл слишком больщой</h5>";
        exit();
    }

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $fileSize = filesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($fileSize == 65536) {
            echo "<h5>Размер файла ОК</h5>";
        } else {
            echo "<h5>Размер файла не соответствует 65536 байт</h5>";
            exit();
        }
        $handle = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
        fseek($handle, hexdec("8004"));
        $mac = fread($handle, 6);
        fseek($handle, hexdec("803a"));
        $RFOffset = fread($handle, 1);
        fseek($handle, hexdec("809E"));
        $XTAL9E = fread($handle, 1);
        fseek($handle, hexdec("809F"));
        $XTAL9F = fread($handle, 1);

        fclose($handle);
        ?>
        <h3>Ваш MAC адрес <?php echo strtoupper(bin2hex($mac)) ?></h3>
        <h3>Ваш RF
            Offset <?php echo strtoupper(bin2hex($RFOffset)) . ' ' . strtoupper(bin2hex($XTAL9E)) . ' ' . strtoupper(bin2hex($XTAL9F)) ?></h3>

        <h5>Патчим...</h5>
        <?php
        $handle = fopen($target_file, "w+");
        $handle_read = fopen($_FILES["fileToUpload"]["tmp_name"], "r");
        $handle_read_offset = fopen($offset_file, "r");
//    var_dump($handle);var_dump($handle_read);
        $idx = 0;
        $content = '';
        $read_count = 1;
        while (true) {
            if ($idx > $fileSize)
                break;
            fseek($handle_read, $idx);
            $content = fread($handle_read, 1);
            if ($idx >= hexdec("8000") && $idx < hexdec("8000") + 512) {
//                echo "/".dechex($idx)."/";
                $read_count = 1;
                fseek($handle_read_offset, $idx - hexdec("8000"));
                $content = fread($handle_read_offset, 1);
            }
            if ((int)$_POST["variant"] == 3) {
                if ($idx == hexdec("8045") || $idx == hexdec("8049") || $idx == hexdec("804D")) {
                    $content = chr(0);
                }
            } else
                if ($idx == hexdec("8004")) {
                    $read_count = 6;
//                $content = fread($handle_read, $read_count);
                    $content = $mac;
                } else
                    if ($idx == hexdec("803a")) {
                        $read_count = 1;
//                    $content = fread($handle_read, $read_count);
                        $content = $RFOffset;
                    } else
                        if ($idx == hexdec("809e")) {
                            $read_count = 1;
//                    $content = fread($handle_read, $read_count);
                            $content = $XTAL9E;
                        } else
                            if ($idx == hexdec("809f")) {
                                $read_count = 1;
//                    $content = fread($handle_read, $read_count);
                                $content = $XTAL9F;
                            } else {
                                $read_count = 1;
//                        $content = fread($handle_read, $read_count);
                            }
            fwrite($handle, $content);
            $idx += $read_count;
        }
        fclose($handle);
        fclose($handle_read);
        fclose($handle_read_offset);
        copy($_FILES["fileToUpload"]["tmp_name"], $target_dir_orig . basename($_FILES["fileToUpload"]["tmp_name"]) . ".bin")
        ?>
        <h5>Готово...</h5>

        <ff><a href="upload/<?php echo basename($_FILES["fileToUpload"]["tmp_name"]) . ".bin" ?>"><i
                    class="tt"></i><span>Скачать</span></a>
        </ff>
        <?php
    }
}