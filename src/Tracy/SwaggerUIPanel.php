<?php

namespace Apitte\OpenApi\Tracy;

use Apitte\OpenApi\OpenApiService;
use Tracy\IBarPanel;

class SwaggerUIPanel implements IBarPanel
{

	const EXPANSION_FULL = 'full';
	const EXPANSION_LIST = 'list';
	const EXPANSION_NONE = 'none';

	/** @var string|NULL */
	private $url;

	/** @var string */
	private $expansion = self::EXPANSION_LIST;

	/** @var string|bool */
	private $filter;

	/** @var string */
	private $title = 'OpenAPI';

	/** @var OpenApiService */
	private $openApiService;

	/**
	 * @param OpenApiService $openApiService
	 */
	public function __construct(OpenApiService $openApiService)
	{
		$this->openApiService = $openApiService;
	}

	/**
	 * @param string|NULL $url
	 * @return void
	 */
	public function setUrl($url)
	{
		$this->url = $url;
	}

	/**
	 * @param string $expansion
	 * @return void
	 */
	public function setExpansion($expansion)
	{
		$this->expansion = $expansion;
	}

	/**
	 * @param string|bool $filter
	 * @return void
	 */
	public function setFilter($filter)
	{
		$this->filter = $filter;
	}

	/**
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title)
	{
		$this->title = $title;
	}

	/**
	 * Renders HTML code for custom tab.
	 *
	 * @return string
	 */
	public function getTab()
	{
		return '<span title="Swagger UI for Open Api Specification"><img height="16px" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAqRJREFUeNrEVz1s00AUfnGXii5maMXoEUEHVwIpEkPNgkBdMnQoU5ytiKHJwpp2Q2JIO8DCUDOxIJFIVOoWZyJSh3pp1Q2PVVlcCVBH3ufeVZZ9Zye1Ay86nXV+ue/9fO/lheg/Se02X1rvksmbnTiKvuxQMBNgBnN4a/LCbmnUAP6JV58NCUsBC8CuAJxGPF47OgNqBaA93tolUhnx6jC4NxGwyOEwlccyAs+3kwdzKq0HDn2vEBTi8J2XpyMaywNDE157BhXUE3zJhlq8GKq+Zd2zaWHepPA8oN9XkfLmRdOiJV4XUUg/IyWncLjCYY/SHndV2u7zHr3bPKZtdxgboJOnthvrfGj/oMf3G0r7JVmNlLfKklmrt2MvvcNO7LFOhoFHfuAJI5o6ta10jpt5CQLgwXhXG2YIwvu+34qf78ybOjWTnWwkgR36d7JqJOrW0hHmNrKg9xhiS4+1jFmrxymh03B0w+6kURIAu3yHtOD5oaUNojMnGgbcctNvwdAnyxvxRR+/vaJnjzbpzcZX+nN1SdGv85i9eH8w3qPO+mdm/y4dnQ1iI8Fq6Nf4cxL6GWSjiFDSs0VRnxC5g0xSB2cgHpaseTxfqOv5uoHkNQ6Ha/N1Yz9mNMppEkEkYKj79q6uCq4bCHcSX3fJ0Vk/k9siASjCm1N6gZH6Ec9IXt2WkFES2K/ixoIyktJPAu/ptOA1SgO5zqtr6KASJPF0nMV8dgMsRhRPOcMwqQAOoi0VAIMLAEWJ6YYC1c8ibj1GP51RqwzYwZVMHQuvOzMCBUtb2tGHx5NAdLKqp5AX7Ng4d+Zi8AGDI9z1ijx9yaCH04y3GCP2S+QcvaGl+pcxyUBvinFlawoDQjHSelX8hQEoIrAq8p/mgC88HOS1YCl/BRgAmiD/1gn6Nu8AAAAASUVORK5CYII="/> ' . $this->title . ' </span>';
	}

	/**
	 * Renders HTML code for custom panel.
	 *
	 * @return string
	 */
	public function getPanel()
	{
		ob_start();
		$spec = $this->openApiService->createSchema()->toArray();
		$url = $this->url;
		$expansion = $this->expansion;
		$filter = $this->filter;
		require __DIR__ . '/templates/panel.phtml';

		return ob_get_clean();
	}

}
