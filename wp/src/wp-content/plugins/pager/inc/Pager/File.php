<?php

declare(strict_types=1);

namespace Pager;

use JsonException;
use Pager\Dto\ImageFile;

class File
{
    /**
     * @return ImageFile[]
     * @throws JsonException
     */
    public function getFiles(): array
    {
        $content = file_get_contents(PAGER_FILES_URL);

        if (!$content) {
            return [];
        }

        /**
         * @var array<int, array{id: int, url: string, path: string}>|null $files
         */
        $files = Json::decode($content);

        if (!$files) {
            return [];
        }

        return array_map(function (array $file) {
            return new ImageFile($file['id'], $file['url'], $file['path']);
        }, $files);
    }

    /**
     * @return ImageFile[]
     * @throws JsonException
     */
    public function deleteFile(int $id): array
    {
        $files = $this->getFiles();

        foreach ($files as $key => $file) {
            if ($file['id'] === $id) {
                unset($files[$key]);
            }
        }

        $this->saveFiles($files);

        return $files;
    }

    /**
     * @param ImageFile[] $files
     *
     * @return ImageFile[]
     * @throws JsonException
     */
    public function addFiles(array $files): array
    {
        $all_files = $this->getFiles();
        $latest_id = $this->getLatestFileId($all_files);

        foreach ($files as $file) {
            $path = PAGER_FILES_DIR . '/' . $file['name'];

            $all_files[] = [
                'id'   => $latest_id++,
                'path' => $path,
                'url'  => PAGER_FILES_DIR_URL . '/' . $file['name'],
            ];

            move_uploaded_file($file['tmp_name'], $path);
        }

        $this->saveFiles($all_files);

        return $all_files;
    }

    /**
     * @throws JsonException
     */
    private function saveFiles(array $files): void
    {
        $files = array_values($files);
        $json  = Json::encode($files);
        file_put_contents(PAGER_FILES_URL, $json);
    }

    /**
     * @param ImageFile[] $files
     */
    private function getLatestFileId(array $files): int
    {
        $ids = array_column($files, 'id');
        return max($ids) + 1;
    }
}
