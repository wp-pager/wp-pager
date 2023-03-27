<?php

declare(strict_types=1);

namespace WpPager;

use WpPager\Dto\ImageFile;
use WpPager\Dto\Option;

class OptionsStorage
{
    public function get(): Option
    {
        /** @var Option */
        return get_option('wp_pager_options', new Option());
    }

    public function save(Option $option): void
    {
        update_option('wp_pager_options', $option);
    }

    public function addFile(ImageFile $file): void
    {
        $options = $this->get();
        $options->files[] = $file;
        $this->save($options);
    }

    /**
     * @param array<int, ImageFile> $files
     */
    public function saveFiles(array $files): void
    {
        $options = $this->get();
        $options->files = $files;
        $this->save($options);
    }
}
