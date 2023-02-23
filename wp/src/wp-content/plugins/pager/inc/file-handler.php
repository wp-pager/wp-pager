<?php

declare( strict_types=1 );

/**
 * @throws JsonException
 */
function pager_get_files(): array {
	$content = file_get_contents( PAGER_FILES_URL );

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

/**
 * @throws JsonException
 */
function pager_delete_file( int $id ): void {
	$files = pager_get_files();

	foreach ( $files as $key => $file ) {
		if ( $file['id'] === $id ) {
			unset( $files[ $key ] );
		}
	}

	$json = json_encode( $files, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

	file_put_contents( PAGER_FILES_URL, $json );
}