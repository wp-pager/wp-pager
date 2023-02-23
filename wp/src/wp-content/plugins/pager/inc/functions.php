<?php

declare( strict_types=1 );

/**
 * @throws JsonException
 */
function pager_image_loader(): array {
	$file    = PAGER_PATH . 'storage/files.json';
	$content = file_get_contents( $file );

	if ( ! $content ) {
		return [];
	}

	/**
	 * @var array<int, array{
	 *     id: int,
	 *     name: string,
	 *     url: string,
	 * }>|null $images
	 */
	$images = json_decode( $content, true, 512, JSON_THROW_ON_ERROR );

	if ( ! $images ) {
		return [];
	}

	return $images;
}