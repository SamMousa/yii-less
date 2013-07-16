<?php

	/**
	 * @property CClientScript $owner
	 */
	class LessBehavior extends CBehavior
	{
		/**
		 *
		 * @var lessc
		 */
		protected $lessc;

		public function __construct()
		{
			require_once(dirname(__FILE__) . '/lessphp/lessc.inc.php');
			$this->lessc = new lessc();
		}


		/**
		 * Compiles a LESS file and register the resulting CSS file.
		 * @param string $lessFile path to the LESS file
		 * @param string $media media that the CSS file should be applied to. If empty, it means all media types.
		 * @return CClientScript the CClientScript object itself (to support method chaining, available since version 1.1.5).
		 */
		public function registerLessFile($lessFile, $media = '')
		{
			$lessFile = Yii::getPathOfAlias('webroot') . $lessFile;
			
			// Create the file path and url.
			$css = $this->resolveCssPaths($lessFile);

			// Compile LESS file.
			$this->lessc->checkedCompile($lessFile, $css['file']);

			// Register compiled CSS file.
			$this->owner->registerCssFile($css['url'], $media);
			return $this->owner;
		}

		/**
		 * Creates a path for the CSS file based on the path of the LESS file.
		 * @param string $lessFile
		 */
		protected function resolveCssPaths($lessFile)
		{
			$assetPath = Yii::app()->getAssetManager()->getBasePath();
			if (!file_exists("$assetPath/less"))
			{
				mkdir("$assetPath/less");
			}

			$assetUrl = Yii::app()->getAssetManager()->getBaseUrl();
			$fileName = md5($lessFile) . '.css';
			return array(
				'file' => "$assetPath/less/$fileName",
				'url' => "$assetUrl/less/$fileName"
			);
		}


		
	}
?>