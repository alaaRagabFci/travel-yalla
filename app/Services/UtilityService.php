<?php
/**
 * Created by PhpStorm.
 * User: alaa
 * Date: 17/07/20
 * Time: 03:52 ص
 */

namespace App\Services;


class UtilityService
{
    private $validExtensions;

    /**
     * utility service constructor
     */
    public function __construct()
    {
        $this->validExtensions = array("jpg", "JPG", "png", "PNG", "jpeg", "JPEG", "GIF", "gif", "webp", " WEBP", "svg", "SVG");
    }

    /**
     * Upload image.
     * @param string $image
     * @param string $type
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function upload(array $parameters): array
    {
        $file = $parameters['image'];
        $errors = [];
        // Check file size
        if ($file->getSize() > 5000000) {
            $errors[] = "Sorry, your file is too large.";
        }

        $extension = $file->getClientOriginalExtension();

        // Allow certain file formats
        if (!in_array($extension, $this->validExtensions)) {
            $errors[] = $file->getClientOriginalExtension() . " extension not allowed, only JPG, JPEG, PNG, GIF, SVG, WEBP files are allowed.";
        }

        // Check if erros is greater than 0
        if (count($errors) > 0) {
            return array('status' => false, 'errors' => $errors);
        } else {
            $filename = time() . $file->getClientOriginalName();
            $file->move('uploads/' . $parameters['type'] . '/', $filename);
            $filePath = 'uploads/' . $parameters['type'] . '/' . $filename;
            return array('status' => true, 'file' => $filePath);
        }
    }

}