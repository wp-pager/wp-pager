<?php

declare(strict_types=1);

namespace WpPager;

use JsonException;
use WpPager\Dto\ImageFile;

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
         * @var array<int, array{id: int, name: string, url: string, path: string}>|null $files
         */
        $files = Json::decode($content);

        if (!$files) {
            return [];
        }

        return array_map(function (array $file) {
            return new ImageFile($file['id'], $file['name'], $file['url'], $file['path'], $file['visible']);
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
            if ($file->id !== $id) {
                continue;
            }

            unlink($file->path);
            unset($files[$key]);
        }

        $this->saveFiles($files);

        return $files;
    }

    public function deleteAll(): void
    {
        $files = $this->getFiles();

        foreach ($files as $file) {
            $this->deleteFile($file->id);
        }
    }

    /**
     * @param ImageFile[] $files
     *
     * @return ImageFile[]
     * @throws JsonException
     */
    public function addFiles(array $files): array
    {
        $result = $this->getFiles();
        $latest_id = $this->getLatestFileId($result);

        foreach ($files as $key => $file) {
            $path = PAGER_FILES_DIR . '/' . $file['name'];

            $result[] = new ImageFile(
                id: $latest_id++,
                name: $file['name'],
                url: PAGER_FILES_DIR_URL . '/' . $file['name'],
                path: $path,
                visible: $key === 0,
            );

            move_uploaded_file($file['tmp_name'], $path);
        }

        $this->saveFiles($result);

        return $result;
    }

    /**
     * @param ImageFile[] $files
     * @throws JsonException
     */
    public function saveFiles(array $files): void
    {
        $files = array_values($files);
        $json = Json::encode($files);
        file_put_contents(PAGER_FILES_URL, $json);
    }

    /**
     * @param ImageFile[] $files
     */
    private function getLatestFileId(array $files): int
    {
        $ids = array_column($files, 'id');

        if (empty($ids)) {
            return 1;
        }

        return max($ids) + 1;
    }
}
