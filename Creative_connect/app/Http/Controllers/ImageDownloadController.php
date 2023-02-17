<?php

namespace App\Http\Controllers;

use App\Models\EditingWrc;
use Illuminate\Http\Request;
use ZipArchive;

class ImageDownloadController extends Controller
{

    private function addContent(\ZipArchive $zip, string $path)
    {
        /** @var SplFileInfo[] $files */
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(
                $path,
                \FilesystemIterator::FOLLOW_SYMLINKS
            ),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        while ($iterator->valid()) {
            if (!$iterator->isDot()) {
                $filePath = $iterator->getPathName();
                $relativePath = substr($filePath, strlen($path) + 1);

                if (!$iterator->isDir()) {
                    $zip->addFile($filePath, $relativePath);
                } else {
                    if ($relativePath !== false) {
                        $zip->addEmptyDir($relativePath);
                    }
                }
            }
            $iterator->next();
        }
    }


    public function Editing_Raw_Image_Download($wrc_id = 0)
    {
        $wrcId = base64_decode($wrc_id);
        $wrcinfo =    $EditingWrc =  EditingWrc::find($wrcId);
        $fileName = $wrcinfo->wrc_number . ".zip";
        $file_path = $wrcinfo->file_path;
        // dd($fileName , $file_path ,$wrcinfo->all());
        $zip = new ZipArchive;

        if ($zip->open($fileName, ZipArchive::CREATE) === TRUE) {
            $this->addContent($zip, $file_path);
            $zip->close();
            return response()->download($fileName)->deleteFileAfterSend(true);
        }
    }
}
