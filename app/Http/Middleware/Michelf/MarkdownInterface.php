<?php
/*
 * Copyright © 2016 - 2023 筱锋xiao_lfeng. All Rights Reserved.
 * 开发开源遵循 MIT 许可，若需商用请联系开发者
 * https://www.x-lf.com/
 */

namespace App\Http\Middleware\Michelf;

/**
 * Markdown Parser Interface
 */
interface MarkdownInterface {
	/**
	 * Initialize the parser and return the result of its transform method.
	 * This will work fine for derived classes too.
	 *
	 * @api
	 *
	 * @param  string $text
	 * @return string
	 */
	public static function defaultTransform(string $text): string;

	/**
	 * Main function. Performs some preprocessing on the input text
	 * and pass it through the document gamut.
	 *
	 * @api
	 *
	 * @param  string $text
	 * @return string
	 */
	public function transform(string $text): string;
}
