<?php

declare(strict_types=1);

namespace WpPager;

use JsonException;
use RuntimeException;
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
         * @var array<int, array{page: int, name: string, url: string, path: string}>|null $files
         */
        $files = Json::decode($content);

        if (!$files) {
            return [];
        }

        $result = array_map(function (array $file) {
            return new ImageFile($file['page'], $file['name'], $file['url'], $file['path'], $file['visible']);
        }, $files);

        usort($result, function (ImageFile $a, ImageFile $b) {
            return $a->page <=> $b->page;
        });

        return $result;
    }

    /**
     * @return ImageFile[]
     * @throws JsonException
     */
    public function deleteFile(int $page): array
    {
        $files = $this->getFiles();

        foreach ($files as $key => $file) {
            if ($file->page !== $page) {
                continue;
            }

            unlink($file->path);
            unset($files[$key]);
        }

        return $this->saveFiles($files);
    }

    /**
     * @throws JsonException
     */
    public function deleteAll(): void
    {
        $files = $this->getFiles();

        foreach ($files as $key => $file) {
            unlink($file->path);
        }

        $this->saveFiles([]);
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
        $latest_page = $this->getLatestFilePage($result);

        $this->createDirIfNotExists(PAGER_FILES_DIR);

        foreach ($files as $key => $file) {
            $path = PAGER_FILES_DIR . '/' . $file['name'];

            $result[] = new ImageFile(
                page: $latest_page++,
                name: $file['name'],
                url: PAGER_FILES_DIR_URL . '/' . $file['name'],
                path: $path,
                visible: $key === 0,
            );

            move_uploaded_file($file['tmp_name'], $path);
        }

        return $this->saveFiles($result);
    }

    /**
     * @param ImageFile[] $files
     * @return ImageFile[]
     * @throws JsonException
     */
    public function saveFiles(array $files): array
    {
        $files = $this->resetPageNumbers($files);

        $json = Json::encode($files);
        file_put_contents(PAGER_FILES_URL, $json);

        return $files;
    }

    /**
     * @param ImageFile[] $files
     */
    private function getLatestFilePage(array $files): int
    {
        $page_numbers = array_column($files, 'page');

        if (empty($page_numbers)) {
            return 1;
        }

        return max($page_numbers) + 1;
    }

    /**
     * @param ImageFile[] $files
     *
     * @return ImageFile[]
     */
    private function resetPageNumbers(array $files): array
    {
        foreach ($files as $key => &$file) {
            $page_number = ++$key;

            $file->page = $page_number;
            $file->visible = $page_number === 1;
        }

        return array_values($files);
    }

    private function createDirIfNotExists(string $dir): void
    {
        if (!file_exists($dir) && !mkdir($dir, 0777, true) && !is_dir($dir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }
    }
}
