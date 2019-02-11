<?php
class AreaQuestions {
	public static function createField($data) {
		switch ($data->type) {
			case 'select':
				return self::selectField($data->name, $data->text, $data->choices);
				break;
			case 'text':
				return self::textField($data->name, $data->text);
				break;
			case 'radio':
				return self::radioField($data->name, $data->text);
				break;
			case 'checkbox':
				return self::checkboxField($data->name, $data->text);
				break;
			case 'multi-select':
				return self::multiSelectField($data->name, $data->text, $data->choices);
				break;
			
			default:
				# code...
				break;
		}
	}

	public static function textField($area, $text) {
		$str = '';
		$str .= "<label>$text</label>";
		$str .= '<input type="text" name="'.$area.'" value="" />';
		return $str;
	}

	public static function checkboxField($area, $text) {
		$str = '<div class="checkbox"><label>';
		$str .=	form_checkbox('area', 'true');
		$str .= $text;
		$str .=	'</label></div>';
		return $str;
	}

	public static function radioField($area, $text) {
		$str = '<div class="radio"><label>';
		$str .=	form_radio('area', 'true');
		$str .= $text;
		$str .=	'</label></div>';
		return $str;
	}

	public static function selectField($area, $text, $choices) {
		$arr = array();
		$options = json_decode($choices);

		foreach($options as $opt) {
			$arr[str_replace(' ', '-', strtolower($opt->value))] = $opt->value;
		}
	
		$str = '';
		$str .= "<label>$text</label>";
		$str .= form_dropdown($area, $arr, null, array('class' => 'form-control'));
		return $str;
	}

	public static function multiSelectField($area, $text, $choices) {
		$arr = array();
		$options = json_decode($choices);

		foreach($options as $opt) {
			$arr[str_replace(' ', '-', strtolower($opt->value))] = $opt->value;
		}
	
		$str = '';
		$str .= "<label>$text</label>";
		$str .= form_dropdown($area, $arr, null, array('class' => 'form-control multi-select', 'multiple' => 'multiple'));
		return $str;
	}
}