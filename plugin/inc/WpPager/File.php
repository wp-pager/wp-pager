<?php

declare(strict_types=1);

namespace WpPager;

use JsonException;
use WpPager\Dto\ImageFile;

class File
{
    /**
     * @return ImageFile[]
     */
    public function getFiles(): array
    {
        $storage = new OptionsStorage();
        $options = $storage->get();

        $result = $options->files;

        usort($result, static function (ImageFile $a, ImageFile $b) {
            return $a->page <=> $b->page;
        });

        return $result;
    }

    /**
     * @return ImageFile[]
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
     *
     * @return ImageFile[]
     */
    public function giveImageTitle(int $page, string $title): array
    {
        $files = $this->getFiles();

        foreach ($files as $file) {
            if ($file->page !== $page) {
                continue;
            }

            $file->title = $title === '' ? null : $title;
        }

        $this->saveFiles($files);

        return $files;
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
     * @param array<int, array{
     *     name: string,
     *     type: string,
     *     tmp_name: string,
     *     error: int,
     *     size: int
     * }> $files
     *
     * @return ImageFile[]
     * @throws JsonException
     */
    public function addFiles(array $files): array
    {
        $saved_files = $this->getFiles();
        $saved_file_names = array_column($saved_files, 'name');
        $latest_page = $this->getLatestFilePage($saved_files);
        $modified_files = 0;

        Dir::create(PAGER_UPLOADS_PATH);
        Dir::create(PAGER_FILES_PATH);

        foreach ($files as $key => $file) {
            $path = PAGER_FILES_PATH . $file['name'];

            move_uploaded_file($file['tmp_name'], $path);

            if (in_array($file['name'], $saved_file_names, true)) {
                continue;
            }

            $saved_files[] = new ImageFile(
                page: $latest_page++,
                name: $file['name'],
                url: PAGER_FILES_URL . $file['name'],
                path: $path,
                visible: $key === 0,
            );

            $modified_files++;
        }

        if ($modified_files === 0) {
            return $saved_files;
        }

        return $this->saveFiles($saved_files);
    }

    /**
     * @param ImageFile[] $files
     * @return ImageFile[]
     */
    public function saveFiles(array $files): array
    {
        $files = $this->resetPageNumbers($files);

        $storage = new OptionsStorage();
        $storage->saveFiles($files);

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
}
