<?php

/**
 * @package DataTypes
 */

class DataType_Phone extends DataTypePlugin {

	protected $isEnabled = true;
	protected $dataTypeName = "Phone / Fax";
	protected $dataTypeFieldGroup = "human_data";
	protected $dataTypeFieldGroupOrder = 20;
	protected $jsModules = array("Phone.js");


	public function generate($generator, $generationContextData) {
		$phoneStr = Utils::generateRandomAlphanumericStr($generationContextData["generationOptions"]);
		$formats = explode("|", $phoneStr);
		$chosenFormat = $formats[0];
		if (count($formats) > 1) {
			$chosenFormat = $formats[rand(0, count($formats)-1)];
		}
		return array(
			"display" => $chosenFormat
		);
	}

	public function getRowGenerationOptions($generator, $post, $colNum, $numCols) {
		if (!isset($post["dtOption_$colNum"]) || empty($post["dtOption_$colNum"])) {
			return false;
		}
		return $post["dtOption_$colNum"];
	}

	public function getExampleColumnHTML() {
		$L = Core::$language->getCurrentLanguageStrings();

		$html =<<<EOF
	<select name="dtExample_%ROW%" id="dtExample_%ROW%">
		<option value="">{$L["please_select"]}</option>
		<option value="1-Xxx-Xxx-xxxx">{$this->L["example_1"]}</option>
		<option value="(Xxx) Xxx-xxxx">{$this->L["example_2"]}</option>
		<option value="1 Xx Xxx Xxxx-xxxx">{$this->L["uk"]}</option>
		<option value="0X xx xx xx xx">{$this->L["france"]}</option>
		<option value="(0X) xxxx xxxx">{$this->L["australia"]}</option>
		<option value="(0xx) xxxxxxxx|(0xxx) xxxxxxxx|(0xxxx) xxxxxxx|(03xxxx) xxxxxx">{$this->L["germany"]}</option>
		<option value="0xx-xxx-xxxx">{$this->L["japan"]}</option>
		<option value="1-Xxx-Xxx-xxxx|Xxx-xxxx">{$this->L["different_formats"]}</option>
		<option value="1-Xxx-Xxx-xxxx|01-Xxx-Xxx-xxxx|Xxx-Xxx-xxxx|Xxx.Xxx.xxxx|(Xxx) Xxx.xxxx|(Xxx) Xxx-xxxx|+01 (Xxx) Xxx-xxxx|+1 (Xxx) Xxx-xxxx|+1 Xxx.Xxx.xxxx|+1 Xxx-Xxx-xxxx|+01 Xxx-Xxx-xxxx|XxxXxxxxxx|1-Xxx-Xxx-xxxx Xx|01-Xxx-Xxx-xxxx Xxx|Xxx-Xxx-xxxx Xxx|Xxx.Xxx.xxxx Xxxx|(Xxx) Xxx.xxxx Xxxx|(Xxx) Xxx-xxxx Xxxx|+01 (Xxx) Xxx-xxxx Xxxx|+1 (Xxx) Xxx-xxxx Xxx|+1 Xxx.Xxx.xxxx Xxx|+1 Xxx-Xxx-xxxx xxxx|+01 Xxx-Xxx-xxxx xxxxxx|XxxXxxxxxx xxxxx|1-Xxx-Xxx-xxxx eXx|01-Xxx-Xxx-xxxx eXxx|Xxx-Xxx-xxxx eXxx|Xxx.Xxx.xxxx eXxxx|(Xxx) Xxx.xxxx eXxxx|(Xxx) Xxx-xxxx eXxxx|+01 (Xxx) Xxx-xxxx eXxxx|+1 (Xxx) Xxx-xxxx eXxx|+1 Xxx.Xxx.xxxx eXxx|+1 Xxx-Xxx-xxxx exxxx|+01 Xxx-Xxx-xxxx exxxxxx|XxxXxxxxxx exxxxx|1-Xxx-Xxx-xxxx eetXx|01-Xxx-Xxx-xxxx eetXxx|Xxx-Xxx-xxxx eet. Xxx|Xxx.Xxx.xxxx eetXxxx|(Xxx) Xxx.xxxx eet. Xxxx|(Xxx) Xxx-xxxx eet.Xxxx|+01 (Xxx) Xxx-xxxx eetXxxx|+1 (Xxx) Xxx-xxxx eetXxx|+1 Xxx.Xxx.xxxx eet.Xxx|+1 Xxx-Xxx-xxxx eet xxxx|+01 Xxx-Xxx-xxxx eet xxxxxx|XxxXxxxxxx eet.xxxxx">{$this->L["different_formats"]} (Advanced)</option>
	</select>
EOF;
		return $html;
	}

	public function getOptionsColumnHTML() {
		$html = '<input type="text" name="dtOption_%ROW%" id="dtOption_%ROW%" style="width: 267px" />';
		return $html;
	}

	public function getHelpHTML() {
		$html =<<<END
	<p>
		{$this->L["help_text1"]}
	</p>
	<p>
		{$this->L["help_text2"]}
	</p>
	<p>
		{$this->L["help_text3"]}
	</p>
END;

	    return $html;
	}

	public function getDataTypeMetadata() {
		return array(
			"SQLField" => "varchar(100) default NULL",
			"SQLField_Oracle" => "varchar2(100) default NULL",
			"SQLField_MSSQL" => "VARCHAR(100) NULL"
		);
	}
}
