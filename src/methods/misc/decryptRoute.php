<?php

function decryptRoute($requestUri, $routes) {
	$requestUriParts = explode('?', $requestUri);
	$uri = $requestUriParts[0];
	if (!empty($requestUriParts[1])) {
		$queryParts = explode('&', $requestUriParts[1]);

		$query = [];
		foreach ($queryParts as $queryPart) {
			$queryAttrAndVal = explode('=', $queryPart);
			$query[$queryAttrAndVal[0]] = $queryAttrAndVal[1];
		}
	}

	foreach ($routes as $route => $routeView) {
		$pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route)) . "$@D";
		$matches = Array();

		if (preg_match($pattern, $uri, $matches)) {
			array_shift($matches);
			$attributes = $matches;
			$query = !empty($query) ? $query : [];
			return [
				'view' => $routeView,
				'attributes' => $attributes,
				'query' => $query,
			];
		}
	}
}