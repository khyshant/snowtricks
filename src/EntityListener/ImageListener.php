<?php

namespace App\EntityListener;

use App\Entity\Image;

/**
 * Class ImageListener
 * @package App\EntityListener
 */
class ImageListener
{
    /**
     * @var string
     */
    private $uploadDirAbsolutePath;

    /**
     * ImageListener constructor.
     * @param string $uploadDirAbsolutePath
     */
    public function __construct(string $uploadDirAbsolutePath)
    {
        $this->uploadDirAbsolutePath = $uploadDirAbsolutePath;
    }

    /**
     * @param Image $image
     */
    public function prePersist(Image $image)
    {
        if ($image->getUploadedFile() === null) {
            return;
        }

        $filename = md5(uniqid("", true)) . "." . $image->getUploadedFile()->guessExtension();
        $image->getUploadedFile()->move($this->uploadDirAbsolutePath, $filename);
        $image->setPath($filename);
    }
}
