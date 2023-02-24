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
function pager_delete_file( int $id ): array {
	$files = pager_get_files();

	foreach ( $files as $key => $file ) {
		if ( $file['id'] === $id ) {
			unset( $files[ $key ] );
		}
	}

	saveFiles( $files );

	return $files;
}

/**
 * @throws JsonException
 */
function pager_upload_files( array $files ): array {
	$all_files = pager_get_files();
	$latest_id = getLatestFileId( $all_files );

	foreach ( $files as $file ) {
		$path = PAGER_FILES_DIR . '/' . $file['name'];

		$all_files[] = [
			'id'   => $latest_id ++,
			'path' => $path,
			'url'  => PAGER_FILES_DIR_URL . '/' . $file['name'],
		];

		move_uploaded_file( $file['tmp_name'], $path );
	}

	saveFiles( $all_files );

	return $all_files;
}

/**
 * @throws JsonException
 */
function saveFiles( array $files ): void {
	$files = array_values( $files );
	$json  = json_encode( $files, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );
	file_put_contents( PAGER_FILES_URL, $json );
}

function getLatestFileId( array $files ): int {
	$ids = array_column( $files, 'id' );

	return max( $ids ) + 1;
}