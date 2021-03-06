<?php
// класс для получения данных из фб
class FBAuth{
	public $settings = array();
	public $auth_status = false;
	public $user_info = array();

	// метод вызываемый при создание экземпляра класса
	public function __construct($settings){
		if(isset($settings['client_id'], $settings['client_secret'], $settings['redirect_uri'])){
			$this->settings = $settings;
		}
	}

	// если методом get был получен код приложения, то подготовить ссылку для запроса токена пользователя из фб и потом остальных данных пользователя
	public function auth($code){
		if($code && $this->settings){
			$query = urldecode(http_build_query(array(
				'client_id' => $this->settings['client_id'],
				'client_secret' => $this->settings['client_secret'],
				'code' => $code,
				'redirect_uri' => $this->settings['redirect_uri']
			)));
			// получить токен пользователя
			$token = json_decode(file_get_contents("https://graph.facebook.com/v2.12/oauth/access_token?".$query), true);

			if(isset($token['access_token'])){
				$query = urldecode(http_build_query(array(
					'access_token' => $token['access_token'],
					'fields' => 'id,first_name,last_name'
				)));
				// получить данные пользователя
				$this->user_info = json_decode(file_get_contents("https://graph.facebook.com/me?".$query), true);

				if(isset($this->user_info['id'])){
					$this->auth_status = true;
					return true;
				}
			}
		}
		return false;
	}

	//взять данные приложения фб и отправить их в фб для получения кода приложения
	public function get_link(){
		if($this->settings){
			$query = urldecode(http_build_query(array(
				'client_id' => $this->settings['client_id'],
				'redirect_uri' => $this->settings['redirect_uri'],
				'response_type' => 'code'
			)));
			return "https://www.facebook.com/v2.12/dialog/oauth?".$query;
		}
		return false;
	}
}
?>
