<?php

namespace Ome\Event\Interfaces\UseCases\EditEventScheme;

/**
 * Edit Event Scheme.
 */
interface EditEventSchemeUseCase
{
	/**
	 * Edit Event Scheme.
	 */
	public function interact(EditEventSchemeRequest $request): EditEventSchemeResponse;
}
