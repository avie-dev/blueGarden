<?php
class MyValidation
{
    // 数字チェック
    public function _validation_valid_numeric($data)
    {
		if(!empty($data)) {
			if (preg_match('/^[0-9]+$/', $data) > 0){
				return true;
			}else{
				return false;
			}
		}
		return true;
    }
 
    // アルファベットチェック
    public function _valition_valid_alpha($data)
    {
        return (preg_match('/^[a-zA-Z]+$/', $data) > 0);
    }

	// 半角英数字チェック
    public static function _validation_alphanum($data)
    {
        if(!empty($data)) {
            if (preg_match("/^[a-zA-Z0-9]+$/", $data)) {
                return true;
            }
            else {
                return false;
            }
        }
        return true;
    }

	//全角カタカナチェック
	public static function _validation_kana($data, $options=null)
	{
		if(!empty($data)) {
			mb_regex_encoding("UTF-8");
			if (preg_match("/^[ァ-ヶー]+$/u", $data) === 1) {
				return true;
			}
			else {
				return false;
			}
		}
        return true;
	}
	
}
?>