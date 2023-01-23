<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
  private $targetDirectory;
  private $slugger;

  public function __construct($targetDirectory, SluggerInterface $slugger)
  {
    $this->targetDirectory = $targetDirectory;
    $this->slugger = $slugger;
  }

  public function upload(UploadedFile $file)
  {
    $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
    $safeFileName = $this->slugger->slug($originalFileName);
    $newFileName = $safeFileName . '-' . uniqid() . '.' . $file->guessExtension();

    try {
      $file->move($this->getTargetDirectory(), $newFileName);
    } catch (FileException $e) {
      dump($e);
    }

    return $newFileName;
  }

  public function getTargetDirectory()
  {
    return $this->targetDirectory;
  }
}
