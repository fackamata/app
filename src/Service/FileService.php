<?php

namespace App\Service;

use App\Interfaces\FilableInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService
{
    private $projectDir;
    private $publicDir;

    //https://symfony.com/doc/current/components/dependency_injection.html
    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->projectDir = $parameterBag->get('kernel.project_dir');
        $this->publicDir  = $this->projectDir . '/public';
    }

    public function upload(UploadedFile $file, FilableInterface $entity, string $propertyName): void
    {
        $fileDir   = $entity->getFileDirectory();
        $filename  = $this->getSafeFileName($file);
        $setter    = 'set'.ucfirst($propertyName);

        $this->remove($entity, $propertyName);  //remove old file
        $file->move($this->publicDir.$fileDir, $filename);  //move new file
        $entity->$setter($fileDir.'/'.$filename);   //save filename in entity
    }

    public function remove(FilableInterface $entity, string $propertyName): void
    {
        $getter = 'get'.ucfirst($propertyName);

        if ($entity->$getter()) {
            $oldFileName = $this->publicDir.$entity->$getter();
            $oldMiniature = $this->publicDir. '/media/cache/miniature' . $entity->$getter();

            if (file_exists($oldFileName)) {
                unlink($oldFileName);
            }
        
            if (file_exists($oldMiniature)) {
                unlink($oldMiniature);  
            }
        }
    }

    public function getSafeFileName(UploadedFile $file): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        // $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
        // $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        $fileName = $originalFilename.'-'.uniqid().'.'.$file->guessExtension();

        return $fileName;
    }
}
