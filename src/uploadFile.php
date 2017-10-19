<?php
/**
 * Created by PhpStorm.
 * User: wilder2
 * Date: 12/10/17
 * Time: 10:24
 */

class uploadFile
{
    const MB = 1000000;
    function upload(array $infoFiles)
    {
        $infoFiles = current($infoFiles);
        $allowedExtensions = ['jpg', 'png', 'gif'];

        foreach ($infoFiles['name'] as $f => $name) {
            $errors = [];

            if (!in_array(pathinfo($name, PATHINFO_EXTENSION), $allowedExtensions)) {
                $errors['type'] = "Le type de fichier n'est pas valide !";
            }

            if ($infoFiles['size'][$f] > self::MB) {
                $errors['size'] = "le fichier est trop volumineux";
            }

            if (count($errors) == 0) {
                $oldName = $name;
                $name = "image" . uniqid() . "." . pathinfo($name, PATHINFO_EXTENSION);
                move_uploaded_file($infoFiles['tmp_name'][$f], 'upload/' . $name);
                echo "Téléchargement de $oldName réussi ! </br>";
            } else {
                foreach ($errors as $error) {
                    echo $error . '</br>';
                }
            }
        }
    }
}
